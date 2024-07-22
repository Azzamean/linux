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

$domain_name = parse_url(get_site_url(), PHP_URL_HOST);
switch ($domain_name) {
case "dev-zephyr-project.pantheonsite.io":
case "zephyrproject.org":
case "www.zephyrproject.org":
    include_once "vendors/zephyr-taxonomy.php";      
    break;
case "spdx.dev-lfprojects3.linuxfoundation.org":
    include_once "vendors/spdx-taxonomy.php";      
    break;
}

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
