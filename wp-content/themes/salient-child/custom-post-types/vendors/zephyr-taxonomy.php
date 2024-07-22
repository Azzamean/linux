<?php

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
