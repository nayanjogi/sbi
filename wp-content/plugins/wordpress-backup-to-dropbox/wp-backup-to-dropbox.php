<?php
/*
Plugin Name: WordPress Backup to Dropbox
Plugin URI: http://wpb2d.com
Description: Keep your valuable WordPress website, its media and database backed up to Dropbox in minutes with this sleek, easy to use plugin.
Version: 1.5.4
Author: Michael De Wildt
Author URI: http://www.mikeyd.com.au
License: Copyright 2011  Michael De Wildt  (email : michael.dewildt@gmail.com)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('BACKUP_TO_DROPBOX_VERSION', '1.5.4');
define('BACKUP_TO_DROPBOX_DATABASE_VERSION', '1');

define('EXTENSIONS_DIR', str_replace(DIRECTORY_SEPARATOR, '/', WP_CONTENT_DIR . '/plugins/wordpress-backup-to-dropbox/Extensions/'));
define('CHUNKED_UPLOAD_THREASHOLD', 10485760); //10 MB
define('MINUMUM_PHP_VERSION', '5.2.16');

if (function_exists('spl_autoload_register')) {
	spl_autoload_register('wpb2d_autoload');
} else {
	require_once('Dropbox/Dropbox/API.php');
	require_once('Dropbox/Dropbox/OAuth/Consumer/ConsumerAbstract.php');
	require_once('Dropbox/Dropbox/OAuth/Consumer/Curl.php');

	require_once('Classes/class-file-list.php');
	require_once('Classes/class-dropbox-facade.php');
	require_once('Classes/class-wp-backup-config.php');
	require_once('Classes/class-wp-backup.php');
	require_once('Classes/class-wp-backup-database.php');
	require_once('Classes/class-wp-backup-database-core.php');
	require_once('Classes/class-wp-backup-database-plugins.php');
	require_once('Classes/class-wp-backup-extension.php');
	require_once('Classes/class-wp-backup-extension-manager.php');
	require_once('Classes/class-wp-backup-logger.php');
	require_once('Classes/class-wp-backup-processed-files.php');
	require_once('Classes/class-wp-backup-output.php');
	require_once('Classes/class-wp-backup-registry.php');
	require_once('Classes/class-wp-backup-upload-tracker.php');
}

function wpb2d_autoload($class_name) {
	switch ($class_name) {
		case 'API':
			require_once('Dropbox/Dropbox/API.php');
			break;

		case 'OAuth_Consumer_ConsumerAbstract':
			require_once('Dropbox/Dropbox/OAuth/Consumer/ConsumerAbstract.php');
			break;

		case 'OAuth_Consumer_Curl':
			require_once('Dropbox/Dropbox/OAuth/Consumer/Curl.php');
			break;

		case 'File_List':
			require_once('Classes/class-file-list.php');
			break;

		default:
			$file = 'Classes/class-' . strtolower(str_replace('_', '-', $class_name)) . '.php';
			if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file))
				require_once($file);
	}
}

function wpb2d_style() {
	//Register stylesheet
	wp_register_style('wpb2d-style', plugins_url('wp-backup-to-dropbox.css', __FILE__) );
	wp_enqueue_style('wpb2d-style');
}

/**
 * A wrapper function that adds an options page to setup Dropbox Backup
 * @return void
 */
