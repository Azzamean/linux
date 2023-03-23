<?php

function cptui_register_my_cpts_members()
{
    /**
     * Post Type: Members.
     */

    $labels = [
        "name" => esc_html__("Members", "custom-post-type-ui"),
        "singular_name" => esc_html__("Member", "custom-post-type-ui"),
    ];

    $args = [
        "label" => esc_html__("Members", "custom-post-type-ui"),
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
        "rewrite" => ["slug" => "members", "with_front" => true],
        "query_var" => true,
        "taxonomies" => ["members_category"],
        "show_in_graphql" => false,
        "supports" => ["title", "author"],
    ];

    register_post_type("members", $args);
}

add_action("init", "cptui_register_my_cpts_members");

function cptui_register_my_taxes_members_category()
{
    /**
     * Taxonomy: Members Categories.
     */

    $labels = [
        "name" => esc_html__("Members Categories", "custom-post-type-ui"),
        "singular_name" => esc_html__("Member Catgory", "custom-post-type-ui"),
    ];

    $args = [
        "label" => esc_html__("Members Categories", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ["slug" => "members_category", "with_front" => true],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "members_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("members_category", ["members"], $args);
}
add_action("init", "cptui_register_my_taxes_members_category");

if (function_exists("acf_add_local_field_group")):
    acf_add_local_field_group([
        "key" => "group_64065c92ba9a4",
        "title" => "Members",
        "fields" => [
            [
                "key" => "field_64065ca496306",
                "label" => "Logo",
                "name" => "members_logo",
                "aria-label" => "",
                "type" => "image",
                "instructions" => "",
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
                "key" => "field_641c7aa87e750",
                "label" => "URL",
                "name" => "members_url",
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
        "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "members",
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
