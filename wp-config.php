<?php
/**
 * This config file is yours to hack on. It will work out of the box on Pantheon
 * but you may find there are a lot of neat tricks to be used here.
 *
 * See our documentation for more details:
 *
 * https://pantheon.io/docs
 */
/**
 * Pantheon platform settings. Everything you need should already be set.
 */
 
// REQUIRE WWW FOR OPENMV.ORG
if (isset($_SERVER['PANTHEON_ENVIRONMENT']) &&
  $_SERVER['PANTHEON_ENVIRONMENT'] === 'live') {
  if ($_SERVER['HTTP_HOST'] == 'openmv.org' ||
	  $_SERVER['HTTP_HOST'] == 'http://openmv.org/' ||
	  $_SERVER['HTTP_HOST'] == 'https://openmv.org/' ||
      $_SERVER['HTTP_HOST'] == 'http://metaverse.live-lfprojects3.linuxfoundation.org/') {
    header('HTTP/1.0 301 Moved Permanently');
    header('Location: https://www.openmv.org'. $_SERVER['REQUEST_URI']);
    exit();
  }
}

if (file_exists(dirname(__FILE__) . '/wp-config-pantheon.php') && isset($_ENV['PANTHEON_ENVIRONMENT'])) {
	require_once(dirname(__FILE__) . '/wp-config-pantheon.php');
/**
 * Local configuration information.
 *
 * If you are working in a local/desktop development environment and want to
 * keep your config separate, we recommend using a 'wp-config-local.php' file,
 * which you should also make sure you .gitignore.
 */
} elseif (file_exists(dirname(__FILE__) . '/wp-config-local.php') && !isset($_ENV['PANTHEON_ENVIRONMENT'])){
	# IMPORTANT: ensure your local config does not include wp-settings.php
	require_once(dirname(__FILE__) . '/wp-config-local.php');
/**
 * This block will be executed if you are NOT running on Pantheon and have NO
 * wp-config-local.php. Insert alternate config here if necessary.
 *
 * If you are only running on Pantheon, you can ignore this block.
 */
} else {
	define('DB_NAME',          'database_name');
	define('DB_USER',          'database_username');
	define('DB_PASSWORD',      'database_password');
	define('DB_HOST',          'database_host');
	define('DB_CHARSET',       'utf8');
	define('DB_COLLATE',       '');
	define('AUTH_KEY',         'put your unique phrase here');
	define('SECURE_AUTH_KEY',  'put your unique phrase here');
	define('LOGGED_IN_KEY',    'put your unique phrase here');
	define('NONCE_KEY',        'put your unique phrase here');
	define('AUTH_SALT',        'put your unique phrase here');
	define('SECURE_AUTH_SALT', 'put your unique phrase here');
	define('LOGGED_IN_SALT',   'put your unique phrase here');
	define('NONCE_SALT',       'put your unique phrase here');
}
/** Standard wp-config.php stuff from here on down. **/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * You may want to examine $_ENV['PANTHEON_ENVIRONMENT'] to set this to be
 * "true" in dev, but false in test and live.
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define('WP_DEBUG', false);
}
/* That's all, stop editing! Happy Pressing. */
/**** MULTISITE INFORMATION ****/
define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
$base = '/';
#define( 'DOMAIN_CURRENT_SITE', 'example.com' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
define('ADMIN_COOKIE_PATH', '/');
define('COOKIEPATH', '');
define('SITECOOKIEPATH', ''); 
/**
 * Define DOMAIN_CURRENT_SITE conditionally.
 */
if ( ! empty( $_ENV['PANTHEON_ENVIRONMENT'] ) ) {
  switch( $_ENV['PANTHEON_ENVIRONMENT'] ) {
    case 'live':
      // Value should be the primary domain for the Site Network.
      define( 'DOMAIN_CURRENT_SITE', 'live-lfprojects3.linuxfoundation.org' );
      // Once you map a domain to Live, you can change DOMAIN_CURRENT_SITE
      // define( 'DOMAIN_CURRENT_SITE', 'example-network.com' );
      break;
    case 'test':
      define( 'DOMAIN_CURRENT_SITE', 'test-lfprojects3.pantheonsite.io' );
      break;
    case 'dev':
      //define( 'DOMAIN_CURRENT_SITE', 'dev-lfprojects3.pantheonsite.io' );
	  define( 'DOMAIN_CURRENT_SITE', 'dev-lfprojects3.linuxfoundation.org' );
      break;
    default:
      # Catch-all to accommodate default naming for multi-dev environments.
      define( 'DOMAIN_CURRENT_SITE', $_ENV['PANTHEON_ENVIRONMENT'] . '-' . $_ENV['PANTHEON_SITE_NAME'] . '.pantheonsite.io' );
      break;
    }
}
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
/* ALLOW ALL FILE TYPES; EXAMPLE: SVG's */
define('ALLOW_UNFILTERED_UPLOADS', true);

/* ShortPixel API Key for all sites */
define('SHORTPIXEL_API_KEY', '9ZXJJsineYr76JNEt2JZ');