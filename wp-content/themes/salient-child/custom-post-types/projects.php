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
        "rewrite" => ["slug" => "projects/project", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-page",
        "supports" => ["title", "editor", "author"],
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
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ["slug" => "projects_category", "with_front" => true],
        "show_admin_column" => true,
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
        "show_admin_column" => false,
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

			if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6209367a2d7be',
	'title' => 'Projects',
	'fields' => array(
		array(
			'key' => 'field_62193b8df65fa',
			'label' => 'Banner',
			'name' => 'projects_banner',
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
			'preview_size' => 'wide',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_620948e457fa4',
			'label' => 'Excerpt',
			'name' => 'projects_excerpt',
			'type' => 'textarea',
			'instructions' => 'Please enter the excerpt of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 3,
			'new_lines' => '',
		),
		array(
			'key' => 'field_6209491e57fa6',
			'label' => 'Description',
			'name' => 'projects_description',
			'type' => 'wysiwyg',
			'instructions' => 'Please enter the main description and content of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_62193bf118bc9',
			'label' => 'Details',
			'name' => 'projects_details',
			'type' => 'wysiwyg',
			'instructions' => 'Please enter the details of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_6209490a57fa5',
			'label' => 'Logo',
			'name' => 'projects_logo',
			'type' => 'image',
			'instructions' => 'Please enter the full colored image of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_620ad71772889',
			'label' => 'White Logo',
			'name' => 'projects_white_logo',
			'type' => 'image',
			'instructions' => 'Please enter the white image of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_6209494b8a9ce',
			'label' => 'Github',
			'name' => 'projects_github',
			'type' => 'url',
			'instructions' => 'Please enter the Github repository of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094bb641cf4',
			'label' => 'Mailing list',
			'name' => 'projects_mailing_list',
			'type' => 'url',
			'instructions' => 'Please enter the mailing list of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094c0b507b4',
			'label' => 'LFX Insights link',
			'name' => 'projects_lfx_insights_link',
			'type' => 'url',
			'instructions' => 'Please enter the LFX Insights link of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094c5e2e26f',
			'label' => 'LFX Security link',
			'name' => 'projects_lfx_security_link',
			'type' => 'url',
			'instructions' => 'Please enter the LFX security link of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094c7c2e270',
			'label' => 'Wiki link',
			'name' => 'projects_wiki_link',
			'type' => 'url',
			'instructions' => 'Please enter the Wiki link of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094c962e271',
			'label' => 'Roadmap',
			'name' => 'projects_roadmap',
			'type' => 'url',
			'instructions' => 'Please enter the roadmap link of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094cb42e272',
			'label' => 'Contributions',
			'name' => 'projects_contributions',
			'type' => 'url',
			'instructions' => 'Please enter the contributions link of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_62094cc62e273',
			'label' => 'Calendar',
			'name' => 'projects_calendar',
			'type' => 'url',
			'instructions' => 'Please enter the calendar link of the project',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_620950efdb1c7',
			'label' => 'Documentation',
			'name' => 'projects_documentation',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'projects',
			),
		),
	),
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
	),
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

endif;		