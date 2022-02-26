<?php

/**
 * Template Name: Projects Template - Simple Style
 * Template Post Type: projects
 * The template for displaying single projects custom post types.
 *
 * @package Salient WordPress Theme
 * @version 13.1
 *
 **/

// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}

$templateFile = get_page_template_slug(get_queried_object_id());

if ($templateFile == null) {
    echo "This is the default template";
} else {
    echo "This is the template file: " . $templateFile;
}