function backup_to_dropbox_admin_menu() {
	$imgUrl = rtrim(WP_PLUGIN_URL, '/') . '/wordpress-backup-to-dropbox/Images/WordPressBackupToDropbox_16.png';

	$text = __('WPB2D', 'wpbtd');
	add_utility_page($text, $text, 'activate_plugins', 'backup-to-dropbox', 'backup_to_dropbox_admin_menu_contents', $imgUrl);

	$text = __('Backup Settings', 'wpbtd');
	add_submenu_page('backup-to-dropbox', $text, $text, 'activate_plugins', 'backup-to-dropbox', 'backup_to_dropbox_admin_menu_contents');

	if(version_compare(PHP_VERSION, MINUMUM_PHP_VERSION) >= 0) {
		$text = __('Backup Log', 'wpbtd');
		add_submenu_page('backup-to-dropbox', $text, $text, 'activate_plugins', 'backup-to-dropbox-monitor', 'backup_to_dropbox_monitor');

		WP_Backup_Extension_Manager::construct()->add_menu_items();

		$text = __('Premium Extensions', 'wpbtd');
		add_submenu_page('backup-to-dropbox', $text, $text, 'activate_plugins', 'backup-to-dropbox-premium', 'backup_to_dropbox_premium');
	}
}

/**
 * A wrapper function that includes the backup to Dropbox options page
 * @return void
 */
function backup_to_dropbox_admin_menu_contents() {
	wpb2d_style();

	$uri = rtrim(WP_PLUGIN_URL, '/') . '/wordpress-backup-to-dropbox';

	if(version_compare(PHP_VERSION, MINUMUM_PHP_VERSION) >= 0)
		include('Views/wp-backup-to-dropbox-options.php');
	else
		include('Views/wp-backup-to-dropbox-deprecated.php');
}

/**
 * A wrapper function that includes the backup to Dropbox monitor page
 * @return void
 */
function backup_to_dropbox_monitor() {
	wpb2d_style();

	if (!WP_Backup_Registry::dropbox()->is_authorized()) {
		backup_to_dropbox_admin_menu_contents();
	} else {
		$uri = rtrim(WP_PLUGIN_URL, '/') . '/wordpress-backup-to-dropbox';
		include('Views/wp-backup-to-dropbox-monitor.php');
	}
}

/**
 * A wrapper function that includes the backup to Dropbox premium page
 * @return void
 */
function backup_to_dropbox_premium() {
	wpb2d_style();

	$uri = rtrim(WP_PLUGIN_URL, '/') . '/wordpress-backup-to-dropbox';
	include('Views/wp-backup-to-dropbox-premium.php');
}

/**
 * A wrapper function for the file tree AJAX request
 * @return void
 */
function backup_to_dropbox_file_tree() {
	include('Views/wp-backup-to-dropbox-file-tree.php');
	die();
}

/**
 * A wrapper function for the progress AJAX request
 * @return void
 */
function backup_to_dropbox_progress() {
	include('Views/wp-backup-to-dropbox-progress.php');
	die();
}

/**
 * A wrapper function that executes the backup
 * @return void
 */
function execute_drobox_backup() {
	WP_Backup_Registry::logger()->delete_log();
	WP_Backup_Registry::logger()->log(sprintf(__('Backup started on %s.', 'wpbtd'), date("l F j, Y", strtotime(current_time('mysql')))));

	$time = ini_get('max_execution_time');
	WP_Backup_Registry::logger()->log(sprintf(
		__('Your time limit is %s and your memory limit is %s'),
		$time ? $time . ' ' . __('seconds', 'wpbtd') : __('unlimited', 'wpbtd'),
		ini_get('memory_limit')
	));

	if (ini_get('safe_mode'))
		WP_Backup_Registry::logger()->log(__("Safe mode is enabled on your server so the PHP time and memory limit cannot be set by the backup process. So if your backup fails it's highly probable that these settings are too low.", 'wpbtd'));

	WP_Backup_Registry::config()->set_option('in_progress', true);

	if (defined('WPB2D_TEST_MODE')) {
		run_dropbox_backup();
	} else {
		wp_schedule_single_event(time(), 'run_dropbox_backup_hook');
		wp_schedule_event(time(), 'every_min', 'monitor_dropbox_backup_hook');
	}
}

/**
 * @return void
 */
