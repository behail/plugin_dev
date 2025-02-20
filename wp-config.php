<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plugin_dev' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']),H+1sP2Li;fka$k/7WFMmsY^!<az:LLR`J#N5[RHF dd|<t)B>v#2*khF%D2}R' );
define( 'SECURE_AUTH_KEY',  'tSU:+dOpK+LUxXDZy6NTs)IW3WYrztS_KocWdc_ZBYhW1CU1IYed!wd^Ww0cvE}U' );
define( 'LOGGED_IN_KEY',    'R3$b}&-m|CJK>zE(kbOd@dBfD9V#q$D-MHk&bx=@v!J+Y$F{6+2dw&I5iMhr~9{f' );
define( 'NONCE_KEY',        'xgFFYMXf K?GXBH.DPFq*UdWL#dEH[v(&J[/d-f_&swR<H(bT#E4I,8,E/b=pXod' );
define( 'AUTH_SALT',        'CtD:%o2e@jf{V/;y<*48]pH>Hwf1m<%,.MZ9;6&r(5p0Ismu8_qw]Pb6Jls7K*i=' );
define( 'SECURE_AUTH_SALT', 'a=C8yl.6Enb?UX=0SX<qPE(PJA.1K&)V+Z+,vs^jbko:~1}}m{jO?zw;4=M;I*%P' );
define( 'LOGGED_IN_SALT',   '.pOr#%BL<X[=xEr^@<v%m)sS[%46TS[ZA^0P%0In{!EmcrAprLYGex:T,6.?7o)<' );
define( 'NONCE_SALT',       'BFS/CfwV$8e1rgON>&p%CN}1?9mKJABjN&RC~:d6.xQa@scpb=&VFVr<fW-qp7y$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
