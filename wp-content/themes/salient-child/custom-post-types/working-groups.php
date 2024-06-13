<?php
function cptui_register_my_cpts_working_groups()
{
    /**
     * Post Type: Working Groups.
     */

    $labels = [
        "name" => esc_html__("Working Groups", "custom-post-type-ui"),
        "singular_name" => esc_html__("Working Group", "custom-post-type-ui"),
    ];

    $args = [
        "label" => esc_html__("Working Groups", "custom-post-type-ui"),
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
        "can_export" => true,
        "rewrite" => ["slug" => "working-groups", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-page",
        "supports" => ["title", "author"],
        "taxonomies" => ["working_groups_category", "working_groups_stage"],
        "show_in_graphql" => false,
    ];

    register_post_type("working_groups", $args);
}

add_action("init", "cptui_register_my_cpts_working_groups");

function cptui_register_my_taxes_working_group_category()
{
    /**
     * Taxonomy: Working Groups Categories.
     */

    $labels = [
        "name" => __("Working Groups Categories", "custom-post-type-ui"),
        "singular_name" => __("Working Groups Category", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Working Groups Categories", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true, // this makes it a checkbox or like a regular tag
        "hierarchical" => true,
        "show_ui" => true, // This hides it on the left admin dashboard and on singles
        "show_in_menu" => true, // This hides it on the left admin dashboard
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [
            "slug" => "working_groups_category",
            "with_front" => true,
        ],
        "show_admin_column" => true, // This hides in on the main working groups page's list view
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "working_groups_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("working_groups_category", ["working_groups"], $args);
}
add_action("init", "cptui_register_my_taxes_working_group_category");

function cptui_register_my_taxes_working_groups_stage()
{
    /**
     * Taxonomy: Working Groups Stages.
     */

    $labels = [
        "name" => __("Working Groups Stages", "custom-post-type-ui"),
        "singular_name" => __("Working Groups Stage", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Working Groups Stages", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ["slug" => "working_groups_stage", "with_front" => true],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "working_groups_stage",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("working_groups_stage", ["working_groups"], $args);
}
add_action("init", "cptui_register_my_taxes_working_groups_stage");

add_action(
    "acf/include_fields", function () {
        if (!function_exists("acf_add_local_field_group")) {
            return;
        }

        acf_add_local_field_group(
            [
            "key" => "group_34fdd34dh5534",
            "title" => "Working Groups",
            "fields" => [
            [
                "key" => "field_34ggf34336gd4",
                "label" => "Logo",
                "name" => "working_groups_logo",
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
                "key" => "field_43gffdr675890",
                "label" => "Secondary Logo",
                "name" => "working_groups_secondary_logo",
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
                "key" => "field_653vd3tg33573",
                "label" => "Header",
                "name" => "working_groups_header",
                "aria-label" => "",
                "type" => "radio",
                "instructions" => "Use a logo instead of the page title",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "50",
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
                "key" => "field_76htgf445tge3",
                "label" => "Header Excerpt",
                "name" => "working_groups_header_excerpt",
                "aria-label" => "",
                "type" => "checkbox",
                "instructions" => "Add the excerpt text into the header",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "50",
                    "class" => "",
                    "id" => "",
                ],
                "choices" => [
                    "yes" => "Yes",
                ],
                "default_value" => [],
                "return_format" => "value",
                "allow_custom" => 0,
                "layout" => "vertical",
                "toggle" => 0,
                "save_custom" => 0,
                "custom_choice_button_text" => "Add new choice",
            ],
            [
                "key" => "field_43ff2dgt4325g",
                "label" => "Banner",
                "name" => "working_groups_banner",
                "aria-label" => "",
                "type" => "image",
                "instructions" =>
                    "Please select the working groups banner background image",
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
                "key" => "field_54fggt3dfg34g",
                "label" => "Banner Color",
                "name" => "working_groups_banner_color",
                "aria-label" => "",
                "type" => "color_picker",
                "instructions" =>
                    "Please select the working groups banner background color",
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
                "key" => "field_54ff3dhlo9989",
                "label" => "Banner Type",
                "name" => "working_groups_banner_type",
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
                "key" => "field_54ggh7uj77890",
                "label" => "Excerpt",
                "name" => "working_groups_excerpt",
                "aria-label" => "",
                "type" => "text",
                "instructions" =>
                    "Please enter the working groups excerpt (this will go on the banner and be used for posts display preview)",
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
                "key" => "field_54fgttgb6745g",
                "label" => "Video",
                "name" => "working_groups_video",
                "aria-label" => "",
                "type" => "oembed",
                "instructions" =>
                    "Please enter the working groups video link (if applicable)",
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
                "key" => "field_54gthy3312sxn",
                "label" => "Working Groups Post Category",
                "name" => "working_groups_post_category",
                "aria-label" => "",
                "type" => "taxonomy",
                "instructions" =>
                    "Please enter the working groups category (this will link to recent posts with the selected category)",
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
                "key" => "field_45hhbnmu88789",
                "label" => "Working Groups Category",
                "name" => "working_groups_category",
                "aria-label" => "",
                "type" => "taxonomy",
                "instructions" =>
                    "Please enter the working groups category (this will link to the working groups selected category)",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "taxonomy" => "working_groups_category",
                "add_term" => 0,
                "save_terms" => 0,
                "load_terms" => 0,
                "return_format" => "id",
                "field_type" => "select",
                "allow_null" => 0,
                "multiple" => 0,
            ],
            [
                "key" => "field_43ddcfgt66hke",
                "label" => "Icon URLs",
                "name" => "working_groups_icon_urls",
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
                    "layout_4533fghtg6678" => [
                        "key" => "layout_4533fghtg6678",
                        "name" => "working_groups_add_icon_url",
                        "label" => "Add Icon URL",
                        "display" => "block",
                        "sub_fields" => [
                            [
                                "key" => "field_54ffdg55855gj",
                                "label" => "URL",
                                "name" => "working_groups_url",
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
                                "key" => "field_65hhd4jnh7789",
                                "label" => "Icon",
                                "name" => "working_groups_icon",
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
                                "key" => "field_78jjk83g6thy6",
                                "label" => "Icon Name",
                                "name" => "working_groups_icon_name",
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
                "key" => "field_89jjhyujndr55",
                "label" => "Description Title",
                "name" => "working_groups_description_title",
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
                "key" => "field_84jj38fi9033k",
                "label" => "Descrption",
                "name" => "working_groups_description",
                "aria-label" => "",
                "type" => "wysiwyg",
                "instructions" =>
                    "Please enter the description of the working groups",
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
            [
                "key" => "field_58jjgdop33ke9",
                "label" => "Case Studies Title",
                "name" => "working_groups_case_studies_title",
                "aria-label" => "",
                "type" => "text",
                "instructions" => "Please enter the title of the Case Studies",
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
                "key" => "field_34kkj9ei2b0dn",
                "label" => "Case Studies",
                "name" => "working_groups_case_studies",
                "aria-label" => "",
                "type" => "flexible_content",
                "instructions" => "",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "",
                    "id" => "",
                ],
                "layouts" => [
                    "layout_9033kmn7f88d9" => [
                        "key" => "layout_9033kmn7f88d9",
                        "name" => "working_groups_add_case_study",
                        "label" => "Add Working Groups Case Study",
                        "display" => "block",
                        "sub_fields" => [
                            [
                                "key" => "field_34ff3s4457gd4",
                                "label" => "Case Studies Image",
                                "name" => "working_groups_case_studies_image",
                                "aria-label" => "",
                                "type" => "image",
                                "instructions" =>
                                    "Please enter an image for your case study",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
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
                                "key" => "field_433fhh990sk931",
                                "label" => "Case Studies Title",
                                "name" => "working_groups_case_studies_title",
                                "aria-label" => "",
                                "type" => "text",
                                "instructions" =>
                                    "Please enter a title for your case study",
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
                                "key" => "field_34ffdgh0k9j8g",
                                "label" => "Case Studies Download URL",
                                "name" =>
                                    "working_groups_case_studies_download_url",
                                "aria-label" => "",
                                "type" => "url",
                                "instructions" => "",
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
                        ],
                        "min" => "",
                        "max" => "",
                    ],
                ],
                "min" => "",
                "max" => "",
                "button_label" => "Add Row",
            ],
            ],
            "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "working_groups",
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
            ]
        );
    }
);