function monitor_dropbox_backup() {
	$config = WP_Backup_Registry::config();
	$mtime = filemtime(WP_Backup_Registry::logger()->get_log_file());

	//5 mins to allow for socket timeouts and long uploads
	if ($config->get_option('in_progress') && ($mtime < time() - 300)) {
		WP_Backup_Registry::logger()->log(sprintf(__('There has been no backup activity for a long time. Attempting to resume the backup.' , 'wpbtd'), 5));
		$config->set_option('is_running', false);

		wp_schedule_single_event(time(), 'run_dropbox_backup_hook');
	}
}

/**
 * @return void
 */
function run_dropbox_backup() {
	$options = WP_Backup_Registry::config();
	if (!$options->get_option('is_running')) {
		$options->set_option('is_running', true);
		WP_Backup::construct()->execute();
	}
}

/**
 * Adds a set of custom intervals to the cron schedule list
 * @param  $schedules
 * @return array
 */
function backup_to_dropbox_cron_schedules($schedules) {
	$new_schedules = array(
		'every_min' => array(
			'interval' => 60,
			'display' => 'every_min'
		),
		'daily' => array(
			'interval' => 86400,
			'display' => 'Daily'
		),
		'weekly' => array(
			'interval' => 604800,
			'display' => 'Weekly'
		),
		'fortnightly' => array(
			'interval' => 1209600,
			'display' => 'Fortnightly'
		),
		'monthly' => array(
			'interval' => 2419200,
			'display' => 'Once Every 4 weeks'
		),
		'two_monthly' => array(
			'interval' => 4838400,
			'display' => 'Once Every 8 weeks'
		),
		'three_monthly' => array(
			'interval' => 7257600,
			'display' => 'Once Every 12 weeks'
		),
	);
	return array_merge($schedules, $new_schedules);
}

function wpb2d_install() {
	$wpdb = WP_Backup_Registry::db();

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$table_name = $wpdb->prefix . 'wpb2d_options';
	dbDelta("CREATE TABLE $table_name (
		name varchar(50) NOT NULL,
		value varchar(255) NOT NULL,
		UNIQUE KEY name (name)
	);");

	$table_name = $wpdb->prefix . 'wpb2d_processed_files';
	dbDelta("CREATE TABLE $table_name (
		file varchar(255) NOT NULL,
		offset int NOT NULL DEFAULT 0,
		uploadid varchar(50),
		UNIQUE KEY file (file)
	);");

	$table_name = $wpdb->prefix . 'wpb2d_excluded_files';
	dbDelta("CREATE TABLE $table_name (
		file varchar(255) NOT NULL,
		isdir tinyint(1) NOT NULL,
		UNIQUE KEY file (file)
	);");

	$table_name = $wpdb->prefix . 'wpb2d_premium_extensions';
	dbDelta("CREATE TABLE $table_name (
		name varchar(50) NOT NULL,
		file varchar(255) NOT NULL,
		UNIQUE KEY name (name)
	);");

	//Ensure that there where no insert errors
	$errors = array();

	global $EZSQL_ERROR;
	if ($EZSQL_ERROR) {
		foreach ($EZSQL_ERROR as $error) {
			if (preg_match("/^CREATE TABLE {$wpdb->prefix}wpb2d_/", $error['query']))
				$errors[] = $error['error_str'];
		}

		delete_option('wpb2d-init-errors');
		add_option('wpb2d-init-errors', implode($errors, '<br />'), false, 'no');
	}
}

