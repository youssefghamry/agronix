<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Agronix' );

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
define( 'AUTH_KEY',         '2T>ooq>)!63jeR3a>h]FXXzS*nnnNWYA}4j]1>F/9o142W(y>t Iz|9TbEQ]X@j#' );
define( 'SECURE_AUTH_KEY',  '!)hQF;Od)qnd|pg)Vg$Obx}{W_JItUWI}_Fd6HO&N_ `&L9gp0j?7%OL-aoV,ip9' );
define( 'LOGGED_IN_KEY',    'nQz2C0p1c;4}eNL#ZJ+N7^>XZu_JNQC/t[n)>@R2Ce+)!C#*l4[>+z`(jaKb Ol@' );
define( 'NONCE_KEY',        '`2[!Ki2!@xUWU6{Vb~ZVT+X6b{N_1tpsFD?Ll/_2x3p4)- kpnH_L|1M0m8WpaR9' );
define( 'AUTH_SALT',        'c}T3@+U0(TC<j>~{wDnYXpuw9.MZevJ^NbK9%RX<7W+%^>nVMN w#ZQ4+E+o4AFs' );
define( 'SECURE_AUTH_SALT', ')qm:OtYhX);yn-Dx5}?aT0HC#_Z]8l9DaJ=!N*O64&hxlyLhvXwor>HEPxnZm~da' );
define( 'LOGGED_IN_SALT',   '&#v @^Lto.;lg:9l^`C^FHoAYt:IS4#AZi%WIB))S$9Q$-/=6,1k7}+H3G%e$WV5' );
define( 'NONCE_SALT',       'BOKbZm!crq#yT3J>iy-<B,W}Rp,(W[jF:}FF#d?RhO3CgCzRTjX;`.I,Zf5E|_aT' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_Agronix';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
