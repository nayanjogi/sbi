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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
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
define('AUTH_KEY',         'Cw&,~y((LXZ3$1dr]otc&54: 6DA=bc4eex_$` JyVZVnq%KQ~uXy~w+$EE`=Nyd');
define('SECURE_AUTH_KEY',  'znEEtLX!H*r0okoLIt^S~Jh!h eFaUmFh2^mU6a~4Rn fF5v[o~%pa^`>z@-fXIQ');
define('LOGGED_IN_KEY',    '2PdRr-logns7OE*}pD0,1Mf`5NIVojE+!|~=R&.;mhdKp)s;FGg[ClAQv@#In^|G');
define('NONCE_KEY',        '^O.U8bU$xa{FxdLuK)Z*vA,xdK]zOR|RsE/mygWHG)Z<Wl/g|~?M3wJQp<`{X->v');
define('AUTH_SALT',        '~j~YpDVw:..wF*35<1wrm<@lgRN>0xt-%Q>X22%ZIl6XkA6(B,CQJBqDUSLFYQYB');
define('SECURE_AUTH_SALT', '>KG%r0_:(FA*CB|R!pet&LXVK7Yn,lQzoM:2cwe+EYH/TK]?=%,V(sFH;~@wN4c^');
define('LOGGED_IN_SALT',   'p@i[]w&/I*&QdOKx7LYPWN>.YP^zQ Mzc}@XY)mjEBG|c{v3BBBTm%XK%pI6-LeF');
define('NONCE_SALT',       'j`A.[]r`.~8x [YtTbX>*Wbc9@=V/HJV0,[9sf.z(]p`zS^](CrCo$n*:z`b>iJh');

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
