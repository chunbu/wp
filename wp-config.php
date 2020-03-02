<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('FTP_USER', 'root');

define('FTP_PASS', '');

define('FTP_HOST', 'localhost');

define( 'DB_NAME', 'demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'L8 3wF(|;~I[Ih/+;[:4KhGmBVw=6|w8=}79aDIJY=w3oGRPH(vBkI6$`9>I0w:4' );
define( 'SECURE_AUTH_KEY',  '+<)tZ<zc+Dr?!W`1y(hLfnmM1DO8cXpGoM:--jL5((<:sek))z~^u#R94u;U{suv' );
define( 'LOGGED_IN_KEY',    ')m1[DyIia,zZKtn&{6EZe]Dl*X50f3tgp?W/e5a%5e&X5i<[v:#PZ({E_+DJfps)' );
define( 'NONCE_KEY',        '0_BIQy?p!rKxJNe1f3sy`.%.pi44rp@{eCG~&q5=iubdak[F!}+a^Y0c*|(QC~,Q' );
define( 'AUTH_SALT',        'Ci@p)*b/&Ef#h*[p9G i$V;ZQAhj}uCw%s;UyH2A_XkV~(^mAc)DCX~Z/1!,ppv8' );
define( 'SECURE_AUTH_SALT', 'aP,MK~xhMOmWbg[l3q%g^w|UotdhMDii^|Xc>,rhm>bR]qgL4XG((b4i4QVIv[wM' );
define( 'LOGGED_IN_SALT',   '&|/9b=n:c@{;C`&X$F`/T?A~0&gKmgT NNE<*o-VtJkV}jAyi4N@0a6+bmx}_K;:' );
define( 'NONCE_SALT',       '?P`HCq}vUbd-+10UV(bB*Ot8v1XRmJ]mdgm(+6P O#_|&E3+jPnqTkE[_Rm7xt.*' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
