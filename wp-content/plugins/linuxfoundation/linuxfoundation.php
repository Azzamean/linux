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

if (is_admin()) {
    include_once('custom-post-types.php');
}
