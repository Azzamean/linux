<?php

function cptui_register_my_cpts_projects()
{
    /**
     * Post Type: Projects.
     */

    $labels = [
        "name" => __("Projects", "custom-post-type-ui"),
        "singular_name" => __("Project", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Projects", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "projects", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-page",
        "supports" => ["title", "author"],
        "taxonomies" => ["projects_category"],
        "show_in_graphql" => false,
    ];

    register_post_type("projects", $args);
}

add_action("init", "cptui_register_my_cpts_projects");

function cptui_register_my_taxes_projects_category()
{
    /**
     * Taxonomy: Projects Categories.
     */

    $labels = [
        "name" => __("Projects Categories", "custom-post-type-ui"),
        "singular_name" => __("Project Category", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Projects Categories", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true, // this makes it a checkbox or like a regular tag
        "hierarchical" => true,
        "show_ui" => false, // This hides it on the left admin dashboard and on singles
        "show_in_menu" => true, // This hides it on the left admin dashboard
        "show_in_nav_menus" => false,
        "query_var" => true,
        "rewrite" => ["slug" => "projects_category", "with_front" => true],
        "show_admin_column" => false, // This hides in on the main projects page's list view
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "projects_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("projects_category", ["projects"], $args);
}
add_action("init", "cptui_register_my_taxes_projects_category");

function cptui_register_my_taxes_projects_stage()
{
    /**
     * Taxonomy: Projects Stages.
     */

    $labels = [
        "name" => __("Projects Stages", "custom-post-type-ui"),
        "singular_name" => __("Project Stage", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Projects Stages", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ["slug" => "projects_stage", "with_front" => true],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "projects_stage",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("projects_stage", ["projects"], $args);
}
add_action("init", "cptui_register_my_taxes_projects_stage");

if (function_exists("acf_add_local_field_group")):
    acf_add_local_field_group([
        "key" => "group_63a0d06a0a370",
        "title" => "Projects",
        "fields" => [
            [
                "key" => "field_63a0d0859f3d6",
                "label" => "Logo",
                "name" => "projects_logo",
                "aria-label" => "",
                "type" => "image",
                "instructions" =>
                    "Please select the primary logo (this will be used on the posts display preview)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "50",
                    "class" => "",
                    "id" => "",
                ],
                "return_format" => "url",
                "library" => "all",
                "min_width" => "",
                "min_height" => "",
                "min_size" => "",
                "max_width" => "",
                "max_height" => "",
                "max_size" => "",
                "mime_types" => "",
                "preview_size" => "medium",
            ],
            [
                "key" => "field_63a0d11dc11a1",
                "label" => "Secondary Logo",
                "name" => "projects_secondary_logo",
                "aria-label" => "",
                "type" => "image",
                "instructions" =>
                    "Please select the secondary logo (this is an alternative logo used for the banner)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "50",
                    "class" => "",
                    "id" => "",
                ],
                "return_format" => "url",
                "library" => "all",
                "min_width" => "",
                "min_height" => "",
                "min_size" => "",
                "max_width" => "",
                "max_height" => "",
                "max_size" => "",
                "mime_types" => "",
                "preview_size" => "medium",
            ],
            [
                "key" => "field_63a203137b17e",
                "label" => "Header",
                "name" => "projects_header",
                "aria-label" => "",
                "type" => "radio",
                "instructions" => "Use a logo instead of the page title",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "choices" => [
                    "Title" => "Title",
                    "Logo" => "Logo",
                    "Secondary Logo" => "Secondary Logo",
                ],
                "default_value" => "Page Title",
                "return_format" => "value",
                "allow_null" => 0,
                "other_choice" => 0,
                "layout" => "vertical",
                "save_other_choice" => 0,
            ],
            [
                "key" => "field_63a0d144c11a2",
                "label" => "Banner",
                "name" => "projects_banner",
                "aria-label" => "",
                "type" => "image",
                "instructions" =>
                    "Please select the projects banner background image",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "50",
                    "class" => "",
                    "id" => "",
                ],
                "return_format" => "url",
                "library" => "all",
                "min_width" => "",
                "min_height" => "",
                "min_size" => "",
                "max_width" => "",
                "max_height" => "",
                "max_size" => "",
                "mime_types" => "",
                "preview_size" => "medium",
            ],
            [
                "key" => "field_63c8689f5264e",
                "label" => "Banner Color",
                "name" => "projects_banner_color",
                "aria-label" => "",
                "type" => "color_picker",
                "instructions" =>
                    "Please select the projects banner background color",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "25",
                    "class" => "",
                    "id" => "",
                ],
                "default_value" => "",
                "enable_opacity" => 0,
                "return_format" => "array",
            ],
            [
                "key" => "field_63c869325264f",
                "label" => "Banner Type",
                "name" => "projects_banner_type",
                "aria-label" => "",
                "type" => "radio",
                "instructions" => "Use a banner image or color",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "choices" => [
                    "Image" => "Image",
                    "Background Color" => "Background Color",
                ],
                "default_value" => "",
                "return_format" => "value",
                "allow_null" => 0,
                "other_choice" => 0,
                "layout" => "vertical",
                "save_other_choice" => 0,
            ],
            [
                "key" => "field_63a0d195c11a3",
                "label" => "Excerpt",
                "name" => "projects_excerpt",
                "aria-label" => "",
                "type" => "text",
                "instructions" =>
                    "Please enter the projects excerpt (this will go on the banner and be used for posts display preview)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "default_value" => "",
                "maxlength" => "",
                "placeholder" => "",
                "prepend" => "",
                "append" => "",
            ],
            [
                "key" => "field_63a0d3c09cba1",
                "label" => "Video",
                "name" => "projects_video",
                "aria-label" => "",
                "type" => "oembed",
                "instructions" =>
                    "Please enter the projects video link (if applicable)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "width" => "",
                "height" => "",
            ],
            [
                "key" => "field_63c85b4e7964a",
                "label" => "Projects Post Category",
                "name" => "projects_post_category",
                "aria-label" => "",
                "type" => "taxonomy",
                "instructions" =>
                    "Please enter the projects category (this will link to recent posts with the selected category)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "taxonomy" => "category",
                "add_term" => 0,
                "save_terms" => 0,
                "load_terms" => 0,
                "return_format" => "id",
                "field_type" => "select",
                "allow_null" => 0,
                "multiple" => 0,
            ],
            [
                "key" => "field_63a0d4b97218a",
                "label" => "Icon URLs",
                "name" => "projects_icon_urls",
                "aria-label" => "",
                "type" => "flexible_content",
                "instructions" =>
                    "Please select to add an icon with a URL attached (the URL will be a clickable icon)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "layouts" => [
                    "layout_63a0d4bd47946" => [
                        "key" => "layout_63a0d4bd47946",
                        "name" => "projects_add_icon_url",
                        "label" => "Add Icon URL",
                        "display" => "block",
                        "sub_fields" => [
                            [
                                "key" => "field_63a0d5027218b",
                                "label" => "URL",
                                "name" => "projects_url",
                                "aria-label" => "",
                                "type" => "url",
                                "instructions" =>
                                    "Please add a valid URL to your icon",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
                                    "class" => "",
                                    "id" => "",
                                ],
                                "default_value" => "",
                                "placeholder" => "",
                            ],
                            [
                                "key" => "field_63a0d5ad699e9",
                                "label" => "Icon",
                                "name" => "projects_icon",
                                "aria-label" => "",
                                "type" => "font-awesome",
                                "instructions" =>
                                    "Please note that the social media brands are in the bottom of the select box",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
                                    "class" => "",
                                    "id" => "",
                                ],
                                "icon_sets" => [
                                    0 => "solid",
                                    1 => "regular",
                                    2 => "brands",
                                ],
                                "custom_icon_set" => "",
                                "default_label" => "",
                                "default_value" => "",
                                "save_format" => "element",
                                "allow_null" => 0,
                                "show_preview" => 1,
                                "enqueue_fa" => 0,
                                "fa_live_preview" => "",
                                "choices" => [],
                            ],
                            [
                                "key" => "field_63c96a9c343df",
                                "label" => "Icon Name",
                                "name" => "projects_icon_name",
                                "aria-label" => "",
                                "type" => "text",
                                "instructions" =>
                                    "Please give a name to your icon (this will appear below the icon itself)",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
                                    "class" => "",
                                    "id" => "",
                                ],
                                "default_value" => "",
                                "maxlength" => "",
                                "placeholder" => "",
                                "prepend" => "",
                                "append" => "",
                            ],
                        ],
                        "min" => "",
                        "max" => "",
                    ],
                ],
                "min" => "",
                "max" => "",
                "button_label" => "Add Row",
            ],
            [
                "key" => "field_63c96b70343e0",
                "label" => "Description Title",
                "name" => "projects_description_title",
                "aria-label" => "",
                "type" => "text",
                "instructions" =>
                    "Please enter a heading title for your description",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "default_value" => "",
                "maxlength" => "",
                "placeholder" => "",
                "prepend" => "",
                "append" => "",
            ],
            [
                "key" => "field_63a2000f2a8ff",
                "label" => "Descrption",
                "name" => "projects_description",
                "aria-label" => "",
                "type" => "wysiwyg",
                "instructions" => "Please enter the description of the project",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "default_value" => "",
                "tabs" => "all",
                "toolbar" => "full",
                "media_upload" => 1,
                "delay" => 0,
            ],
        ],
        "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "projects",
                ],
            ],
        ],
        "menu_order" => 0,
        "position" => "normal",
        "style" => "default",
        "label_placement" => "top",
        "instruction_placement" => "label",
        "hide_on_screen" => "",
        "active" => true,
        "description" => "",
        "show_in_rest" => 0,
    ]);
endif;
