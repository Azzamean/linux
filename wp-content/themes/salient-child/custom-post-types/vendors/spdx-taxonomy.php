<?php

function cptui_register_my_taxes_vendors()
{
    /**
     * Taxonomy: Classification.
     */

    $labels = array(
        "name" => __('Classification', ''),
        "singular_name" => __('Classification', '')
    );

    $args = array(
        "label" => __('Classification', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Classification",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_classification', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_classification", array("vendor"), $args);

    /**
     * Taxonomy: Type.
     */

    $labels = array(
        "name" => __('Type', ''),
        "singular_name" => __('Type', '')
    );

    $args = array(
        "label" => __('Type', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Type",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_type_single', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_type_single", array("vendor"), $args);

    /**
     * Taxonomy: Version Support.
     */

    $labels = array(
        "name" => __('Version Support', ''),
        "singular_name" => __('Version Support', '')
    );

    $args = array(
        "label" => __('Version Support', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Version Support",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_version_support', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_version_support", array("vendor"), $args);

    /**
     * Taxonomy: Vendor Type.
     */

     $labels = array(
        "name" => __('Vendor Type', ''),
        "singular_name" => __('Vendor Type', '')
    );

    $args = array(
        "label" => __('Vendor Type', ''),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Vendor Type",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'vendor_type', 'with_front' => true),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false
    );
    register_taxonomy("vendor_type", array("vendor"), $args);

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
