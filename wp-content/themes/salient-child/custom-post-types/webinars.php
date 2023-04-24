<?php
function cptui_register_my_cpts_webinars()
{
    /**
     * Post Type: Webinars.
     */

    $labels = [
        "name" => __("Webinars", "custom-post-type-ui"),
        "singular_name" => __("Webinar", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Webinars", "custom-post-type-ui"),
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
        "can_export" => true,
        "rewrite" => ["slug" => "webinars", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-page",
        "supports" => ["title", "editor", "thumbnail"],
        "taxonomies" => ["webinars_category"],
        "show_in_graphql" => false,
        "supports" => ["title", "author"],
    ];

    register_post_type("webinars", $args);
}

add_action("init", "cptui_register_my_cpts_webinars");

if (function_exists("acf_add_local_field_group")):
    acf_add_local_field_group([
        "key" => "group_6408cf3a92281",
        "title" => "Webinars",
        "fields" => [
            [
                "key" => "field_6441ab0cf3db6",
                "label" => "Banner",
                "name" => "webinars_banner",
                "aria-label" => "",
                "type" => "image",
                "instructions" =>
                    "Please add the webinars banner at the top of the page.",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => ["width" => "", "class" => "", "id" => ""],
                "return_format" => "url",
                "library" => "all",
                "min_width" => "",
                "min_height" => "",
                "min_size" => "",
                "max_width" => "",
                "max_height" => "",
                "max_size" => "",
                "mime_types" => "",
                "preview_size" => "medium",
            ],
            [
                "key" => "field_6408cf3cf205a",
                "label" => "Video Link",
                "name" => "webinars_video_link",
                "aria-label" => "",
                "type" => "oembed",
                "instructions" =>
                    "Please enter the registration link or embedded video link. Please note, if the link does not have a video preview, then it will only display the URL link instead of the video preview image.",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => ["width" => "", "class" => "", "id" => ""],
                "width" => "",
                "height" => "",
            ],
            [
                "key" => "field_6408cfbcf205b",
                "label" => "Speakers",
                "name" => "webinars_speakers",
                "aria-label" => "",
                "type" => "flexible_content",
                "instructions" =>
                    "Please add the rows for the speakers names, titles, and companies.",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => ["width" => "", "class" => "", "id" => ""],
                "layouts" => [
                    "layout_64346e5644055" => [
                        "key" => "layout_64346e5644055",
                        "name" => "webinars_speakers_information",
                        "label" => "Speakers Information",
                        "display" => "block",
                        "sub_fields" => [
                            [
                                "key" => "field_64346e696dacc",
                                "label" => "Speakers Name",
                                "name" => "webinars_speakers_name",
                                "aria-label" => "",
                                "type" => "text",
                                "instructions" => "",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
                                    "class" => "",
                                    "id" => "",
                                ],
                                "default_value" => "",
                                "maxlength" => "",
                                "placeholder" => "",
                                "prepend" => "",
                                "append" => "",
                            ],
                            [
                                "key" => "field_64398b4629864",
                                "label" => "Speakers Title",
                                "name" => "webinars_speakers_title",
                                "aria-label" => "",
                                "type" => "text",
                                "instructions" => "",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
                                    "class" => "",
                                    "id" => "",
                                ],
                                "default_value" => "",
                                "maxlength" => "",
                                "placeholder" => "",
                                "prepend" => "",
                                "append" => "",
                            ],
                            [
                                "key" => "field_64346fc36dacd",
                                "label" => "Speakers Company",
                                "name" => "webinars_speakers_company",
                                "aria-label" => "",
                                "type" => "text",
                                "instructions" => "",
                                "required" => 0,
                                "conditional_logic" => 0,
                                "wrapper" => [
                                    "width" => "",
                                    "class" => "",
                                    "id" => "",
                                ],
                                "default_value" => "",
                                "maxlength" => "",
                                "placeholder" => "",
                                "prepend" => "",
                                "append" => "",
                            ],
                        ],
                        "min" => "",
                        "max" => "",
                    ],
                ],
                "min" => "",
                "max" => "",
                "button_label" => "Add Row",
            ],
            [
                "key" => "field_6441ac0609400",
                "label" => "Description",
                "name" => "webinars_description",
                "aria-label" => "",
                "type" => "wysiwyg",
                "instructions" => "Please enter the webinars description.",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => ["width" => "", "class" => "", "id" => ""],
                "default_value" => "",
                "tabs" => "all",
                "toolbar" => "full",
                "media_upload" => 1,
                "delay" => 0,
            ],
        ],
        "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "webinars",
                ],
            ],
        ],
        "menu_order" => 0,
        "position" => "normal",
        "style" => "default",
        "label_placement" => "top",
        "instruction_placement" => "label",
        "hide_on_screen" => "",
        "active" => true,
        "description" => "",
        "show_in_rest" => 0,
    ]);
endif;
