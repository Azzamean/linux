<?php
function cptui_register_my_cpts_webinars()
{

    /**
     * Post Type: Webinars.
     */

    $labels = ["name" => __("Webinars", "custom-post-type-ui") , "singular_name" => __("Webinar", "custom-post-type-ui") , ];

    $args = ["label" => __("Webinars", "custom-post-type-ui") , "labels" => $labels, "description" => "", "public" => true, "publicly_queryable" => true, "show_ui" => true, "show_in_rest" => true, "rest_base" => "", "rest_controller_class" => "WP_REST_Posts_Controller", "rest_namespace" => "wp/v2", "has_archive" => false, "show_in_menu" => true, "show_in_nav_menus" => true, "delete_with_user" => false, "exclude_from_search" => false, "capability_type" => "post", "map_meta_cap" => true, "hierarchical" => false, "can_export" => false, "rewrite" => ["slug" => "webinars", "with_front" => true], "query_var" => true, "menu_icon" => "dashicons-admin-page", "supports" => ["title", "editor", "thumbnail"], "taxonomies" => ["webinars_category"], "show_in_graphql" => false, ];

    register_post_type("webinars", $args);
}

add_action('init', 'cptui_register_my_cpts_webinars');

function cptui_register_my_taxes_webinars_category()
{

    /**
     * Taxonomy: Webinars Categories.
     */

    $labels = ["name" => __("Webinars Categories", "custom-post-type-ui") , "singular_name" => __("Webinar Category", "custom-post-type-ui") , ];

    $args = ["label" => __("Webinars Categories", "custom-post-type-ui") , "labels" => $labels, "public" => true, "publicly_queryable" => true, "hierarchical" => true, "show_ui" => true, "show_in_menu" => true, "show_in_nav_menus" => true, "query_var" => true, "rewrite" => ['slug' => 'webinars_category', 'with_front' => true, ], "show_admin_column" => true, "show_in_rest" => true, "show_tagcloud" => false, "rest_base" => "webinars_category", "rest_controller_class" => "WP_REST_Terms_Controller", "rest_namespace" => "wp/v2", "show_in_quick_edit" => false, "sort" => false, "show_in_graphql" => false, ];
    register_taxonomy("webinars_category", ["webinars"], $args);
}
add_action('init', 'cptui_register_my_taxes_webinars_category');
if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_628ea1cf7c63d',
        'title' => 'Webinars',
        'fields' => array(
            array(
                'key' => 'field_628ea276a9bd6',
                'label' => 'Description',
                'name' => 'webinars_description',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ) ,
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ) ,
            array(
                'key' => 'field_628ea362a9bd7',
                'label' => 'Slides',
                'name' => 'webinars_slides',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ) ,
                'default_value' => '',
                'placeholder' => '',
            ) ,
            array(
                'key' => 'field_628ea3bca9bd8',
                'label' => 'Video',
                'name' => 'webinars_video',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ) ,
                'default_value' => '',
                'placeholder' => '',
            ) ,
        ) ,
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'webinars',
                ) ,
            ) ,
        ) ,
        'menu_order' => 0,
        'position' => 'acf_after_title',
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
            9 => 'tags',
            10 => 'send-trackbacks',
        ) ,
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

endif;