function wpb2d_install_data() {
	$wpdb = WP_Backup_Registry::db();
	$config = WP_Backup_Registry::config();

	$options = get_option('backup-to-dropbox-options');
	if ($options) {
		foreach ($options as $key => $value)
			if (!is_array($value))
				$config->set_option($key, $value);
	}

	$tokens = get_option('backup-to-dropbox-tokens');
	if (isset($tokens['access'])) {
		$config->set_option('access_token', $tokens['access']->oauth_token);
		$config->set_option('access_token_secret', $tokens['access']->oauth_token_secret);
		$config->set_option('oauth_state', 'access');
	}

	$history = get_option('backup-to-dropbox-history');
	if ($history) {
		$wpdb->insert($wpdb->prefix . 'wpb2d_options', array(
			'name' => 'history',
			'value' => implode(',', $history),
		));
	}

	list($dirs, $files) = get_option('backup-to-dropbox-excluded-files');
	if ($files) {
		foreach ($files as $file) {
			$wpdb->insert($wpdb->prefix . 'wpb2d_excluded_files', array(
				'file' => $file,
				'isdir' => false
			));
		}
	}

	if ($dirs) {
		foreach ($dirs as $file) {
			$wpdb->insert($wpdb->prefix . 'wpb2d_excluded_files', array(
				'file' => $file,
				'isdir' => true
			));
		}
	}

	$config->set_option('database_version', BACKUP_TO_DROPBOX_DATABASE_VERSION);

	//Delete unused options
	delete_option('backup-to-dropbox-tokens');
	delete_option('backup-to-dropbox-premium-extensions');
	delete_option('backup-to-dropbox-excluded-files');
	delete_option('backup-to-dropbox-processed-files');
	delete_option('backup-to-dropbox-history');
	delete_option('backup-to-dropbox-options');
	delete_option('backup-to-dropbox-actions');
	delete_option('backup-to-dropbox-file-list');
	delete_option('backup-to-dropbox-log');
	delete_option('wpb2d_database_version');
}

function wpb2d_init() {
	try {
		//Check that the plugin's database tables are up to date
		$wpdb = WP_Backup_Registry::db();
		$tables = $wpdb->get_results("SHOW TABLES LIKE '{$wpdb->prefix}wpb2d_%%'");
		if (count($tables) < 4 || WP_Backup_Registry::config()->get_option('database_version') < BACKUP_TO_DROPBOX_DATABASE_VERSION) {
			wpb2d_install();
			wpb2d_install_data();
		}

		//Initilise extensions
		WP_Backup_Extension_Manager::construct()->init();
	} catch (Exception $e) {
		error_log($e->getMessage());
	}
}

function get_sanitized_home_path() {
	//Needed for get_home_path() function and may not be loaded
	require_once(ABSPATH . 'wp-admin/includes/file.php');

	return rtrim(str_replace('/', DIRECTORY_SEPARATOR, get_home_path()), DIRECTORY_SEPARATOR);
}

//More cron shedules
add_filter('cron_schedules', 'backup_to_dropbox_cron_schedules');

//Backup hooks
add_action('monitor_dropbox_backup_hook', 'monitor_dropbox_backup');
add_action('run_dropbox_backup_hook', 'run_dropbox_backup');
add_action('execute_periodic_drobox_backup', 'execute_drobox_backup');
add_action('execute_instant_drobox_backup', 'execute_drobox_backup');

//Register database install
register_activation_hook(__FILE__, 'wpb2d_install');
register_activation_hook(__FILE__, 'wpb2d_install_data');

add_action('plugins_loaded', 'wpb2d_init');

//i18n language text domain
load_plugin_textdomain('wpbtd', true, 'wordpress-backup-to-dropbox/Languages/');

if (is_admin()) {
	//WordPress filters and actions
	add_action('wp_ajax_file_tree', 'backup_to_dropbox_file_tree');
	add_action('wp_ajax_progress', 'backup_to_dropbox_progress');

	if (defined('MULTISITE') && MULTISITE) {
		function custom_menu_order($menu_ord) {
			if (!is_array($menu_ord))
				return true;

			if (in_array('backup-to-dropbox', $menu_ord))
				$menu_ord[] = array_shift($menu_ord);

			return $menu_ord;
		}

		add_filter('custom_menu_order', 'custom_menu_order');
		add_filter('menu_order', 'custom_menu_order');

		add_action('network_admin_menu', 'backup_to_dropbox_admin_menu');
	} else {
		add_action('admin_menu', 'backup_to_dropbox_admin_menu');
	}
}

