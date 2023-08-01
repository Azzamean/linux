<?php

/*
Plugin Name: Linux Foundation
Plugin URI: https://linuxfoundation.org/
Description: Options and Settings for Linux Foundation Multisite(s)
Version: 0.1
Author: Andrew Bringaze
Author URI: https://linuxfoundation.org/
License: GPL2
*/

// PLUGIN FOLDER URL
if (!defined('LINUX_FOUNDATION_PLUGIN_URL')) {
    define('LINUX_FOUNDATION_PLUGIN_URL', plugin_dir_url(__FILE__));
}

include_once 'includes/class-custom-post-types.php';
include_once 'includes/class-cache-headers.php';

//if (is_admin()) {

//}
