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
            "suppress_filters" => true,
        ]);

        $single_category = ["All" => ""];
        foreach ($types as $type) {
            $single_category[$type->name] = $type->term_id;
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
                        "save_always" => true,
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
                        "save_always" => true,
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
                        "save_always" => true,
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Sort", "webinars"),
                        "param_name" => "sort",
                        "value" => [
                            esc_html__("Descending", "webinars") => "DESC",
                            esc_html__("Ascending", "webinars") => "ASC",
                        ],
                        "description" => esc_html__(
                            "Select the sorting direction to be displayed.",
                            "salient-core"
                        ),
                        "save_always" => true,
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
                            ) => "hide-pagination",
                        ],
                        "std" => "show-pagination",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide pagination.",
                            "webinars"
                        ),
                        "save_always" => true,
                    ],
                ],
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
                "limit" => "",
                "sort" => "",
                "category_id" => "",
                "navigation_text" => "",
                "pagination" => "",
                "suppress_filters" => true,
            ],
            $atts
        )
    );

    $limit = !empty($limit) ? $limit : "4";
    $sort = !empty($sort) ? $sort : "ASC";
    $navigation_text = !empty($navigation_text)
        ? $navigation_text
        : "WATCH THE RECORDING";
    $pagination = !empty($pagination) ? $pagination : "show-pagination";
    $paged = get_query_var("paged") ? get_query_var("paged") : 1;

    $query_args = [
        "post_type" => "webinars",
        "post_status" => ["publish"],
        "posts_per_page" => $limit,
        "order" => $sort,
        "offset" => $offset,
        "ignore_sticky_posts" => true,
        "nopaging" => false,
        "paged" => $paged,
    ];

    // KEEP UNDER FIRST QUERY ARGS
    if (!empty($category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "webinars_category",
                "field" => "term_id",
                "terms" => [$category_id],
            ],
        ];
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
            $designation = get_field("webinars_speakers_title");
            $link = get_field("webinars_video_link", false, false);

            $iframe = get_field("webinars_video_link");
            preg_match('/src="(.+?)"/', $iframe, $matches);
            $src = $matches[1];
            $params = [
                "controls" => 0,
                "hd" => 1,
                "autohide" => 1,
            ];
            $new_src = add_query_arg($params, $src);
            $iframe = str_replace($src, $new_src, $iframe);
            $attributes = 'frameborder="0"';
            $iframe = str_replace(
                "></iframe>",
                " " . $attributes . "></iframe>",
                $iframe
            );

            $output .= ' <div class="webinars-inner">';
            $output .= $iframe;
            $output .= "</div>";

            $output .= '<div class="webinars-inner">';
            $output .=
                '<h2 class="webinars-title">' . get_the_title() . "</h2>";
            if (have_rows("webinars_speakers")):
                while (have_rows("webinars_speakers")):
                    the_row();
                    if (get_row_layout() == "webinars_speakers_names_titles"):
                        $output .=
                            "<h3>" .
                            '<span class="webinars-speaker">' .
                            get_sub_field("webinars_speakers_name") .
                            "</span>" .
                            " " .
                            '<span class="webinars-designation">' .
                            get_sub_field("webinars_speakers_title") .
                            "</span>" .
                            "</h3>";
                    endif;
                endwhile;
            else:
            endif;
            $output .=
                '<h4 class="webinars-date">' . get_the_date("M j, Y") . "</h4>";
            $output .=
                '<div class="webinars-navigation-btn"><a href="' .
                $link .
                '" target="_blank" style="background-color:' .
                $accent_color .
                '">' .
                $navigation_text .
                "</a></div>";
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

        $big = 999999999;
        $output .=
            '<div class="recent-posts-pagination" style="color:#ffffff">';
        $output .= '<div class="links" style="color:' . $accent_color . '">';
        $output .= paginate_links([
            "base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))),
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
                '">Prev ←</span>',
        ]);
        $output .= "</div>";
        $output .= "</div>";

        wp_reset_postdata();
    } else {
        $output .= esc_html__("No recent posts listed", "webinars");
    }
    return $output;
}

add_shortcode("webinars_linux_foundation", "webinars_linux");
