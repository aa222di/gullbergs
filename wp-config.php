<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'eden');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '.nd2VFOSroUgxo7qzMt#Tge%gD948_|vBF>i),0/y&.Z`{fl+r[)okj4|D]/:k+c');
define('SECURE_AUTH_KEY',  'fIYqU9||wZdCx^L>/y+Ml-G~/{$>GWButJ99nB4+|)Y]~ZtDFh4$p|7zZXe(-AWj');
define('LOGGED_IN_KEY',    'N)2)o=fM;-6o^Mn{HLK&c5|=[dFp-C1/ZTK+nUdmgu8|V]__d5kXT^^5ryMV{[%3');
define('NONCE_KEY',        '2y?7a;?|_={BT@u]n>rk]tzBE2c5u8x+R{IeT]%G!(*/M3/dZvJiBc7$~H, .ExM');
define('AUTH_SALT',        'Ro{KcTm!$?#OC!$xO({{]XXgiL2|9$QPlj`9>,#^=k)yR=<XGEVFlT<{6N#Bi8Z5');
define('SECURE_AUTH_SALT', 'PqB#Xpc8[a{/}V{HEW3)(7+ -+gp>3J}oINj>m|hIjG~$2Vdm1mK1;@LZ|2mPBPR');
define('LOGGED_IN_SALT',   'gRvN|p}+Ux-5~I0<+LmU$miBi]_P(3s9r/r0r;pK;3J#)q4sJ~[PEJgz|0+}YG|k');
define('NONCE_SALT',       '-Txqk|vt*exk:rhqD14sCN`tQPa$BI&*=`AT5_OwKt#+h`lF<b>`O}v8!U:R5x$f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
