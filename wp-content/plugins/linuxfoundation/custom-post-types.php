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
        $this->custom_post_types_options = get_option(
            "custom_post_types_option_name"
        ); ?>

		<div class="wrap">
			<h2>Custom Post Types</h2>
			<p>Linux Foundation Multisite(s) Custom Post Types</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
    settings_fields("custom_post_types_option_group");
    do_settings_sections("custom-post-types-admin");
    submit_button();?>
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
            "custom-post-types-admin" // page
        );

        add_settings_field(
            "projects_0", // id
            "Projects", // title
            [$this, "projects_0_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section" // section
        );

        add_settings_field(
            "webinars_1", // id
            "Webinars", // title
            [$this, "webinars_1_callback"], // callback
            "custom-post-types-admin", // page
            "custom_post_types_setting_section" // section
        );

        add_settings_field(
            "members_2", // id
            "Members", // title
            [$this, "members_2_callback"], // callback
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

        return $sanitary_values;
    }

    public function custom_post_types_section_info()
    {
    }

    public function projects_0_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[projects_0]" id="projects_0" value="projects_0" %s> <label for="projects_0">Projects Custom Post Type</label>',
            isset($this->custom_post_types_options["projects_0"]) &&
            $this->custom_post_types_options["projects_0"] === "projects_0"
                ? "checked"
                : ""
        );
    }

    public function webinars_1_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[webinars_1]" id="webinars_1" value="webinars_1" %s> <label for="webinars_1">Webinars Custom Post Type</label>',
            isset($this->custom_post_types_options["webinars_1"]) &&
            $this->custom_post_types_options["webinars_1"] === "webinars_1"
                ? "checked"
                : ""
        );
    }

    public function members_2_callback()
    {
        printf(
            '<input type="checkbox" name="custom_post_types_option_name[members_2]" id="members_2" value="members_2" %s> <label for="members_2">Members Custom Post Type</label>',
            isset($this->custom_post_types_options["members_2"]) &&
            $this->custom_post_types_options["members_2"] === "members_2"
                ? "checked"
                : ""
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
 */

$custom_post_types_options = get_option("custom_post_types_option_name");
$projects_0 = $custom_post_types_options["projects_0"];
$members_2 = $custom_post_types_options["members_2"];
$webinars_1 = $custom_post_types_options["webinars_1"];

if ($projects_0) {
    require_once plugin_dir_path(__DIR__) .
        "../themes/salient-child/custom-post-types/projects.php";
}

if ($webinars_1) {
    require_once plugin_dir_path(__DIR__) .
        "../themes/salient-child/custom-post-types/webinars.php";
}

if ($members_2) {
    require_once plugin_dir_path(__DIR__) .
        "../themes/salient-child/custom-post-types/members.php";
}
