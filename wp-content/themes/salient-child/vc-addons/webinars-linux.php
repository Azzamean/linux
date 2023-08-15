<?php
class WebinarsLinux
{
    public function __construct()
    {
        add_action("init", [$this, "webinars_vc_linux"], 99999);
    }

    public function webinars_vc_linux()
    {
        $types = get_terms([
            "taxonomy" => "webinars_category",
            "hide_empty" => true,
            "orderby" => "name",
            "suppress_filters" => true
        ]);

        $single_category = ["All" => ""];
        foreach ($types as $type) {
            
        }

        if (function_exists("vc_map")):
            vc_map([
                "name" => esc_html__(
                    "Webinars - Linux Foundation Designed",
                    "webinars"
                ),
                "base" => "webinars_linux_foundation",
                "icon" => "vc_element-icon icon-wpb-recent-posts",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "webinars"),
                "description" => esc_html__(
                    "Display list of different webinars custom post types.",
                    "webinars"
                ),
                "params" => [
                    [
                        "type" => "dropdown_multi",
                        "class" => "",
                        "heading" => esc_html__("Categories", "webinars"),
                        "param_name" => "category_id",
                        "value" => $single_category,
                        "description" => esc_html__(
                            "Select the webinar categories to display.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Columns", "webinars"),
                        "param_name" => "columns",
                        "value" => [
                            esc_html__("1 Column", "recent_posts") => "1",
                            esc_html__("2 Columns", "recent_posts") => "2",
                            esc_html__("3 Columns", "recent_posts") => "3",
                            esc_html__("4 Columns", "recent_posts") => "4"
                        ],
                        "description" => esc_html__(
                            "Select the number of columns to be displayed.",
                            "salient-core"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__("Post Per Page", "webinars"),
                        "param_name" => "limit",
                        "value" => "10",
                        "description" => esc_html__(
                            "Enter number of webinars to be displayed. Enter -1 to display all.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Sort", "webinars"),
                        "param_name" => "sort",
                        "value" => [
                            esc_html__("Descending", "webinars") => "DESC",
                            esc_html__("Ascending", "webinars") => "ASC"
                        ],
                        "description" => esc_html__(
                            "Select the sorting direction to be displayed.",
                            "salient-core"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Schedule", "webinars"),
                        "param_name" => "schedule",
                        "value" => [
                            esc_html__("Published", "webinars") => "published",
                            esc_html__("Scheduled", "webinars") => "scheduled"
                        ],
                        "description" => esc_html__(
                            "Select the schedule of webinars to be displayed.",
                            "salient-core"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Featured Image", "webinars"),
                        "param_name" => "featured_image",
                        "value" => [
                            esc_html__(
                                "Hide Featured Image",
                                "webinars"
                            ) => "hide-featured-image"
                        ],
                        "std" => "show-featured-image",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide the featured image.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Date Under Title", "webinars"),
                        "param_name" => "dut",
                        "value" => [
                            esc_html__(
                                "Put the date under the title",
                                "webinars"
                            ) => "show-dut"
                        ],
                        "std" => "hide-dut",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want the publication date under the title.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Excerpt", "webinars"),
                        "param_name" => "excerpt",
                        "value" => [
                            esc_html__(
                                "Show Excerpt",
                                "webinars"
                            ) => "show-excerpt"
                        ],
                        "std" => "hide-excerpt",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide the excerpt.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__("Excerpt Length", "webinars"),
                        "param_name" => "excerpt_length",
                        "value" => "",
                        "std" => "50",

                        "dependency" => [
                            "element" => "excerpt",
                            "value" => ["show-excerpt"]
                        ],

                        "description" => esc_html__(
                            "Enter the number of words for the excerpt length. The default is set to 50 words.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__("Navigation Text", "webinars"),
                        "param_name" => "navigation_text",
                        "value" => "",
                        "std" => "",
                        "description" => esc_html__(
                            "Enter the text for the navigation button.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
					                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Remove Hyperlink from Title", "webinars"),
                        "param_name" => "remove_hyperlink_title",
                        "value" => [
                            esc_html__(
                                "Remove Hyperlink",
                                "webinars"
                            ) => "remove-hyperlink"
                        ],
                        "std" => "keep-hyperlink",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to keep or remove the hyperlink of the title.",
                            "webinars"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Pagination", "webinars"),
                        "param_name" => "pagination",
                        "value" => [
                            esc_html__(
                                "Hide Pagination",
                                "webinars"
                            ) => "hide-pagination"
                        ],
                        "std" => "show-pagination",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide pagination.",
                            "webinars"
                        ),
                        "save_always" => true
                    ]
                ]
            ]);
        endif;
    }
}

$webinars = new WebinarsLinux();
function webinars_linux($atts, $content)
{
    // GET SALIENT COLORS
    $nectar_options = get_nectar_theme_options();
    $accent_color = $nectar_options["accent-color"];
    $extra_color1 = $nectar_options["extra-color-1"];
    $extra_color2 = $nectar_options["extra-color-2"];
    $extra_color3 = $nectar_options["extra-color-3"];
    //$accent_color = substr($nectar_options["accent-color"], 1);
    $ac_r = hexdec(substr($accent_color, 0, 2));
    $ac_g = hexdec(substr($accent_color, 2, 2));
    $ac_b = hexdec(substr($accent_color, 4, 2));
    $ac_rgba =
        "rgba(" .
        esc_attr($ac_r) .
        "," .
        esc_attr($ac_g) .
        "," .
        esc_attr($ac_b) .
        ", 0.3)";
    extract(
        shortcode_atts(
            [
                "columns" => "",
                "limit" => "",
                "sort" => "",
                "category_id" => "",
                "schedule" => "",
                "featured_image" => "",
                "dut" => "",
                "excerpt" => "",
                "excerpt_length" => "",
                "navigation_text" => "",
				"remove_hyperlink_title" => "",
                "pagination" => "",
                "suppress_filters" => true
            ],
            $atts
        )
    );

    $columns = !empty($columns) ? $columns : "4";
    $limit = !empty($limit) ? $limit : "4";
    $sort = !empty($sort) ? $sort : "ASC";
    $schedule = !empty($schedule) ? $schedule : "";
    $featured_image = !empty($featured_image)
        ? $featured_image
        : "show-featured-image";
    $dut = !empty($dut) ? $dut : "hide-dut";
    $excerpt = !empty($excerpt) ? $excerpt : "hide-excerpt";
    $excerpt_length = !empty($excerpt_length) ? $excerpt_length : "50";
    $navigation_text = !empty($navigation_text) ? $navigation_text : "WATCH";
	$remove_hyperlink_title = !empty($remove_hyperlink_title) ? $remove_hyperlink_title : "keep-hyperlink";
    $pagination = !empty($pagination) ? $pagination : "show-pagination";
    $paged = get_query_var("paged") ? get_query_var("paged") : 1;

    if ($schedule == "scheduled") {
        $schedule_status = "future";
    } elseif ($schedule = "published") {
        $schedule_status == "publish";
    }

    $query_args = [
        "post_type" => "webinars",
        "post_status" => $schedule_status,
        "posts_per_page" => $limit,
        "order" => $sort,
        "offset" => $offset,
        "ignore_sticky_posts" => true,
        "nopaging" => false,
        "paged" => $paged
    ];

    // KEEP UNDER FIRST QUERY ARGS
    if (!empty($category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "webinars_category",
                "field" => "term_id",
                "terms" => [$category_id]
            ]
        ];
    }

    switch ($columns) {
        case "1":
            $column_class = "col span_12";
        case "2":
            $column_class = "col span_6";
            break;
        case "3":
            $column_class = "col span_4";
            break;
        case "4":
            $column_class = "col span_3";
            break;
        default:
            $column_class = "col span_6";
            break;
    }
    switch ($pagination) {
        case "show-pagination":
            $pagination = true;
            break;
        case "hide-pagination":
            $pagination = false;
            break;
        default:
            $pagination = true;
            break;
    }
    switch ($featured_image) {
        case "show-featured-image":
            $featured_image = true;
            break;
        case "hide-featured-image":
            $featured_image = false;
            break;
        default:
            $featured_image = true;
            break;
    }
    switch ($dut) {
        case "show-dut":
            $dut = true;
            break;
        case "hide-dut":
            $dut = false;
            break;
        default:
            $dut = true;
            break;
    }
    switch ($excerpt) {
        case "show-excerpt":
            $excerpt = true;
            break;
        case "hide-excerpt":
            $excerpt = false;
            break;
        default:
            $excerpt = true;
            break;
    }
	
    switch ($remove_hyperlink_title) {
        case "remove-hyperlink":
            $remove_hyperlink_title = true;
            break;
        case "keep-hyperlink":
            $remove_hyperlink_title = false;
            break;
        default:
            $remove_hyperlink_title = true;
            break;
    }	
	
    $webinars_query = new WP_Query($query_args);
    $output = "";
    if ($webinars_query->have_posts()) {
        $count = 0;
        while ($webinars_query->have_posts()):
            $webinars_query->the_post();

            if ($count == 0) {
                $output .= '<div class="webinars-outer">';
            }

            $speaker = get_field("webinars_speakers_name");
            $designation = get_field("webinars_speakers_company");
            $video_link = get_field("webinars_video_link", false, false);
            $register_link = get_field("webinars_register_link");

            $iframe = get_field("webinars_video_link");
            preg_match('/src="(.+?)"/', $iframe, $matches);
            $src = $matches[1];
            $params = ["controls" => 0, "hd" => 1, "autohide" => 1];
            $new_src = add_query_arg($params, $src);
            $iframe = str_replace($src, $new_src, $iframe);
            $attributes = 'frameborder="0"';
            $iframe = str_replace(
                "></iframe>",
                " " . $attributes . "></iframe>",
                $iframe
            );

            if ($featured_image == true) {
                $output .= '<div class="webinars-inner">';
                if ($matches[1] && ($video_link != null || $video_link != "")) {
                    $output .= $iframe;
                } else {
                    $output .=
                        '<div class="webinars-non-iframe">' .
                        '<img src="' .
                        nectar_options_img($nectar_options["logo"]) .
                        '">' .
                        "</div>";
                }
                $output .= "</div>";
            }

            $output .= '<div class="webinars-inner">';
            if ($dut == false) {
                $output .=
                    '<h4 class="webinars-date">' .
                    get_the_date("M j, Y") .
                    "</h4>";
            }
			
			if($remove_hyperlink_title == true) {
            $output .=
                '<h2 class="webinars-title">' .
                get_the_title() .
                "</h2>";
			}
			if($remove_hyperlink_title == false) {
				            $output .=
                '<h2 class="webinars-title">' .
                '<a href="' .
                get_the_permalink() .
                '">' .
                get_the_title() .
                "</a>" .
                "</h2>";
			}
				
				
				
            if (have_rows("webinars_speakers")):
                while (have_rows("webinars_speakers")):
                    the_row();
                    if (get_row_layout() == "webinars_speakers_information"):
                        if (
                            get_sub_field("webinars_speakers_company") !=
                                null &&
                            get_sub_field("webinars_speakers_title") != null
                        ):
                            $output .=
                                "<h3>" .
                                '<span class="webinars-speaker">' .
                                get_sub_field("webinars_speakers_name") .
                                '<span class="webinars-comma">, </span>' .
                                "</span>" .
                                '<span class="webinars-speaker">' .
                                get_sub_field("webinars_speakers_title") .
                                "</span>" .
                                '<span class="webinars-comma">, </span>' .
                                '<span class="webinars-designation">' .
                                get_sub_field("webinars_speakers_company") .
                                "</span>" .
                                "</h3>";
                        elseif (
                            get_sub_field("webinars_speakers_company") !=
                                null &&
                            get_sub_field("webinars_speakers_title") == null
                        ):
                            $output .=
                                "<h3>" .
                                '<span class="webinars-speaker">' .
                                get_sub_field("webinars_speakers_name") .
                                '<span class="webinars-comma">, </span>' .
                                '<span class="webinars-designation">' .
                                get_sub_field("webinars_speakers_company") .
                                "</span>" .
                                "</h3>";
                        elseif (
                            get_sub_field("webinars_speakers_company") ==
                                null &&
                            get_sub_field("webinars_speakers_title") != null
                        ):
                            $output .=
                                "<h3>" .
                                '<span class="webinars-speaker">' .
                                get_sub_field("webinars_speakers_name") .
                                '<span class="webinars-comma">, </span>' .
                                '<span class="webinars-designation">' .
                                get_sub_field("webinars_speakers_title") .
                                "</span>" .
                                "</h3>";
                        else:
                            $output .=
                                "<h3>" .
                                '<span class="webinars-speaker">' .
                                get_sub_field("webinars_speakers_name") .
                                "</span>" .
                                "</h3>";
                        endif;
                    endif;
                endwhile;
            else:
            endif;

            if (have_rows("webinars_moderators")):
                while (have_rows("webinars_moderators")):
                    the_row();
                    if (get_row_layout() == "webinars_moderators_information"):
                        if (
                            get_sub_field("webinars_moderators_company") !=
                                null &&
                            get_sub_field("webinars_moderators_title") != null
                        ):
                            $output .=
                                "<h3>" .
                                '<span class="webinars-moderator">' .
                                get_sub_field("webinars_moderators_name") .
                                '<span class="webinars-comma">, </span>' .
                                "</span>" .
                                '<span class="webinars-moderator">' .
                                get_sub_field("webinars_moderators_title") .
                                "</span>" .
                                '<span class="webinars-comma">, </span>' .
                                '<span class="webinars-designation">' .
                                get_sub_field("webinars_moderators_company") .
                                "</span>" .
                                "</h3>";
                        elseif (
                            get_sub_field("webinars_moderators_company") !=
                                null &&
                            get_sub_field("webinars_moderators_title") == null
                        ):
                            $output .=
                                "<h3>" .
                                '<span class="webinars-moderator">' .
                                get_sub_field("webinars_moderators_name") .
                                '<span class="webinars-comma">, </span>' .
                                '<span class="webinars-designation">' .
                                get_sub_field("webinars_moderators_company") .
                                "</span>" .
                                "</h3>";
                        elseif (
                            get_sub_field("webinars_moderators_company") ==
                                null &&
                            get_sub_field("webinars_moderators_title") != null
                        ):
                            $output .=
                                "<h3>" .
                                '<span class="webinars-moderator">' .
                                get_sub_field("webinars_moderators_name") .
                                '<span class="webinars-comma">, </span>' .
                                '<span class="webinars-designation">' .
                                get_sub_field("webinars_moderators_title") .
                                "</span>" .
                                "</h3>";
                        else:
                            $output .=
                                "<h3>" .
                                '<span class="webinars-moderator">' .
                                get_sub_field("webinars_moderators_name") .
                                "</span>" .
                                "</h3>";
                        endif;
                    endif;
                endwhile;
            else:
            endif;

            if ($dut == true) {
                $output .=
                    '<h4 class="webinars-date">' .
                    get_the_date("M j, Y") .
                    "</h4>";
            }

            if ($excerpt == true) {
                $output .=
                    "<p class='webinars-excerpt'>" .
                    wp_trim_words(
                        get_field("webinars_description"),
                        $excerpt_length,
                        '...'
                    ) .
                    "</p>";
            }

            if (
                ($video_link != null || $video_link != "") &&
                ($register_link == null || $register_link == "")
            ) {
                $output .=
                    '<div class="webinars-navigation-btn"><a href="' .
                    $video_link .
                    '" target="_blank" style="background-color:' .
                    $accent_color .
                    '">' .
                    $navigation_text .
                    "</a></div>";
            }

            if ($register_link != null || $register_link != "") {
                $output .=
                    '<div class="webinars-navigation-btn"><a href="' .
                    $register_link .
                    '" target="_blank" style="background-color:' .
                    $accent_color .
                    '">' .
                    $navigation_text .
                    "</a></div>";
            }

            $output .= "</div>";

            $count++;
            if (
                $count == $columns ||
                $webinars_query->current_post + 1 == $webinars_query->post_count
            ) {
                $output .= "</div>";
                $count = 0;
            }
        endwhile;

        // PAGINATION
        if ($pagination != false) {
            $big = 999999999;
            $output .=
                '<div class="recent-posts-pagination" style="color:#ffffff">';
            $output .=
                '<div class="links" style="color:' . $accent_color . '">';
            $output .= paginate_links([
                "base" => str_replace(
                    $big,
                    "%#%",
                    esc_url(get_pagenum_link($big))
                ),
                "format" => "?paged=%#%",
                "current" => max(1, get_query_var("paged")),
                "total" => $webinars_query->max_num_pages,
                "before_page_number" =>
                    '<span style="background-color:' . $accent_color . '">',
                "after_page_number" => "</span>",
                "next_text" =>
                    '<span style="background-color:' .
                    $accent_color .
                    '">Next →</span>',
                "prev_text" =>
                    '<span style="background-color:' .
                    $accent_color .
                    '">Prev ←</span>'
            ]);
            $output .= "</div>";
            $output .= "</div>";
        }

        wp_reset_postdata();
    } else {
        $output .=
            '<h3 class="coming-soon">' .
            esc_html__("Coming soon!", "webinars") .
            '</h3>';
    }
    return $output;
}

add_shortcode("webinars_linux_foundation", "webinars_linux");
