<?php
/**
 * Template Name: Projects Template - Simple Style
 * Template Post Type: projects
 * The template for displaying single projects custom post types.
 *
 * @package Salient WordPress Theme
 * @version 13.1
 *
 *
 */
// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}

$templateSlug = get_page_template_slug(get_queried_object_id());
$templateID = get_queried_object_id();
if ($templateSlug == null) {
    echo "This is the simple style template";
    echo "<br>";
    echo $templateID;
} else {
    echo "This is the template file: " . $templateSlug;
    echo "<br>";
    echo $templateID;
}
