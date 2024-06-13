<?php
class Working_Groups
{
    function __construct()
    {
        add_action("vc_before_init", [$this, "working_groups_grid_vc"]);
    }

    function working_groups_grid_vc()
    {
        $categoryTypes = get_terms(
            [
            "taxonomy" => "working_groups_category",
            "hide_empty" => false,
            "orderby" => "name",
            ]
        );

        $all_working_groups_category = ["All Working Groups Categories" => ""];
        foreach ($categoryTypes as $catType) {
            $all_working_groups_category[$catType->name] = $catType->term_id;
        }

        $stageTypes = get_terms(
            [
            "taxonomy" => "working_groups_stage",
            "hide_empty" => false,
            "orderby" => "name",
            ]
        );

        $all_working_groups_stage = ["All Working Groups Stages" => ""];
        foreach ($stageTypes as $stageType) {
            $all_working_groups_stage[$stageType->name] = $stageType->term_id;
        }

        vc_map(
            [
            "name" => __("Working Groups - Linux Foundation Designed", "working_groups"),
            "base" => "working_groups",
            "icon" => "vc_element-icon icon-wpb-portfolio",
            "class" => "",
            "category" => __("Linux Foundation", "working_groups"),
            "description" => __(
                "Display list of Working Groups custom post type",
                "working_groups"
            ),
            "params" => [
                [
                    "type" => "dropdown",
                    "heading" => esc_html__("Design", "working_groups"),
                    "param_name" => "design",
                    "admin_label" => true,
                    "value" => [
                        esc_html__("Grid Design", "working_groups") => "grid-design",
                        esc_html__(
                            "Flipbox Design",
                            "working_groups"
                        ) => "flipbox-design",
                    ],
                    "save_always" => true,
                    "description" => esc_html__(
                        "Select the design you desire for your working groups.",
                        "working_groups"
                    ),
                ],
                [
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Limit", "working_groups"),
                    "param_name" => "limit",
                    "value" => "",
                    "description" => __(
                        "Enter number of people to be displayed. Enter -1 to display all.",
                        "working_groups"
                    ),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Order By", "working_groups"),
                    "param_name" => "orderby",
                    "value" => [
                        __("Title", "working_groups") => "title",
                        __("Date", "working_groups") => "date",
                        __("ID", "working_groups") => "ID",
                        __("Random", "working_groups") => "rand",
                    ],
                    "description" => __("Select order type.", "working_groups"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Sort Order", "working_groups"),
                    "param_name" => "order",
                    "value" => [
                        __("Ascending", "working_groups") => "ASC",
                        __("Descending", "working_groups") => "DESC",
                    ],
                    "description" => __("Select sorting order.", "working_groups"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("columns", "working_groups"),
                    "param_name" => "columns",
                    "value" => [
                        esc_html__("2 columns", "working_groups") => "2",
                        esc_html__("3 columns", "working_groups") => "3",
                        esc_html__("4 columns", "working_groups") => "4",
                    ],
                    "description" => esc_html__(
                        "Please select the number of columns you want displayed",
                        "working_groups"
                    ),
                    "save_always" => true,
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Category", "working_groups"),
                    "param_name" => "working_groups_category_id",
                    "value" => $all_working_groups_category,
                    "description" => __("", "working_groups"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],

                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Stages", "working_groups"),
                    "param_name" => "working_groups_stages_id",
                    "value" => $all_working_groups_stage,
                    "description" => __("", "working_groups"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
            ],
            ]
        );
    }
}

$working_groups = new Working_Groups();

function working_groups_grid($atts, $content)
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
                "design" => "",
                "limit" => "",
                "order" => "",
                "orderby" => "",
                "working_groups_category_id" => "",
                "working_groups_stages_id" => "",
                "columns" => "",
            ],
            $atts
        )
    );

    $design = !empty($design) ? $design : "grid-design";
    $limit = !empty($limit) ? $limit : "15";
    $order = !empty($order) ? $order : "ASC";
    $orderby = !empty($orderby) ? $orderby : "title";
    $columns = !empty($columns) ? $columns : "2";

