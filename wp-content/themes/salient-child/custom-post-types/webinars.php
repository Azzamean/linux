<?php
function cptui_register_my_cpts_webinars()
{
    /**
     * Post Type: Webinars.
     */

    $labels = [
        "name" => __("Webinars", "custom-post-type-ui"),
        "singular_name" => __("Webinar", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Webinars", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => ["slug" => "webinars", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-page",
        "supports" => ["title", "editor", "thumbnail"],
        "taxonomies" => ["webinars_category"],
        "show_in_graphql" => false,
        "supports" => ["title", "author"],
    ];

    register_post_type("webinars", $args);
}

add_action("init", "cptui_register_my_cpts_webinars");

function cptui_register_my_taxes_webinars_category()
{
    /**
     * Taxonomy: Webinars Categories.
     */

    $labels = [
        "name" => __("Webinars Categories", "custom-post-type-ui"),
        "singular_name" => __("Webinar Category", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Webinars Categories", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ["slug" => "webinars_category", "with_front" => true],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "webinars_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("webinars_category", ["webinars"], $args);
}
add_action("init", "cptui_register_my_taxes_webinars_category");

if (function_exists("acf_add_local_field_group")):
    acf_add_local_field_group([
        "key" => "group_6408cf3a92281",
        "title" => "Webinars",
        "fields" => [
            [
                "key" => "field_6408cfbcf205b",
                "label" => "Speaker",
                "name" => "webinars_speaker",
                "aria-label" => "",
                "type" => "text",
                "instructions" => "",
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
                "key" => "field_6408cfd5f205c",
                "label" => "Designation",
                "name" => "webinars_designation",
                "aria-label" => "",
                "type" => "text",
                "instructions" => "",
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
                "key" => "field_6408cf3cf205a",
                "label" => "Video Link",
                "name" => "webinars_video_link",
                "aria-label" => "",
                "type" => "oembed",
                "instructions" => "",
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
        ],
        "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "webinars",
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
