<?php

// ADDITION OF EMBEDDED CODE FOR WP BAKERY VIDEO CATEGORIES
if (function_exists("acf_add_local_field_group")):
    acf_add_local_field_group([
        "key" => "group_637545b11c64f",
        "title" => "Video Settings",
        "fields" => [
            [
                "key" => "field_637545b866dd1",
                "label" => "Embedded Code",
                "name" => "embedded_code",
                "aria-label" => "",
                "type" => "oembed",
                "instructions" =>
                    "Please input the URL for your link. I.e. http://www.themenectar.com",
                "required" => 0,
                "conditional_logic" => 0,
                "wrapper" => [
                    "width" => "",
                    "class" => "video-settings",
                    "id" => "",
                ],
                "width" => "",
                "height" => "",
            ],
        ],
        "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "post",
                ],
                [
                    "param" => "post_category",
                    "operator" => "==",
                    "value" => "category:video",
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
