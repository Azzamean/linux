<?php
class CustomPostTypes
{
    private $custom_post_types_options;
    public function __construct()
    {
        add_action("admin_menu", [$this, "custom_post_types_add_plugin_page"]);
        add_action("admin_init", [$this, "custom_post_types_page_init"]);
    }
    public function custom_post_types_add_plugin_page()
    {
        add_dashboard_page(
            "Custom Post Types", // page_title
            "Custom Post Types", // menu_title
            "manage_options", // capability
            "custom-post-types", // menu_slug
            [$this, "custom_post_types_create_admin_page"] // function
        );
    }
    public function custom_post_types_create_admin_page()
    {
        $this->custom_post_types_options = get_option("custom_post_types_option_name"); ?>

        <div class="wrap">
            <h2>Custom Post Types</h2>
            <p>Linux Foundation Multisite(s) Custom Post Types</p>
        <?php settings_errors(); ?>

            <form method="post" action="options.php">
        <?php
        settings_fields("custom_post_types_option_group");
        do_settings_sections("custom-post-types-admin");
        submit_button(); ?>
            </form>
        </div>
        <?php
    }
    public function custom_post_types_page_init()
    {
        register_setting(
            "custom_post_types_option_group", // option_group
            "custom_post_types_option_name", // option_name
            [$this, "custom_post_types_sanitize"] // sanitize_callback
        );
        add_settings_section(
            "custom_post_types_setting_section", // id
            "Settings", // title
            [$this, "custom_post_types_section_info"], // callback
            "custom-post-types-admin"
            // page
        );
        add_settings_field(
            "projects_0", // id
            "Projects", // title
            [$this, "projects_0_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section"
            // section
        );
        add_settings_field(
            "webinars_1", // id
            "Webinars", // title
            [$this, "webinars_1_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section"
            // section
        );
        add_settings_field(
            "members_2", // id
            "Members", // title
            [$this, "members_2_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section"
            // section
        );
        add_settings_field(
            "persons_3", // id
            "Persons", // title
            [$this, "persons_3_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section"
            // section
        );
        add_settings_field(
            "working_groups_4", // id
            "Working Groups", // title
            [$this, "working_groups_4_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section" // section
        );
        add_settings_field(
            "vendors_5", // id
            "Vendors", // title
            [$this, "vendors_5_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section" // section
        );


    }
    public function custom_post_types_sanitize($input)
    {
        $sanitary_values = [];
        if (isset($input["projects_0"])) {
            $sanitary_values["projects_0"] = $input["projects_0"];
        }
        if (isset($input["webinars_1"])) {
            $sanitary_values["webinars_1"] = $input["webinars_1"];
        }
        if (isset($input["members_2"])) {
            $sanitary_values["members_2"] = $input["members_2"];
        }
        if (isset($input["persons_3"])) {
            $sanitary_values["persons_3"] = $input["persons_3"];
        }
        if (isset($input["working_groups_4"])) {
            $sanitary_values["working_groups_4"] = $input["working_groups_4"];
        }
        if (isset($input["vendors_5"])) {
            $sanitary_values["vendors_5"] = $input["vendors_5"];
        }      
        return $sanitary_values;
    }
    public function custom_post_types_section_info()
    {
    }
    public function projects_0_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[projects_0]" id="projects_0" value="projects_0" %s> <label for="projects_0">Projects Custom Post Type</label>', 
            isset($this->custom_post_types_options["projects_0"]) && $this->custom_post_types_options["projects_0"] === "projects_0" ? "checked" : ""
        );
    }
    public function webinars_1_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[webinars_1]" id="webinars_1" value="webinars_1" %s> <label for="webinars_1">Webinars Custom Post Type</label>', 
            isset($this->custom_post_types_options["webinars_1"]) && $this->custom_post_types_options["webinars_1"] === "webinars_1" ? "checked" : ""
        );
    }
    public function members_2_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[members_2]" id="members_2" value="members_2" %s> <label for="members_2">Members Custom Post Type</label>', 
            isset($this->custom_post_types_options["members_2"]) && $this->custom_post_types_options["members_2"] === "members_2" ? "checked" : ""
        );
    }
    public function persons_3_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[persons_3]" id="persons_3" value="persons_3" %s> <label for="persons_3">Persons Custom Post Type</label>', 
            isset($this->custom_post_types_options["persons_3"]) && $this->custom_post_types_options["persons_3"] === "persons_3" ? "checked" : ""
        );
    }
    public function working_groups_4_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[working_groups_4]" id="working_groups_4" value="working_groups_4" %s> <label for="working_groups_4">Working Groups Custom Post Type</label>',
            isset($this->custom_post_types_options["working_groups_4"]) &&
            $this->custom_post_types_options["working_groups_4"] === "working_groups_4" ? "checked" : ""
        );
    }
    public function vendors_5_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[vendors_5]" id="vendors_5" value="vendors_5" %s> <label for="vendors_5">Vendors Custom Post Type</label>',
            isset($this->custom_post_types_options["vendors_5"]) &&
            $this->custom_post_types_options["vendors_5"] === "vendors_5" ? "checked" : ""
        );
    }    
}
if (is_admin()) {
    $custom_post_types = new CustomPostTypes();
}
/*
 * Retrieve this value with:
 * $custom_post_types_options = get_option( 'custom_post_types_option_name' ); // Array of All Options
 * $projects_0 = $custom_post_types_options['projects_0']; // Projects
 * $webinars_1 = $custom_post_types_options['webinars_1']; // Working Groups
 * $members_2 = $custom_post_types_options['members_2']; // Webinars
 * $persons_3 = $custom_post_types_options['persons_3']; // Persons
 * $working_groups_4 = $custom_post_types_options['working_groups_4']; // Working Groups 
 * $vendors_5 = $custom_post_types_options['vendors_5']; // Vendors
*/
$custom_post_types_options = get_option("custom_post_types_option_name");
if (is_array($custom_post_types_options) && array_key_exists("projects_0", $custom_post_types_options)) {
    $projects_0 = $custom_post_types_options["projects_0"];
    if ($projects_0) {
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/custom-post-types/projects.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/projects-linux.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/projects-api-linux.php";
    }
}
if (is_array($custom_post_types_options) && array_key_exists("webinars_1", $custom_post_types_options)) {
    $webinars_1 = $custom_post_types_options["webinars_1"];
    if ($webinars_1) {
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/custom-post-types/webinars.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/webinars-linux.php";
    }
}
if (is_array($custom_post_types_options) && array_key_exists("members_2", $custom_post_types_options)) {
    $members_2 = $custom_post_types_options["members_2"];
    if ($members_2) {
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/custom-post-types/members.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/members-linux.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/members-api-linux.php";
    }
}
if (is_array($custom_post_types_options) && array_key_exists("persons_3", $custom_post_types_options)) {
    $persons_3 = $custom_post_types_options["persons_3"];
    if ($persons_3) {
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/custom-post-types/persons.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/persons.php";
        wp_enqueue_style("salient-child-featherlight-style", get_stylesheet_directory_uri() . "/vc-addons/css/featherlight.css", "", $nectar_theme_version);
        wp_register_script("salient-child-featherlight-script", get_stylesheet_directory_uri() . "/vc-addons/js/featherlight.js", ["jquery"], "3.6.1", true);
        wp_enqueue_script("salient-child-featherlight-script");     
    }
}
if (is_array($custom_post_types_options) 
    && array_key_exists("working_groups_4", $custom_post_types_options)
) {
    $working_groups_4 = $custom_post_types_options["working_groups_4"];
    if ($working_groups_4) {
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/custom-post-types/working-groups.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/working-groups-linux.php";
    }
}
if (is_array($custom_post_types_options) 
    && array_key_exists("vendors_5", $custom_post_types_options)
) {
    $working_groups_4 = $custom_post_types_options["vendors_5"];
    if ($working_groups_4) {
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/custom-post-types/vendors.php";
        include_once plugin_dir_path(__DIR__) . "../../themes/salient-child/vc-addons/vendors-linux.php";
       
        // FEATHERLIGHT
        wp_enqueue_style("salient-child-featherlight-style", get_stylesheet_directory_uri() . "/vc-addons/css/featherlight.css", "", $nectar_theme_version);
        wp_register_script("salient-child-featherlight-script", get_stylesheet_directory_uri() . "/vc-addons/js/featherlight.js", ["jquery"], "3.6.1", true);
        wp_enqueue_script("salient-child-featherlight-script");  
        
        // MIXITUP
        wp_enqueue_script('salient-child-mixitup-script', get_stylesheet_directory_uri() . '/vc-addons/js/mixitup.min.js', array(), false, true);               
        wp_enqueue_script('salient-child-mixitup-multifilter-script', get_stylesheet_directory_uri() . '/vc-addons/js/mixitup-multifilter.min.js', array(), false, true);   

        // CUSTOM FILTERING
        wp_enqueue_script('custom-zephyr-js-ten', get_stylesheet_directory_uri() . '/vc-addons/js/vendors.js', array(), false, true); 
    }
}
