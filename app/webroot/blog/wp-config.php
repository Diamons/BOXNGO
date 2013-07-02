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
define('DB_NAME', 'heroku_383599a029fd0dc');

/** MySQL database username */
define('DB_USER', 'b90ac7db6286eb');

/** MySQL database password */
define('DB_PASSWORD', 'eb3fb2d5');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-east-03.cleardb.com');

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
define('AUTH_KEY',         't$|{q5$J+%j$f-6b_aY,xenVb/7N`M!!L@7/2QMlyFpGG?+*gL~z$LFX3jDWKGXf');
define('SECURE_AUTH_KEY',  'K6 =Y-gIdI@y(M|ZhD1%|q4;zWLmUE142lD,pbd/m-jtnwlR$=N>,<^}uey(n-qe');
define('LOGGED_IN_KEY',    'iBp+Ko5s:LV[C[3Qx7Y2G(~cv0FTGIcg8T[SxnQeRII>j:NDT?]#pq,ho7_%kIgc');
define('NONCE_KEY',        'LKL4<1siOum8~u+FsWkh{Wyg~T=x=9ME^Wa;{zjxvh_LxSE0YuY$*j:|S1b2Xn71');
define('AUTH_SALT',        'tmEsa9;/GS<`a%H&Ro9R,q}bCO5fG$i*ZPJn1sA^5RIOQt5{#Lg-QBj79gb#vbG*');
define('SECURE_AUTH_SALT', 'T:eh#PHE1/J/?/s(%?o#z$](Ve2RjKf.BQ-b3Bs*QQ7]P.UJ/nrE<Kik#gpq581I');
define('LOGGED_IN_SALT',   'T0[HM%#:yNOfG?R59MX?:J4!ymGi5Ov0fE;#r8n7C#9KJ[ecmw_o@-6k[|6/[G/G');
define('NONCE_SALT',       'hVpf#o:2A^8*b% t=7K6Q-E1i_D8tz`zIaM|ixSu}/_,(JTPs3%g6f[o:xq`dMy[');

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
define('RELOCATE',true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
