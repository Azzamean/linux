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
    wp_enqueue_style("salient-child-style", get_stylesheet_directory_uri() . "/style.css", "", $nectar_theme_version);
    wp_enqueue_style("vc-addons-style", get_stylesheet_directory_uri() . "/vc-addons/vc-addons.css", "", $nectar_theme_version);
    //wp_enqueue_script('bringaze-font-awesome', 'https://kit.fontawesome.com/8511f9d0cf.js', false);
    if (is_rtl())
    {
        wp_enqueue_style("salient-rtl", get_template_directory_uri() . "/rtl.css", [], "1", "screen");
    }
}
add_action("wp_enqueue_scripts", "salient_child_enqueue_styles", 100);

// CUSTOM POST TYPE TEMPLATES FROM A DIRECTORY
function custom_post_types_templates($template)
{
    $post_types = ["projects"];

    if (is_post_type_archive($post_types) && !file_exists(get_stylesheet_directory() . "/archive-projects.php"))
    {
        $template = "/code/wp-content/themes/salient-child/templates/archive-projects.php";
    }

    if (is_singular($post_types) && !file_exists(get_stylesheet_directory() . "/single-projects.php") && get_page_template_slug(get_queried_object_id()) == null)
    {
        $template = "/code/wp-content/themes/salient-child/templates/single-projects.php";
    }

    //if (is_singular($post_types) && !file_exists(get_stylesheet_directory() . "/single-projects-info.php") && get_page_template_slug(get_queried_object_id()) != null)
    //{
    //    $template = "/code/wp-content/themes/salient-child/" . get_page_template_slug(get_queried_object_id());
    //}

    return $template;
}
add_filter("template_include", "custom_post_types_templates");

// REDIRECT PANTHEON LOGIN TO WORK CORRECTLY
function redirect_pantheon_login()
{
    if (strpos($_SERVER["REQUEST_URI"], "/wp-signup.php?") !== false)
    {
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

// REMOVE COMMENTS FUNCTION; CAN BE PLACED IN A MU PLUGIN IF WANTED
add_action('admin_init', function ()
{
    // REDIRECT USERS TRYING TO ACCESS COMMENTS PAGE
    global $pagenow;

    if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php')
    {
        wp_redirect(admin_url());
        exit;
    }

    // REMOVE COMMENTS METABOX FROM DASHBOARD
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // DISABLE SUPPORT FOR COMMENTS AND TRACKBACKS IN POST TYPES
    foreach (get_post_types() as $post_type)
    {
        if (post_type_supports($post_type, 'comments'))
        {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// CLOSE COMMENTS ON THE FRONT-END
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// HIDE EXISTING COMMENTS
add_filter('comments_array', '__return_empty_array', 10, 2);

// REMOVE COMMENTS PAGE AND OPTION PAGE IN MENU
add_action('admin_menu', function ()
{
    remove_menu_page('edit-comments.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
});

// REMOVE COMMENTS LINK FROM ADMIN BAR
add_action('add_admin_bar_menus', function ()
{
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
});

// REMOVE COMMENTS FROM ADMIN BAR ON MULTISITE
add_action('admin_bar_menu', 'remove_toolbar_items', PHP_INT_MAX - 1);
function remove_toolbar_items($bar)
{
    // global $wp_admin_bar;
    // $wp_admin_bar->remove_node( 'blog-1-c' );
    $sites = get_blogs_of_user(get_current_user_id());
    foreach ($sites as $site)
    {
        $bar->remove_node("blog-{$site->userblog_id}-c");
    }
}

