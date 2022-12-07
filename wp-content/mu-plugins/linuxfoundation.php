<?php
/**
 * Plugin Name: Linux Foundation Custom Post Types
 * Plugin URI: https://linuxfoundation.org/
 * Description: Custom Post Type Manager
 * Version: 0.1
 * Author: Andrew Bringaze
 * Author URI: https://linuxfoundation.org/
 *
 */

if ( isset( $_ENV['PANTHEON_ENVIRONMENT'] ) ) {

	require_once 'linuxfoundation/linuxfoundation.php';

} // Ensuring that this is on Pantheon.
