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
define( 'DB_NAME', 'animation_studio' );

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
define( 'AUTH_KEY',         '082<`.(ROulN:IMf>Xy!&|Vrf-,op9I8Vr,=DtV=00etzAVi$M*Ji,]vk/M?%c(q' );
define( 'SECURE_AUTH_KEY',  ' y(}pN0,}s7X!rI4]Ub>5<l3k*_&5&q/c-(fN/]F)N0]A57ChMg#q;rYjFOXR_FN' );
define( 'LOGGED_IN_KEY',    '>%t=vgu{iXRpHN.,f[=guFvzkDmmHj.RjpJN]R51am_5JS?SPb1F5<_X`qO,h 1j' );
define( 'NONCE_KEY',        'Ue&f7d|g6Y/4w(8Gu:IGZQqTY[b[C%p*JCVtwqWcvES@}zdK<v}w15YbQ7m7Zj]y' );
define( 'AUTH_SALT',        ',hk03z ^h@NNn]HT=vI,H}epUo@#D/uVWj@9AJ;R:1h8wHtJ?=cNLyWs-.}>zBEY' );
define( 'SECURE_AUTH_SALT', 'sYyMq6l2q+FgO:]),2ESw{pTUkvw[I}XHHz>NnOB%Y!-.& ;U9%v~be#wp A{PH)' );
define( 'LOGGED_IN_SALT',   'A{hT@9>yZbt/h| #5y]YWvS7@Tm4lv~9vuH^X*&{hpGJR 2C(Q>aou7{XM8_b,iR' );
define( 'NONCE_SALT',       '#X,gxL(c}|5{pVrQ~0)&<m?OHO|c~c*/x.K?=F+-M]T84v^ TPX5CsT=X7ouy,ft' );

/**#@-*/

/**
 * WordPress database table prefix.
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
