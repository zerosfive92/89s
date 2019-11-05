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
define( 'DB_NAME', '89sdb' );

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
define( 'AUTH_KEY',         'lF7KMn8~|%2s5]f%QCUn9]0rvz$kIHM;j(XbVDWtfBgA93[i6^eQ=j=#.]]p!cYc' );
define( 'SECURE_AUTH_KEY',  'Ue;B(XYf=JNkQ0uPKWXA!C 8tpxdhCtUqi/CT,=zxoqOIb(>m-PL:i&a<: %r}wL' );
define( 'LOGGED_IN_KEY',    'S&YKMdW_{s/bwo^2<pt4OVHnS&ZYkvCqoTR3<zB|vz+S8;f`w=7HH(A,]1Zurqn|' );
define( 'NONCE_KEY',        'dtxIy&uiv:fn@  Z+`ybs0&4@k`?Qua)f1p#vS`GM`(+]0Hy[a!tc*)`iih8a(.l' );
define( 'AUTH_SALT',        '&WuRll;d&:L/]54zSDS<jWmVMQPr}_}2b>|~yZDlpc]o&?08NP@G`sKe9J].n`Ne' );
define( 'SECURE_AUTH_SALT', '2~1F54@kKcO#2GPUPy}p[SvOXPyum1gj~kPyghAR-6,:?k$Ma<:$G JhevMuIOze' );
define( 'LOGGED_IN_SALT',   ',%^8$|)cXHHiu/%E)mc]$GS9|.S j)N=Fr,5Uw+1gLB5IiIrE5{5DmZ]f;6:5vsQ' );
define( 'NONCE_SALT',       'o/%oxxM,q>}WuiA1?mr4fQz}N0E8%Cwl9Tu5/0fe%Z$i+]}6dM.8 fCVP*mc3h<c' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '89s_';

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
