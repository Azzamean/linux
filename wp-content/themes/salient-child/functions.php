<?php
//remove_role( 'Super_Admin' );
//remove_role( 'Super Admin' );
//grant_super_admin(1);
//grant_super_admin(5);
/* Osano code for tracking */
/* SECURITY HEADERS */
function security_headers() {
    //header("Content-Security-Policy: default-src * self blob: data: gap:; style-src * self 'unsafe-inline' blob: data: gap:; script-src * 'self' 'unsafe-eval' 'unsafe-inline' blob: data: gap:; object-src * 'self' blob: data: gap:; img-src * self 'unsafe-inline' blob: data: gap:; connect-src self * 'unsafe-inline' blob: data: gap:; frame-src * self blob: data: gap:;");
    header("Content-Security-Policy: connect-src http://ip-api.com/ 'self' https: data:");
    header("Strict-Transport-Security: max-age=31536000");
    header("X-XSS-Protection: 1; mode=block");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("Referrer-Policy: no-referrer-when-downgrade");
    header('Permissions-Policy: geolocation=(self "https://example.com") microphone=() camera=()');
}
add_action("send_headers", "security_headers");
add_action("template_redirect", function () {
    ob_start();
});
add_action("wp_head", "osano_script");
function osano_script() {
?>
<script src="https://cmp.osano.com/16A0DbT9yDNIaQkvZ/3b49aaa9-15ab-4d47-a8fb-96cc25b5543c/osano.js"></script>
    <?php
}
// GET WP BAKERY CUSTOM MODULES; SOME MOVED TO LINUX FOUNDATION PLUGIN
require_once "vc-addons/recent-posts-linux.php";
//require_once "vc-addons/projects-linux.php";
//require_once "vc-addons/webinars-linux.php";
//require_once "vc-addons/members-linux.php";
//require_once "vc-addons/members-api-linux.php";
//require_once "vc-addons/projects-api-linux.php";
// GET WP BAKERY CUSTOM FIELDS
require_once "vc-addons/custom-fields/custom-fields.php";
// GET CUSTOM WIDGETS
require_once "widgets/single-posts-linux.php";
require_once "widgets/featured-items-linux.php";
require_once "widgets/testing-new-posts.php";
// GET CHILD THEME LIBRARIES
function salient_child_enqueue_styles() {
    $nectar_theme_version = nectar_get_theme_version();
    wp_enqueue_style("salient-child-style", get_stylesheet_directory_uri() . "/style.css", "", $nectar_theme_version);
    wp_enqueue_style("vc-addons-style", get_stylesheet_directory_uri() . "/vc-addons/css/vc-addons.css", "", $nectar_theme_version);
    wp_enqueue_style("templates-style", get_stylesheet_directory_uri() . "/templates/css/templates.css", "", $nectar_theme_version);
    wp_enqueue_style("widgets-style", get_stylesheet_directory_uri() . "/widgets/css/widgets.css", "", $nectar_theme_version);
    wp_enqueue_style("results-style", get_stylesheet_directory_uri() . "/search-filter/css/results.css", "", $nectar_theme_version);
    wp_enqueue_style("fonts-style", get_stylesheet_directory_uri() . "/fonts/fonts.css", "", $nectar_theme_version);
    if (is_rtl()) {
        wp_enqueue_style("salient-rtl", get_template_directory_uri() . "/rtl.css", [], "1", "screen");
    }
    wp_register_script("salient-child-javascript", get_stylesheet_directory_uri() . "/javascript.js", ["jquery"], "3.6.1", true);
    wp_enqueue_script("salient-child-javascript");
    //wp_enqueue_script('bringaze-font-awesome', 'https://kit.fontawesome.com/8511f9d0cf.js', false);
    
}
add_action("wp_enqueue_scripts", "salient_child_enqueue_styles", 100);
function enqueue_styles_projects_banner() {
    $nectar_theme_version = nectar_get_theme_version();
    wp_enqueue_style("projects-banner-style", get_stylesheet_directory_uri() . "/css/projects-banner.css", "", $nectar_theme_version);
}
// DISABLE PLUGIN NOTIFICATIONS
add_action("admin_enqueue_scripts", "acf_template_fields");
add_action("login_enqueue_scripts", "acf_template_fields");
function acf_template_fields() {
    wp_register_script("salient-child-acf-template-fields-javascript", get_stylesheet_directory_uri() . "/templates/js/templates.js", ["jquery"], "3.6.1", true);
    wp_enqueue_script("salient-child-acf-template-fields-javascript");
}
// CUSTOM POST TYPE TEMPLATES FROM A DIRECTORY
function custom_post_types_templates($template) {
    $post_types = ["projects", "webinars"];
    $defaultProjectsTemplate = locate_template("templates/single-projects.php");
    $defaultWebinarsTemplate = locate_template("templates/single-webinars.php");
    $templateSlug = get_page_template_slug(get_queried_object_id()); // this is null if no template name is given; hence default
    // PROJECTS
    if (is_singular("projects") && $defaultProjectsTemplate != "" && $templateSlug == null) {
        //if (is_singular($post_types) && !file_exists(get_stylesheet_directory() . "/single-projects.php") && get_page_template_slug(get_queried_object_id()) == null)
        $template = $defaultProjectsTemplate;
    }
    //if (is_post_type_archive($post_types) && !file_exists(get_stylesheet_directory() . "/archive-projects.php")){}
    // WEBINARS
    if (is_singular("webinars") && $defaultWebinarsTemplate != "" && $templateSlug == null) {
        $template = $defaultWebinarsTemplate;
    }
    return $template;
}
add_filter("template_include", "custom_post_types_templates");
// REDIRECT PANTHEON LOGIN TO WORK CORRECTLY
function redirect_pantheon_login() {
    if (strpos($_SERVER["REQUEST_URI"], "/wp-signup.php?") !== false) {
        wp_redirect("/wp-admin/");
        exit();
    }
}
add_action("init", "redirect_pantheon_login");
// ALLOW MIME TYPE UPLOADS; EXAMPLE: SVG's
function cc_mime_types($mimes) {
    $mimes["svg"] = "image/svg+xml";
    $mimes["svgz"] = "image/svg+xml";
    return $mimes;
}
add_filter("upload_mimes", "cc_mime_types");
add_filter("map_meta_cap", function ($caps, $cap, $user_id) {
    if ("unfiltered_upload" !== $cap) {
        return $caps;
    }
    if (user_can($user_id, "edit_others_posts")) {
        if (false !== ($key = array_search("do_not_allow", $caps))) {
            unset($caps[$key]);
        }
        $caps[] = "unfiltered_upload";
        $caps = array_values($caps);
    }
    return $caps;
}, 10, 3);
add_filter("user_has_cap", function ($allcaps, $caps) {
    if (!in_array("unfiltered_upload", $caps)) {
        return $allcaps;
    }
    $allcaps["unfiltered_upload"] = true;
    return $allcaps;
}, 10, 4);
// REMOVE COMMENTS FUNCTION; CAN BE PLACED IN A MU PLUGIN IF WANTED
function remove_comments() {
    add_action("admin_init", function () {
        // REDIRECT USERS TRYING TO ACCESS COMMENTS PAGE
        global $pagenow;
        if ($pagenow === "edit-comments.php" || $pagenow === "options-discussion.php") {
            wp_redirect(admin_url());
            exit();
        }
        // REMOVE COMMENTS METABOX FROM DASHBOARD
        remove_meta_box("dashboard_recent_comments", "dashboard", "normal");
        // DISABLE SUPPORT FOR COMMENTS AND TRACKBACKS IN POST TYPES
        foreach (get_post_types() as $post_type) {
            if (post_type_supports($post_type, "comments")) {
                remove_post_type_support($post_type, "comments");
                remove_post_type_support($post_type, "trackbacks");
            }
        }
    });
    // CLOSE COMMENTS ON THE FRONT-END
    add_filter("comments_open", "__return_false", 20, 2);
    add_filter("pings_open", "__return_false", 20, 2);
    // HIDE EXISTING COMMENTS
    add_filter("comments_array", "__return_empty_array", 10, 2);
    // REMOVE COMMENTS PAGE AND OPTION PAGE IN MENU
    add_action("admin_menu", function () {
        remove_menu_page("edit-comments.php");
        remove_submenu_page("options-general.php", "options-discussion.php");
    });
    // REMOVE COMMENTS LINK FROM ADMIN BAR
    add_action("add_admin_bar_menus", function () {
        remove_action("admin_bar_menu", "wp_admin_bar_comments_menu", 60);
    });
    // REMOVE COMMENTS FROM ADMIN BAR ON MULTISITE
    add_action("admin_bar_menu", "remove_toolbar_items", PHP_INT_MAX - 1);
    function remove_toolbar_items($bar) {
        // global $wp_admin_bar;
        // $wp_admin_bar->remove_node( 'blog-1-c' );
        $sites = get_blogs_of_user(get_current_user_id());
        foreach ($sites as $site) {
            $bar->remove_node("blog-{$site->userblog_id}-c");
        }
    }
}
// DEFAULT SETTINGS FOR ALL COMMENTS
function enable_comments_posts() {
    global $pagenow;
    if ("post.php" === $pagenow && isset($_GET["post"]) && "post" !== get_post_type($_GET["post"])) {
        remove_comments();
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET comment_status = 'open'")); // Enable comments
        $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET ping_status = 'open'")); // Enable trackbacks
        
    }
}
/*******
 * ADVANCED CUSTOM FIELDS
 *******/
