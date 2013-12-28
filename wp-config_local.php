<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ashvin_sbi');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');//fmqg8XW0
//ashvinvi.5gbfree.com
/** MySQL hostname ashvinvi.5gbfree.com 209.90.88.133*/
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Lq0#&JM*jp7at:Lm?Sj[hiev>FE2&@VUy/g1W6C 0zj&v3CNxe2Q!wK[7BL^Gf3w');
define('SECURE_AUTH_KEY',  'P6Cfjg?8.8l?I78J.EOZfSnyNV2mYx1:M_+}3K#ipZG+n3kav]Oa%?92~^B(V1!S');
define('LOGGED_IN_KEY',    '0v,WX-mH u!hmbTq26$rYwS5q.)r7o|{gF4A%m / 0n0>g:a9.w_ 8YZux^XZ<@x');
define('NONCE_KEY',        '^J189=^r-]i2B8?(@|wq384]f0.-<3#3w*D^;gC$SbA)!^1}awS(pR:O[%vy__1K');
define('AUTH_SALT',        'X&{gVfvqTw*cdce;wKa(S8sx8X<pwBQo:De6L!}}^ZatT~tN)|Qt:=--IVr}TD!+');
define('SECURE_AUTH_SALT', '*Z2}Gh<2M:@acZE0-l %0lUP!2?^n6EFJ~*Na3XLIKWMM/f{1l!} N}HP4[&X&h<');
define('LOGGED_IN_SALT',   'C!DktBIESsfBJwb[8q)n@[.lyrjhjA0zYD&5v7@Ov-DoxYb-<n{,hC^^m/`>^xVi');
define('NONCE_SALT',       'BvD=YlkhMe(1.kSi<&%;{R(Fujm.yX@*Ra1oUd7&NI_dI8-=$Cf6TbpAVC_#o6Wt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
