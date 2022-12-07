<?php 

function cptui_register_my_cpts_working_groups() {

	/**
	 * Post Type: Working Groups.
	 */

	$labels = [
		"name" => esc_html__( "Working Groups", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Working Group", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Working Groups", "custom-post-type-ui" ),
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
		"can_export" => false,
		"rewrite" => [ "slug" => "working_groups", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "working_groups", $args );
}

add_action( 'init', 'cptui_register_my_cpts_working_groups' );


function cptui_register_my_taxes_working_groups() {

	/**
	 * Taxonomy: Working Group Categories.
	 */

	$labels = [
		"name" => esc_html__( "Working Group Categories", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Working Group Category", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Working Group Categories", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'working_group_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "working_group_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "working_group_category", [ "working_groups" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_working_groups' );