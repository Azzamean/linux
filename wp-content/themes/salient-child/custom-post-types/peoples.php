<?php

function cptui_register_my_cpts_people()
{
    /**
     * Post Type: People.
     */

    $labels = array(
        "name" => __('People', ''),
        "singular_name" => __('People', ''),
        "add_new" => _x("Add New", "People", ''),
        "add_new_item" => __("Add New People", ''),
        "new_item" => __("New People", ''),
        "edit_item" => __("Edit People", ''),
        "view_item" => __("View People", ''),
        "all_items" => __("All People", ''),
        "search_items" => __("Search People", '')
    );

    $args = [
        "label" => esc_html__("People", "custom-post-type-ui"),
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
        "rewrite" => ["slug" => "people", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-page",
        "supports" => ["title", "editor", "thumbnail"],
        "taxonomies" => ["people_category"],
        "show_in_graphql" => false
    ];

    register_post_type("people", $args);
}

add_action('init', 'cptui_register_my_cpts_people');
function cptui_register_my_taxes_people_category()
{
    /**
     * Taxonomy: People Categories.
     */

    $labels = [
        "name" => esc_html__("People Categories", "custom-post-type-ui"),
        "singular_name" => esc_html__("People Category", "custom-post-type-ui")
    ];

    $args = [
        "label" => esc_html__("People Categories", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'people_category', 'with_front' => true],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "people_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false
    ];
    register_taxonomy("people_category", ["people"], $args);
}
add_action('init', 'cptui_register_my_taxes_people_category');

add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_66fd5ad0bbcd5',
        'title' => 'People',
        'fields' => array(
            array(
                'key' => 'field_66fd5ad28a0dc',
                'label' => 'Name',
                'name' => 'people_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            ),
            array(
                'key' => 'field_66fd5aea8a0dd',
                'label' => 'Company',
                'name' => 'people_company',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            ),
            array(
                'key' => 'field_66fd5afa8a0de',
                'label' => 'Title',
                'name' => 'people_title',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            ),
            array(
                'key' => 'field_66fd5b8032ae9',
                'label' => 'Pronouns',
                'name' => 'people_pronouns',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            ),
            array(
                'key' => 'field_66fd5bbc32aea',
                'label' => 'Headshot',
                'name' => 'people_headshot',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'allow_in_bindings' => 0,
                'preview_size' => 'medium'
            ),
            array(
                'key' => 'field_66fd5b0832ae7',
                'label' => 'Location',
                'name' => 'people_location',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            ),
            array(
                'key' => 'field_66fd5b1332ae8',
                'label' => 'Biography',
                'name' => 'people_biography',
                'aria-label' => '',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'allow_in_bindings' => 0,
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0
            ),
            array(
                'key' => 'field_66fd5ddf32aeb',
                'label' => 'LinkedIn',
                'name' => 'people_linkedin',
                'aria-label' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'allow_in_bindings' => 0,
                'placeholder' => ''
            ),
            array(
                'key' => 'field_66fd5dfe32aec',
                'label' => 'X',
                'name' => 'people_x',
                'aria-label' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'allow_in_bindings' => 0,
                'placeholder' => ''
            ),
            array(
                'key' => 'field_66fd5e0c32aed',
                'label' => 'GitHub',
                'name' => 'people_github',
                'aria-label' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'allow_in_bindings' => 0,
                'placeholder' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'people'
                )
            )
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
    ));
});