// FIRST. REMOVE ALL POST FORMATS
function remove_posts_formats() {
    remove_theme_support("post-formats");
}
add_action("after_setup_theme", "remove_posts_formats", 11);
// SECOND. ADD IN WANTED POST FORMATS
function add_posts_formats() {
    add_theme_support("post-formats", ["standard", "link"]);
}
add_action("after_setup_theme", "add_posts_formats", 11);
// RENAME FORMATS APPROPRIATE
function rename_post_formats($translation, $text, $context, $domain) {
    $names = ["Standard" => "Normal", "Link" => "External Link"];
    if ($context == "Post format") {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter("gettext_with_context", "rename_post_formats", 10, 4);
// STYLE ACF BACKEND
function acf_admin_head() {
?>
    <style type="text/css">
    .acf-postbox h2.hndle.ui-sortable-handle {
        color: #ffffff;
        background: #3a67ff;
    }

    .acf-field .acf-label label {
        font-size: 14px;
        font-weight: 600;
        color: #000000;
    }

    .acf-field p.description {
        color: #999999;
        font-size: 12px;
        display: block;
        line-height: 20px;
        margin: 0px 0 0;
        font-weight: normal;
    }

    .video-settings {
        display: flex;
    }

    .video-settings.acf-field .acf-label {
        width: 33%;
        padding: 20px 10px 20px 0;
    }

    .video-settings.acf-field .acf-input {
        width: 100%;
        padding: 15px 10px;
    }

    .acf-postbox .acf-hndle-cog {
        display: none !important;
    }    
    </style>
    <?php
}
add_action("acf/input/admin_head", "acf_admin_head");
// HIDE ACF ADMIN MENU FROM BEING VIEWED IN DASHBOARD UNLESS SUPER ADMIN
if (!is_super_admin()) {
    add_filter("acf/settings/show_admin", "my_acf_settings_show_admin");
}
function my_acf_settings_show_admin($show_admin) {
    return false;
}
/*******
 * END OF ADVANCED CUSTOM FIELDS
 *******/
/*
add_filter( 'the_author', 'guest_author_name' );
add_filter( 'get_the_author_display_name', 'guest_author_name' );
 
function guest_author_name( $name ) {
global $post;
$post_id = get_queried_object_id();
$authorGuest = get_field( 'guest_author', $post_id );

$author = get_post_meta( $post->ID, $authorGuest, true );
 
if ( $authorGuest != null )
$name = $authorGuest;
 
return $name;
}

*/
/*
function salient_redux_custom_fonts()
{
    return [
        "Custom Fonts" => [
            "BwModelica-Bold" => "BwModelica-Bold",
            "BwModelica-BoldItalic" => "BwModelica-BoldItalic",
            "BwModelica-ExtraBold" => "BwModelica-ExtraBold",
            "BwModelica-ExtraBoldItalic" => "BwModelica-ExtraBoldItalic",
            "BwModelica-Light" => "BwModelica-Light",
            "BwModelica-LightItalic" => "BwModelica-LightItalic",
            "BwModelica-Medium" => "BwModelica-Medium",
            "BwModelica-MediumItalic" => "BwModelica-MediumItalic",
            "BwModelica-Regular" => "BwModelica-Regular",
            "BwModelica-RegularItalic" => "BwModelica-RegularItalic",
            "BwModelicaSS02-Regular" => "BwModelicaSS02-Regular",
            "BwModelicaSS02-RegularItalic" => "BwModelicaSS02-RegularItalic"
        ]
    ];
}
add_filter(
    "redux/salient_redux/field/typography/custom_fonts",
    "salient_redux_custom_fonts"
);
*/
// DEFAULT SCREEN OPTIONS
add_filter("hidden_meta_boxes", "custom_hidden_meta_boxes");
function custom_hidden_meta_boxes($hidden) {
    $hidden = ["wpb_wpbakery", "nectar-metabox-header-nav-transparency", "nectar-metabox-fullscreen-rows", "nectar-metabox-page-header", "postcustom", "revisionsdiv", "slugdiv", "authordiv", ];
    return $hidden;
}
// DISABLE PLUGIN NOTIFICATIONS
add_action("admin_enqueue_scripts", "turn_off_notifications");
add_action("login_enqueue_scripts", "turn_off_notifications");
function turn_off_notifications() {
    echo "<style>.update-nag, .updated, .error, .is-dismissible, .setting-error-tgmpa { display: none !important; }</style>";
    echo "<style>li#wp-admin-bar-my-sites ul#wp-admin-bar-my-sites-list {height: 500px !important; display: flex !important;flex-direction: column !important;flex-wrap: wrap !important;}</style>";
    echo "<style>ul#wp-admin-bar-my-sites-list {width: 700px;}</style>";
    echo "<style>#wpadminbar .menupop li.hover>.ab-sub-wrapper {z-index: 9999 !important;}#wpadminbar .ab-sub-wrapper,#wpadminbar ul,#wpadminbar ul li {z-index: inherit !important;}</style>";
}
// SHORTCODE FOR UBER MENU LOGO
if (in_array("ubermenu/ubermenu.php", apply_filters("active_plugins", get_option("active_plugins")))) {
    function uber_salient_logo($atts = []) {
        // ubermenu\pro\search.php
        // salient\nectar\helpers\header.php
        global $nectar_options;
        $nectar_logo_url = apply_filters("nectar_logo_url", esc_url(home_url()));
        return '<a id="logo" href="' . esc_url($nectar_logo_url) . '" data-supplied-ml-starting-dark="' . esc_attr($nectar_header_options["using_mobile_logo_starting_dark"]) . '" data-supplied-ml-starting="' . esc_attr($nectar_header_options["using_mobile_logo_starting"]) . '" data-supplied-ml="' . esc_attr($nectar_header_options["using_mobile_logo"]) . '" ' . wp_kses_post($nectar_header_options["logo_class"]) . ">" . '<img class="stnd skip-lazy' . $default_logo_class . $dark_default_class . '" width="' . nectar_logo_dimensions("width", $nectar_options["logo"]) . '" height="' . nectar_logo_dimensions("height", $nectar_options["logo"]) . '" alt="' . esc_html($salient_logo_text) . '" src="' . nectar_options_img($nectar_options["logo"]) . '" ' . $std_retina_srcset . " />" . "</a>";
    }
    add_shortcode("uber_logo", "uber_salient_logo");
    function uber_search_icon() {
        return '<a class="mobile-search" href="#searchbox"><span class="nectar-icon icon-salient-search" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__("search", "salient") . "</span></a>";
    }
    add_shortcode("uber_search", "uber_search_icon");
}
/* REDIRECT PAGES FOR THE POST FORMAT LINK */
function format_link_header() {
    //while (have_posts()) {
    ///the_post();
    if (has_post_format("link") && !is_category()) {
        global $post;
        global $nectar_options;
        $link = get_post_meta($post->ID, "_nectar_link", true);
        wp_redirect($link, 301);
        exit();
    }
    //}
    
}
add_action("wp_head", "format_link_header", 1);
/* SALIENT CUSTOM IMAGE SIZES */
/* FOR REFERENCE; VISIT
   wp-content\themes\salient\nectar\helpers\media.php
   https://themenectar.com/docs/salient/modify-image-sizes/
   https://rudrastyh.com/wordpress/image-sizes.html
   https://bloggerpilot.com/en/disable-wordpress-image-sizes/ 
*/
function remove_salient_custom_image_sizes() {
    remove_image_size("portfolio-thumb");
    remove_image_size("nectar_small_square");
    remove_image_size("portfolio-thumb_large");
    remove_image_size("portfolio-thumb_small");
    remove_image_size("portfolio-widget");
    remove_image_size("wide");
    remove_image_size("wide_photography");
    remove_image_size("wide_small");
    remove_image_size("regular");
    remove_image_size("regular_small");
    remove_image_size("tall");
    remove_image_size("wide_tall");
    remove_image_size("regular_photography");
    remove_image_size("regular_photography_small");
    remove_image_size("wide_tall_photography");
    remove_image_size("wide_photography_small");
    remove_image_size("large_featured");
    remove_image_size("medium_featured");
    remove_image_size("medium");
}
add_action("after_setup_theme", "remove_salient_custom_image_sizes", 11);
//print_r( get_intermediate_image_sizes() );
add_filter("intermediate_image_sizes", function ($sizes) {
    // return array_diff($sizes, ['thumbnail', 'medium', 'medium_large', 'large']);
    return array_diff($sizes, ["medium_large"]);
});
function remove_large_image_sizes() {
    remove_image_size("1536x1536");
    remove_image_size("2048x2048");
}
add_action("init", "remove_large_image_sizes");
/*************************/
/************************/
/* CODE FOR MULTISITES */
/**********************/
/*********************/
// GRABS SPECIFIC SUBSITES
$current_multisite = network_home_url();
$multisite_three_dev = "https://dev-lfprojects3.linuxfoundation.org/";
$multisite_three_live = "https://live-lfprojects3.linuxfoundation.org/";
$multisite_five_dev = "https://dev-lfprojects5.linuxfoundation.org/";
$multisite_five_live = "https://live-lfprojects5.linuxfoundation.org/";
$site_id;
if ((is_multisite() && $current_multisite == $multisite_three_dev) || (is_multisite() && $current_multisite == $multisite_three_live)) {
    $site_id = get_current_blog_id();
    switch ($site_id) {
            // CCC
            
        case "10":
            include_once "sites/ccc/functions.php";
        break;
            // O3D
            
        case "13":
            include_once "sites/o3d/functions.php";
        break;
            // NextArch
            
        case "15":
            include_once "sites/nextarch/functions.php";
        break;
            // Yocto
            
        case "32":
            include_once "sites/yocto/functions.php";
        break;
    }
}
// TOP LINUX FOUNDATION PROJECTS HEADER BANNER STRIP
function lf_meta_header_multisite_three() {
    $site_id = get_current_blog_id();
    $academy_software_foundation = '<div class="lfprojects awsf-background"><div class="container"><a href="https://www.aswf.io/projects/" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/aswf_banner_dark.svg" alt="The Linux Foundation Projects"></a></div></div>';
    $jdf_banner_light = '<div class="lfprojects white-background jdf"><div class="container"><a href="https://jointdevelopment.org/" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/jdf_banner_color.svg" alt="The Linux Foundation Projects"></a></div></div>';
    $jdf_banner_dark = '<div class="lfprojects dark-background jdf"><div class="container"><a href="https://jointdevelopment.org/" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/jdf_banner_light.svg" alt="The Linux Foundation Projects"></a></div></div>';
    $jdf_banner_light_alternative = '<div class="lfprojects dark-background jdf"><div class="container"><a href="https://jointdevelopment.org/" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/jdf_banner_light_alternative.svg" alt="The Linux Foundation Projects"></a></div></div>';
    $linux_foundation_light = '<div class="lfprojects blue-background"><div class="container"><a href="https://www.linuxfoundation.org/projects" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/lfprojects_banner_light.svg" alt="The Linux Foundation Projects"></a></div></div>';
    $linux_foundation_light_background = '<div class="lfprojects white-background"><div class="container"><a href="https://www.linuxfoundation.org/projects" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/lfprojects_banner_color.svg" alt="The Linux Foundation Projects"></a></div></div>';
    $linux_foundation_dark = '<div class="lfprojects"><div class="container"><a href="https://www.linuxfoundation.org/projects" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/lfprojects_banner_other.svg" alt="The Linux Foundation Projects"></a></div></div>';
    switch ($site_id) {
            // DPEL AWSF
            
        case "8":
            echo $academy_software_foundation;
        break;
            // OMPF
            
        case "14":
            echo $linux_foundation_light_background;
        break;
            // OVERTURE MAPS FOUNDATION
            
        case "16":
            echo $jdf_banner_light;
        break;
            // ULTRA ETHERNET
            
        case "20":
            echo $jdf_banner_dark;
        break;
            // AOUSD
            
        case "28":
            echo $jdf_banner_light_alternative;
        break;
            // SPDX
            
        case "31":
            echo $linux_foundation_light;
        break;
            // YOCTO
            
        case "32":
            echo $linux_foundation_light;
        break;
        default:
            echo $linux_foundation_dark;
    }
}
function lf_meta_header_multisite_five() {
    $linux_foundation_dark = '<div class="lfprojects"><div class="container"><a href="https://www.linuxfoundation.org/projects" target="_blank" rel="noopener noreferrer"><img src="/wp-content/uploads/banners/lfprojects_banner_other.svg" alt="The Linux Foundation Projects"></a></div></div>';
    echo $linux_foundation_dark;
}
// ALLOW EDITORS TO ACCESS THE APPEARANCE TAB AND ITS CHILDREN
function editor_appearance_access() {
    $roleObject = get_role("editor");
    if (!$roleObject->has_cap("edit_theme_options")) {
        $roleObject->add_cap("edit_theme_options");
    }
}
function editor_granted_appearance_access() {
    global $current_multisite;
    global $multisite_three_dev;
    global $multisite_three_live;
    if ((is_multisite() && $current_multisite == $multisite_three_dev) || (is_multisite() && $current_multisite == $multisite_three_live)) {
        $site_id = get_current_blog_id();
        // LF Energy
        if ($site_id == "18") {
            editor_appearance_access();
        }
    }
}
// LOGIC FOR COMMENTS ON SITES
function comments_logic() {
    global $current_multisite;
    global $multisite_three_dev;
    global $multisite_three_live;
	global $multisite_five_dev;
    global $multisite_five_live;
    if ((is_multisite() && $current_multisite == $multisite_three_dev) || (is_multisite() && $current_multisite == $multisite_three_live)) {
        $site_id = get_current_blog_id();
        // CCC
        if ($site_id != "10") {
            remove_comments();
        }
        if ($site_id == "10") {
            enable_comments_posts();
        }
    }
	else if ((is_multisite() && $current_multisite == $multisite_five_dev) || (is_multisite() && $current_multisite == $multisite_five_live)) {
            remove_comments();
	}
}
/* CAPABILITY FOR MULTISITE ADMIN USERS */
function ms_admin_users_caps($caps, $cap, $user_id, $args) {
    foreach ($caps as $key => $capability) {
        if ($capability != "do_not_allow") {
            continue;
        }
        switch ($cap) {
            case "edit_user":
            case "edit_users":
                $caps[$key] = "edit_users";
            break;
            case "delete_user":
            case "delete_users":
                $caps[$key] = "delete_users";
            break;
            case "create_users":
                $caps[$key] = $cap;
            break;
        }
    }
    return $caps;
}
/* PREVENTS ADMINS FROM DELETING SUPER ADMINS */
function ms_edit_permission_check() {
    global $current_user, $profileuser;
    $screen = get_current_screen();
    get_currentuserinfo();
    if (!is_super_admin($current_user->ID) && in_array($screen->base, ["user-edit", "user-edit-network"])) {
        // editing a user profile
        if (is_super_admin($profileuser->ID)) {
            // trying to edit a superadmin while less than a superadmin
            wp_die(__("You do not have permission to edit this user."));
        } elseif (!(is_user_member_of_blog($profileuser->ID, get_current_blog_id()) && is_user_member_of_blog($current_user->ID, get_current_blog_id()))) {
            // editing user and edited user aren't members of the same blog
            wp_die(__("You do not have permission to edit this user."));
        }
    }
}
/* REMOVE THE AVATAR PLUGIN FROM ADMIN MENU */
function wpdocs_remove_edit_menu() {
    if (!is_super_admin()) {
        remove_menu_page("one-user-avatar");
    }
}
/* GET DATA ON ADMIN MENU */
/*
function the_dramatist_debug_admin_menu() {
    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
}
add_action( 'admin_init', 'the_dramatist_debug_admin_menu' );
*/
/* GET PLUGIN BEING USED SITE ON A MULTISITE */
/*
$sites = get_sites();
foreach( $sites as $site ) {
    switch_to_blog( $site->blog_id );
    
    if( in_array( 'simple-banner/simple-banner.php', (array) get_option( 'active_plugins', array() ) ) ) {
            echo "Plugin is active on {$site->blogname}";
    }
    
    restore_current_blog();
}
*/
/**********************************/
/* MULTISITE LOGIC FOR FUNCTIONS */
/********************************/
if (is_multisite()) {
    editor_granted_appearance_access();
    comments_logic();
    add_filter("map_meta_cap", "ms_admin_users_caps", 1, 4);
    remove_all_filters("enable_edit_any_user_configuration");
    add_filter("enable_edit_any_user_configuration", "__return_true");
    add_filter("admin_head", "ms_edit_permission_check", 1, 4);
    if (function_exists("is_plugin_active") && is_plugin_active("one-user-avatar/one-user-avatar.php")) {
        add_action("admin_init", "wpdocs_remove_edit_menu");
    }
    add_action("wp_enqueue_scripts", "enqueue_styles_projects_banner", 101);
}
if (!is_multisite()) {
    remove_comments();
}
if ((is_multisite() && $current_multisite == $multisite_three_dev) || (is_multisite() && $current_multisite == $multisite_three_live)) {
    add_action("nectar_hook_after_body_open", "lf_meta_header_multisite_three", 10, 0);
}
if ((is_multisite() && $current_multisite == $multisite_five_dev) || (is_multisite() && $current_multisite == $multisite_five_live)) {
    add_action("nectar_hook_after_body_open", "lf_meta_header_multisite_five", 10, 0);
}