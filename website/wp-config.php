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
define('DB_NAME', 'stylzt_com');

/** MySQL database username */
define('DB_USER', 'stylztcom');

/** MySQL database password */
define('DB_PASSWORD', 'BK4phRdL');

/** MySQL hostname */
define('DB_HOST', 'mysql.stylzt.com');

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
define('AUTH_KEY',         '2Ow#8GV8(+wWkFVw7`Sb&U%dW*$C^#0phlvY+ZOJUB8T7"H"jZLPqhlEaSJ~1#Xv');
define('SECURE_AUTH_KEY',  'F)G84zrTy:GWlJnDu+jcUWRzDL"k0lRCwHJz#;`&chD2_0c#T)xJlpe_i6w%b0Xs');
define('LOGGED_IN_KEY',    'yhl:B_nvkCTHm~DPky"9Ku1uNeH2(M#~;oWta1y/xNKh6Z/Ia$88IC*G3e0I^tAJ');
define('NONCE_KEY',        'P4+yz4yEtyjF*Yhs&vPq"tn|YT#C?_?S2D)w(Nqw0J5B`#&fy~"h04bkQr9cT2Q2');
define('AUTH_SALT',        '7Ir0o%nq!XX52(oMD7%Omus^0%+nY1M9z#bc:n4#VebGB@F|DXu!BKYm#*Ve&naj');
define('SECURE_AUTH_SALT', 'UZ)A:r|Ir5w?NWcC6Ou5/hue)@B*IFv~B(Q$"UY!gl4$Fs0FO8bpOm6YR%7kLtuA');
define('LOGGED_IN_SALT',   'JV93q+fQE:Pd9%Tb^L2@)vDDZ*dqBk|hhESZ!Tq4vqZ+U6xIsj)V_/T2jGk^n&w)');
define('NONCE_SALT',       'heY?tb!T0%mbSVr`_~"Fh$5G8!dZeEnr`TAa3qpe6+:_GCtH62q;eaiuzGeI@FY(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_ewfivp_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

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

