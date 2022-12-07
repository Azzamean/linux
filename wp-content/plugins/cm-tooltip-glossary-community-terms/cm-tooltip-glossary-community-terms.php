<?php

/*
  Plugin Name: CM Tooltip Glossary Community Terms
  Plugin URI: https://www.cminds.com/store/cm-tooltip-glossary-community-terms-cm-plugins-store/
  Description: An extension to the CM Tooltip Glossary Plugin which allows users to add own terms from the public site
  Version: 1.3.0
  Author: CreativeMindsSolutions
  Author URI: https://www.cminds.com/
 */

/**
 * Define Plugin Version
 * @since 1.0
 */
if (!defined('CMTCT_VERSION')) {
    define('CMTCT_VERSION', '1.3.0');
}

/**
 * Define Plugin Directory
 * @since 1.0
 */
if (!defined('CMTCT_PLUGIN_DIR')) {
    define('CMTCT_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

/**
 * Define Plugin URL
 * @since 1.0
 */
if (!defined('CMTCT_PLUGIN_URL')) {
    define('CMTCT_PLUGIN_URL', plugin_dir_url(__FILE__));
}

/**
 * Define Plugin File Name
 * @since 1.0
 */
if (!defined('CMTCT_PLUGIN_FILE')) {
    define('CMTCT_PLUGIN_FILE', __FILE__);
}

/**
 * Define Plugin File Name
 * @since 1.0
 */
if (!defined('CMTCT_PLUGIN_PREFIX')) {
    define('CMTCT_PLUGIN_PREFIX', 'cmttct');
}

/**
 * Define Plugin Slug name
 * @since 1.0
 */
if (!defined('CMTCT_SLUG_NAME')) {
    define('CMTCT_SLUG_NAME', 'cm-tooltip-glossary-community-terms');
}

/**
 * Define Plugin name
 * @since 1.0
 */
if (!defined('CMTCT_NAME')) {
    define('CMTCT_NAME', 'CM Tooltip Glossary Community Terms');
}

/**
 * Define Plugin name
 * @since 1.0
 */
if (!defined('CMTCT_CANONICAL_NAME')) {
    define('CMTCT_CANONICAL_NAME', 'CM Tooltip Glossary Community Terms');
}

/**
 * Define Plugin basename
 * @since 1.0
 */
if (!defined('CMTCT_PLUGIN')) {
    define('CMTCT_PLUGIN', plugin_basename(__FILE__));
}

/**
 * Define Plugin Views path
 */
if (!defined('CMTCT_PLUGIN_DIR_VIEWS_PATH')) {
    define('CMTCT_PLUGIN_DIR_VIEWS_PATH', plugin_dir_path(__FILE__) . 'views/');
}

/**
 * Define Plugin Views path
 */
if (!defined('CMTCT_PLUGIN_DIR_FRONTEND_SCRIPT_PATH')) {
    define('CMTCT_PLUGIN_DIR_FRONTEND_SCRIPT_PATH', plugin_dir_url(__FILE__) . 'views/frontend/assets/');
}

/**
 * Define Plugin name
 * @since 1.0
 */
if (!defined('CMTCT_RELEASE_NOTES')) {
    define('CMTCT_RELEASE_NOTES', 'http://tooltip.cminds.com/release-notes/');
}

if (!class_exists('\CM\CMTT_Settings')) {
    
} else {
// includes
    include_once CMTCT_PLUGIN_DIR . 'cm-tooltip-glossary-community-terms-base.php';
    include_once CMTCT_PLUGIN_DIR . 'cm-tooltip-glossary-community-terms-frontend.php';
    include_once CMTCT_PLUGIN_DIR . 'cm-tooltip-glossary-community-terms-backend.php';
    include_once CMTCT_PLUGIN_DIR . 'cm-tooltip-glossary-community-terms-dashboard-frontend.php';

// libs
    include_once CMTCT_PLUGIN_DIR . 'libs/autoload.php';
    include_once CMTCT_PLUGIN_DIR . 'libs/Notification.php';
    include_once CMTCT_PLUGIN_DIR . 'libs/Cookie.php';
    include_once CMTCT_PLUGIN_DIR . 'libs/recaptcha.php';
    include_once CMTCT_PLUGIN_DIR . 'package/cminds-pro.php';

    if (class_exists('CMTooltipCommunityTerms')) {
        // Installation and uninstallation hooks
        register_activation_hook(__FILE__, array('CMTooltipCommunityTerms', 'activate'));

        // instantiate the plugin class
        $CMTooltipCommunityTerms = CMTooltipCommunityTerms::getInstance();
    }

    if (class_exists('CMTooltipCommunityTermsDashboardFrontend')) {
        $CMTooltipCommunityTermsDashboardFrontend = CMTooltipCommunityTermsDashboardFrontend::getInstance();
    }

    /* Star-Rating */
    $star_rating_enabled = \CM\CMTT_Settings::get('cmttct_star_rating');

    if ($star_rating_enabled) {
        include_once plugin_dir_path(__FILE__) . 'libs/cm-star-rating.php';

        if (class_exists('CMTooltipGlossaryCommunityTermsStarRating')) {
            $CMTooltipGlossaryCommunityTermsStarRating = CMTooltipGlossaryCommunityTermsStarRating::getInstance();
        }
    }
}