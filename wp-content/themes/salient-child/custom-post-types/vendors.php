<?php
function cptui_register_my_cpts_vendors()
{
    /**
     * Post Type: Vendors.
     */

    $labels = array(
        "name" => __('Vendors', ''),
        "singular_name" => __('Vendor', ''),
        "menu_name" => __('Vendors', '')
    );

    $args = array(
        "label" => __('Vendors', ''),
        "labels" => $labels,
        "description" => "Member Vendors",
        "public" => true,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "vendor", "with_front" => true),
        "query_var" => true,
        "supports" => array("title", "editor")
    );

    register_post_type("vendor", $args);
}

add_action('init', 'cptui_register_my_cpts_vendors');

function cptui_register_my_taxes_vendors()
{
    /**
     * Taxonomy: Development Tools.
     */

    $labels = array(
        "name" => __('Development Tools', ''),
        "singular_name" => __('Development Tools', '')
    );

    $args = array(
        "label" => __('Development Tools', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Development Tools",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_dev_tools', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_dev_tools", array("vendor"), $args);

    /**
     * Taxonomy: Applications & Middleware.
     */

    $labels = array(
        "name" => __('Applications & Middleware', ''),
        "singular_name" => __('Applications & Middleware', '')
    );

    $args = array(
        "label" => __('Applications & Middleware', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Applications & Middleware",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_app_mid', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_app_mid", array("vendor"), $args);

    /**
     * Taxonomy: Training & Consulting.
     */

    $labels = array(
        "name" => __('Training & Consulting', ''),
        "singular_name" => __('Training & Consulting', '')
    );

    $args = array(
        "label" => __('Training & Consulting', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Training & Consulting",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_tra_con', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_tra_con", array("vendor"), $args);

    /**
     * Taxonomy: All Vendors.
     */

    $labels = array(
        "name" => __('All Vendors', ''),
        "singular_name" => __('All Vendors', '')
    );

    $args = array(
        "label" => __('All Vendors', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "All Vendors",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_all', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_all", array("vendor"), $args);
}

add_action('vc_before_init', 'cptui_register_my_taxes_vendors');

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(
        array(
        'key' => 'group_590b93ad94dc0',
        'title' => 'Vendors',
        'fields' => array(
            array(
                'key' => 'field_58e5d7a6ec939',
                'label' => 'Logo',
                'name' => 'logo',
                'type' => 'image',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'return_format' => 'array',
                'min_width' => 0,
                'min_height' => 0,
                'min_size' => 0,
                'max_width' => 0,
                'max_height' => 0,
                'max_size' => 0,
                'mime_types' => ''
            ),
            array(
                'key' => 'field_58e5d7c7ec93a',
                'label' => 'Short Description',
                'name' => 'short_description',
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
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 2,
                'new_lines' => 'br'
            ),
            array(
                'key' => 'field_58e5d7f3ec93c',
                'label' => 'Website',
                'name' => 'website',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'vendor'
                )
            )
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'the_content',
            1 => 'excerpt',
            2 => 'discussion',
            3 => 'comments',
            4 => 'revisions',
            5 => 'slug',
            6 => 'author',
            7 => 'format',
            8 => 'featured_image',
            9 => 'categories',
            10 => 'tags',
            11 => 'send-trackbacks'
        ),
        'active' => 1,
        'description' => ''
        )
    );
endif;
