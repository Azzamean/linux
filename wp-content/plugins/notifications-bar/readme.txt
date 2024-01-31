=== Notifications Plugin ===
Contributors: Andrew Bringaze
Tags: notifications bar
Requires at least: 5.8
Tested up to: 6.4.3
Stable tag: 6.4.3
License: GPLv2 or later

The best anti-spam protection to block spam comments and spam in a contact form. The most trusted antispam solution for WordPress and WooCommerce.

== Description ==

Custom notification bar for Linux Foundation Project sites using the Salient theme. 

This notifications bar appears at the top of your projects site under the Linux Foundation Projects banner. 

== Installation ==

Upload the Notifications Bar Plugin to your Multisite and upload the custom header.php file to the Salient Child theme.

The custom header.php file includes:

<?php 
// CHECK IF NOTIFICATIONS BAR PLUGIN IS ACTIVE
if (is_plugin_active('notifications-bar/notifications-bar.php')) {
	notification_bar_display();
}
?>

Right after the '#header-outer' element.		
		
== Changelog ==

= 1.3 =
*Release Date - 31 January 2024*

* Hides navigation bar if the text is blank

= 1.2 =
*Release Date - 30 January 2024*

* Integration with the Salien Navigation height adjustment