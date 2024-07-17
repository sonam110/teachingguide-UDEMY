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
define('DB_NAME', 'wp_tgd');

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
define('AUTH_KEY',         '3l^$3gp[zQq_RU$zWM9k`$q%J4<ce +4`W[sc9J79N?dA5H)y8CyL)<C^t5zi1Zv');
define('SECURE_AUTH_KEY',  '~W*-?j86n(B|qNh%^8DU|HvhtMUe#yv>PQmzw_U58gKi!yv hyu$HjA9B#QDM^|k');
define('LOGGED_IN_KEY',    'a3~R+RY$^{LXKVZZ{yOsAAF@2?Z*wLkIB& jTDEV1uev#Tiaa*(W&EgKI&9$Q8E+');
define('NONCE_KEY',        ')W1{br6UYRm$AO4%2*|d>pB~EJ#&7XH@PxD-6eS*BF9>{P,.YQpw~J-hvIb(4<@L');
define('AUTH_SALT',        'Km;mM a!cPa88qQHR[%h:FNct|Kh:O@CS!tZG5`SX Vy~-r.Hr-z1AWaeT4]4:`C');
define('SECURE_AUTH_SALT', '#D&APq*}@WLvtw(EdL5jDlq.VS7[2#$roXKoC3DvUpaTq>f`VeKsH&=zX2Eu}LF-');
define('LOGGED_IN_SALT',   '79W%vo[Yc_6G+f=0*hU cz|ud+<Nj/Ni[4R0s@9szDcvYmn}MTCpx(@(yA[%J*m;');
define('NONCE_SALT',       '+n~b|7`nVtkyvnriT~#7~;~Y%,`S*ud-xbj;F(B n+jts(<#nJxsN=[{DryzM54T');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
