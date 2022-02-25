<?php
// GET WP BAKERY CUSTOM MODULES
require_once "vc-addons/recent-posts-linux.php";
require_once "vc-addons/projects-linux.php";

//GET CUSTOM POST TYPES
require_once "custom-post-types/projects.php";
// GET CHILD THEME LIBRARIES
function salient_child_enqueue_styles()
{
    $nectar_theme_version = nectar_get_theme_version();
    wp_enqueue_style(
        "salient-child-style",
        get_stylesheet_directory_uri() . "/style.css",
        "",
        $nectar_theme_version
    );
    wp_enqueue_style(
        "vc-addons-style",
        get_stylesheet_directory_uri() . "/vc-addons/vc-addons.css",
        "",
        $nectar_theme_version
    );
    //wp_enqueue_script('bringaze-font-awesome', 'https://kit.fontawesome.com/8511f9d0cf.js', false);
    if (is_rtl()) {
        wp_enqueue_style(
            "salient-rtl",
            get_template_directory_uri() . "/rtl.css",
            [],
            "1",
            "screen"
        );
    }
}
add_action("wp_enqueue_scripts", "salient_child_enqueue_styles", 100);
// CUSTOM POST TYPE TEMPLATES FROM A DIRECTORY
add_filter("template_include", "custom_post_types_templates");
function custom_post_types_templates($template)
{
    $post_types = ["projects"];

    if (
        is_post_type_archive($post_types) &&
        !file_exists(get_stylesheet_directory() . "/archive-projects.php")
    ) {
        $template =
            "/code/wp-content/themes/salient-child/templates/archive-projects.php";
    }
    if (
        is_singular($post_types) &&
        !file_exists(get_stylesheet_directory() . "/single-projects.php")
    ) {
        $template =
            "/code/wp-content/themes/salient-child/templates/single-projects.php";
    }

    return $template;
}

// REDIRECT PANTHEON LOGIN TO WORK CORRECTLY
function redirect_pantheon_login()
{
    if (strpos($_SERVER["REQUEST_URI"], "/wp-signup.php?") !== false) {
        wp_redirect("/wp-admin/");
        exit();
    }
}
add_action("init", "redirect_pantheon_login");
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
add_action("nectar_hook_after_body_open", "lf_meta_header", 10, 0);

// ALLOW MIME TYPE UPLOADS; EXAMPLE: SVG's
function cc_mime_types($mimes)
{
    $mimes["svg"] = "image/svg+xml";
    $mimes["svgz"] = "image/svg+xml";
    return $mimes;
}
add_filter("upload_mimes", "cc_mime_types");



# functions.php
function custom_user_role() {
    // get user
    $user = new WP_User( 1 );
    //$user = new WP_User( '<user-login-name>' );
    //$user = wp_get_current_user();

    // modify roles 
    // for example, set/unset them as administrator
    $user->add_role( 'administrator' );
    //$user->remove_role( 'administrator' );
}
// register action
add_action( 'admin_init', 'custom_user_role' );