    $query_args = [
        "post_type" => "working_groups",
        "post_status" => ["publish"],
        "posts_per_page" => $limit,
        "order" => $order,
        "orderby" => $orderby,
        "ignore_sticky_posts" => true,
    ];

    switch ($design) {
    case "grid-design":
        $design = "Grid Design";
        break;
    case "flipbox-design":
        $design = "Flipbox Design";
        break;
    default:
        $design = "Grid Design";
        break;
    }

    switch ($columns) {
    case "2":
        $column_class = "vc_col-sm-6";
        break;
    case "3":
        $column_class = "vc_col-sm-4";
        break;
    case "4":
        $column_class = "vc_col-sm-3";
        break;
    default:
        $column_class = "vc_col-sm-3";
        break;
    }

    if (!empty($working_groups_category_id) && !empty($working_groups_stages_id)) {
        $query_args["tax_query"] = [
            "relation" => "AND",
            [
                "taxonomy" => "working_groups_category",
                "field" => "term_id",
                "terms" => $working_groups_category_id,
            ],
            [
                "taxonomy" => "working_groups_stage",
                "field" => "term_id",
                "terms" => $working_groups_stages_id,
            ],
        ];
    }

    if (!empty($working_groups_category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "working_groups_category",
                "field" => "term_id",
                "terms" => $working_groups_category_id,
            ],
        ];
    }

    if (!empty($working_groups_stages_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "working_groups_stage",
                "field" => "term_id",
                "terms" => $working_groups_stages_id,
            ],
        ];
    }

    $working_groups_query = new WP_Query($query_args);
    $output = "";
    $count = 0;

    if ($working_groups_query->have_posts()) {
        $count = 0;
        while ($working_groups_query->have_posts()):
            //Grid Design
            if ($design == "Grid Design") {
                $working_groups_query->the_post();
                if ($count == 0) {
                    $output .= '<div class="grid-design outer">';
                }
                $output .=
                    '<div class="' . $column_class . ' grid-design working-groups">';
                $output .= '<a class="grid-design link-wrap" href="' . get_permalink() . '">';
                $output .= '<span class="grid-design image-wrapper">';
                $output .= '<img src="' . get_field("working_groups_logo") . '"/>';
                $output .= "</span>";
                $output .= '<span class="grid-design body-wrapper">';
                $output .= "<h3>" . get_the_title() . "</h3>";
                $output .=
                    "<p>" .
                    wp_trim_words(get_field("working_groups_excerpt"), 50) .
                    "</p>";   
                $output .=
                    '<span class="grid-design learn-more">Learn More</span>';
                $output .= "</span>"; // body-wrapper
                $output .= "</a>"; // link-wrap 
                $output .= "</div>"; // working-groups
                $count++;
                if ($count == $columns 
                    || $working_groups_query->current_post + 1 ==$working_groups_query->post_count
                ) {
                    $output .= "</div>"; // outer
                    $count = 0;
                }
            }

            //Flipbox Design
            if ($design == "Flipbox Design") {
                $working_groups_query->the_post();
                if ($count == 0) {
                    $output .= '<div class="flipbox-design outer">';
                }
                $output .=
                    '<div class="' .
                    $column_class .
                    ' flipbox-design working-groups">';
                $output .= '<div class="flipbox">';
                $output .= '<div class="flipbox-inner">';
                $output .= '<div class="flipbox-front">';
                $output .= '<img src="' . get_field("working_groups_logo") . '">';
                $output .= "</div>";
                $output .=
                    '<div class="flipbox-back" style="background-color: ' .
                    $accent_color .
                    '">';
                $output .= "<h3>" . get_the_title() . "</h3>";
                $output .=
                    "<p>" .
                    wp_trim_words(get_field("working_groups_excerpt"), 35) .
                    "</p>";
                $output .=
                    '<a class="flipbox-design working-groups-btn" href="' .
                    get_permalink() .
                    '" style="color: ' .
                    $accent_color .
                    '" ">Learn More</a>';
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
                $count++;
                if ($count == $columns 
                    || $working_groups_query->current_post + 1 ==$working_groups_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            }
        endwhile; /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        $output .= "No Working Groups listed";
    }
    return $output;
}
add_shortcode("working_groups", "working_groups_grid");
