<?php
/**
 * A class with functions the perform a backup of WordPress
 *
 * @copyright Copyright (C) 2011 Michael De Wildt. All rights reserved.
 * @author Michael De Wildt (http://www.mikeyd.com.au/)
 * @license This program is free software; you can redistribute it and/or modify
 *          it under the terms of the GNU General Public License as published by
 *          the Free Software Foundation; either version 2 of the License, or
 *          (at your option) any later version.
 *
 *          This program is distributed in the hope that it will be useful,
 *          but WITHOUT ANY WARRANTY; without even the implied warranty of
 *          MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *          GNU General Public License for more details.
 *
 *          You should have received a copy of the GNU General Public License
 *          along with this program; if not, write to the Free Software
 *          Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA.
 */
class WP_Backup_Output extends WP_Backup_Extension {

	const MAX_ERRORS = 10;

	private
		$error_count,
		$root
		;

	public function set_root($root) {
		$this->root = $root;

		return $this;
	}

	public function out($source, $file, $processed_file = null) {
		if ($this->error_count > self::MAX_ERRORS)
			throw new Exception(sprintf(__('The backup is having trouble uploading files to Dropbox, it has failed %s times and is aborting the backup.'), self::MAX_ERRORS));

		if (!$this->dropbox)
			throw new Exception(__("Dropbox API not set"));

		$dropbox_path = $this->config->get_dropbox_path($source, $file, $this->root);

		try {
			$directory_contents = $this->dropbox->get_directory_contents($dropbox_path);

			if (!in_array(basename($file), $directory_contents) || filemtime($file) > $this->config->get_option('last_backup_time')) {
				$file_size = filesize($file);
				if ($file_size > $this->get_chunked_upload_threashold()) {

					$msg = __("Uploading large file '%s' (%sMB) in chunks", 'wpbtd');
					if ($processed_file && $processed_file->offset > 0)
						$msg = __("Resuming upload of large file '%s'", 'wpbtd');

					WP_Backup_Registry::logger()->log(sprintf(
						$msg,
						basename($file),
						round($file_size / 1048576, 1)
					));

					return $this->dropbox->chunk_upload_file($dropbox_path, $file, $processed_file);
				} else {
					return $this->dropbox->upload_file($dropbox_path, $file);
				}
			}

		} catch (Exception $e) {
			WP_Backup_Registry::logger()->log(sprintf(__("Error uploading '%s' to Dropbox: %s", 'wpbtd'), $file, strip_tags($e->getMessage())));
			$this->error_count++;
		}
	}

	public function start() {
		return true;
	}

	public function end() {}
	public function complete() {}
	public function failure() {}

	public function get_menu() {}
	public function get_type() {}

	public function is_enabled() {}
	public function set_enabled($bool) {}
	public function clean_up() {}
}