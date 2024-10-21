<?php

function cptui_register_my_cpts_organizations()
{
    /**
     * Post Type: Organizations.
     */

    $labels = [
        "name" => __('Organizations', ''),
        "singular_name" => __('Organization', ''),
        "add_new" => _x("Add New", "Organization", ''),
        "add_new_item" => __("Add New Organization", ''),
        "new_item" => __("New Organization", ''),
        "edit_item" => __("Edit Organizations", ''),
        "view_item" => __("View Organizations", ''),
        "all_items" => __("All Organizations", ''),
        "search_items" => __("Search Organizations", '')
    ];

    $args = [
    "label" => esc_html__("Organizations", "custom-post-type-ui"),
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
    "rewrite" => [ "slug" => "organizations", "with_front" => true ],
    "query_var" => true,
    "menu_icon" => "dashicons-admin-page",
    "supports" => ["title", "editor", "thumbnail"],
    "taxonomies" => [ "organizations_category" ],
    "show_in_graphql" => false,
    ];

    register_post_type("organizations", $args);
}

add_action('init', 'cptui_register_my_cpts_organizations');
function cptui_register_my_taxes_organizations_category()
{

    /**
     * Taxonomy: Organization Categories.
     */

    $labels = [
    "name" => esc_html__("Organization Categories", "custom-post-type-ui"),
    "singular_name" => esc_html__("Organization Category", "custom-post-type-ui"),
    ];
   
    $args = [
    "label" => esc_html__("Organization Categories", "custom-post-type-ui"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => [ 'slug' => 'organizations_category', 'with_front' => true, ],
    "show_admin_column" => false,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "organizations_category",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => false,
    "sort" => false,
    "show_in_graphql" => false,
    ];
    register_taxonomy("organizations_category", [ "organizations" ], $args);
}
add_action('init', 'cptui_register_my_taxes_organizations_category');

add_action(
    'acf/include_fields', function () {
        if (! function_exists('acf_add_local_field_group') ) {
            return;
        }

        acf_add_local_field_group(
            array(
            'key' => 'group_67114251937e9',
            'title' => 'Organizations',
            'fields' => array(
            array(
            'key' => 'field_6711425367b55',
            'label' => 'Name',
            'name' => 'organizations_name',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            ),
            array(
            'key' => 'field_671142f867b57',
            'label' => 'Logo',
            'name' => 'organizations_logo',
            'aria-label' => '',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'allow_in_bindings' => 0,
            'preview_size' => 'medium',
            ),
            array(
            'key' => 'field_671142e267b56',
            'label' => 'Biography',
            'name' => 'organizations_biography',
            'aria-label' => '',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'allow_in_bindings' => 0,
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'delay' => 0,
            ),
            array(
            'key' => 'field_6711431067b58',
            'label' => 'URL',
            'name' => 'organizations_url',
            'aria-label' => '',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            ),
            ),
            'location' => array(
            array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'organizations',
            ),
            ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
            0 => 'permalink',
            1 => 'the_content',
            2 => 'excerpt',
            3 => 'custom_fields',
            4 => 'discussion',
            5 => 'comments',
            6 => 'revisions',
            7 => 'slug',
            8 => 'author',
            9 => 'format',
            10 => 'page_attributes',
            11 => 'featured_image',
            12 => 'categories',
            13 => 'tags',
            14 => 'send-trackbacks'
            ),
            'active' => 1,
            'description' => ''
            ) 
        );
    } 
);
