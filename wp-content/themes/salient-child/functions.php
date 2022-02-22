<?php
// GET WP BAKERY CUSTOM MODULES
require_once 'vc_addons/recent_posts_linux.php';
require_once 'vc_addons/projects_linux.php';

//GET CUSTOM POST TYPES
require_once 'custom_post_types/projects.php';
// GET CHILD THEME LIBRARIES
function salient_child_enqueue_styles()
{
    $nectar_theme_version = nectar_get_theme_version();
    wp_enqueue_style('salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version);
    wp_enqueue_style('vc-addons-style', get_stylesheet_directory_uri() . '/vc_addons/vc_addons.css', '', $nectar_theme_version);
    //wp_enqueue_script('bringaze-font-awesome', 'https://kit.fontawesome.com/8511f9d0cf.js', false);
    if (is_rtl())
    {
        wp_enqueue_style('salient-rtl', get_template_directory_uri() . '/rtl.css', array() , '1', 'screen');
    }
}
add_action('wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);

// TOP LINUX FOUNDATION PROJECTS HEADER BANNER STRIP
function lf_meta_header()
{
    echo '
  	<div class="lfprojects">
		<div class="container">
			<a href="https://www.linuxfoundation.org/projects" target="_blank" rel="noopener noreferrer"><img src="http://dev-lfprojects3.pantheonsite.io/wp-content/uploads/2022/01/lfprojects_banner.png"></a>
		</div>
	</div>
';
}
add_action('nectar_hook_after_body_open', 'lf_meta_header', 10, 0);

// ALLOW MIME TYPE UPLOADS; EXAMPLE: SVG's
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// REDIRECT PANTHEON LOGIN TO WORK CORRECTLY
function redirect_pantheon_login()
{
    if (strpos($_SERVER['REQUEST_URI'], '/wp-signup.php?') !== false)
    {
        wp_redirect('/wp-admin/');
        exit;
    }
}
add_action('init', 'redirect_pantheon_login');

?>
