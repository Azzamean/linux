<?php
class Projects
{
    function __construct()
    {
        add_action("vc_before_init", [$this, "projects_grid_vc"]);
    }

    function projects_grid_vc()
    {
        $categoryTypes = get_terms([
            "taxonomy" => "projects_category",
            "hide_empty" => false,
            "orderby" => "name",
        ]);

        $all_projects_category = ["All Projects Categories" => ""];
        foreach ($categoryTypes as $catType) {
            $all_projects_category[$catType->name] = $catType->term_id;
        }

        $stageTypes = get_terms([
            "taxonomy" => "projects_stage",
            "hide_empty" => false,
            "orderby" => "name",
        ]);

        $all_projects_stage = ["All Projects Stages" => ""];
        foreach ($stageTypes as $stageType) {
            $all_projects_stage[$stageType->name] = $stageType->term_id;
        }

        vc_map([
            "name" => __("Projects - Linux Foundation Designed", "projects"),
            "base" => "projects",
            "icon" => "vc_element-icon icon-wpb-portfolio",
            "class" => "",
            "category" => __("Linux Foundation", "projects"),
            "description" => __(
                "Display list of Projects custom post type",
                "projects"
            ),
            "params" => [
                [
                    "type" => "dropdown",
                    "heading" => esc_html__("Design", "projects"),
                    "param_name" => "design",
                    "admin_label" => true,
                    "value" => [
                        esc_html__("Grid Design", "projects") => "grid-design",
                        esc_html__(
                            "Flipbox Design",
                            "projects"
                        ) => "flipbox-design",
                    ],
                    "save_always" => true,
                    "description" => esc_html__(
                        "Select the design you desire for your projects.",
                        "projects"
                    ),
                ],
                [
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Limit", "projects"),
                    "param_name" => "limit",
                    "value" => "",
                    "description" => __(
                        "Enter number of people to be displayed. Enter -1 to display all.",
                        "projects"
                    ),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Order By", "projects"),
                    "param_name" => "orderby",
                    "value" => [
                        __("Title", "projects") => "title",
                        __("Date", "projects") => "date",
                        __("ID", "projects") => "ID",
                        __("Random", "projects") => "rand",
                    ],
                    "description" => __("Select order type.", "projects"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Sort Order", "projects"),
                    "param_name" => "order",
                    "value" => [
                        __("Ascending", "projects") => "ASC",
                        __("Descending", "projects") => "DESC",
                    ],
                    "description" => __("Select sorting order.", "projects"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("columns", "projects"),
                    "param_name" => "columns",
                    "value" => [
                        esc_html__("2 columns", "projects") => "2",
                        esc_html__("3 columns", "projects") => "3",
                        esc_html__("4 columns", "projects") => "4",
                    ],
                    "description" => esc_html__(
                        "Please select the number of columns you want displayed",
                        "projects"
                    ),
                    "save_always" => true,
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Category", "projects"),
                    "param_name" => "projects_category_id",
                    "value" => $all_projects_category,
                    "description" => __("", "projects"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],

                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Stages", "projects"),
                    "param_name" => "projects_stages_id",
                    "value" => $all_projects_stage,
                    "description" => __("", "projects"),
                    "dependency" => [
                        "element" => "design",
                        "value" => ["flipbox-design", "grid-design"],
                    ],
                ],
            ],
        ]);
    }
}

$projects = new Projects();

function projects_grid($atts, $content)
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
                "projects_category_id" => "",
                "projects_stages_id" => "",
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
        "post_type" => "projects",
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

    if (!empty($projects_category_id) && !empty($projects_stages_id)) {
        $query_args["tax_query"] = [
            "relation" => "AND",
            [
                "taxonomy" => "projects_category",
                "field" => "term_id",
                "terms" => $projects_category_id,
            ],
            [
                "taxonomy" => "projects_stage",
                "field" => "term_id",
                "terms" => $projects_stages_id,
            ],
        ];
    }

    if (!empty($projects_category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "projects_category",
                "field" => "term_id",
                "terms" => $projects_category_id,
            ],
        ];
    }

    if (!empty($projects_stages_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "projects_stage",
                "field" => "term_id",
                "terms" => $projects_stages_id,
            ],
        ];
    }

    $projects_query = new WP_Query($query_args);
    $output = "";
    $count = 0;

    if ($projects_query->have_posts()) {
        $count = 0;
        while ($projects_query->have_posts()):
            //Grid Design
            if ($design == "Grid Design") {
                $projects_query->the_post();
                if ($count == 0) {
                    $output .= '<div class="grid-design outer">';
                }
                $output .=
                    '<div class="' . $column_class . ' grid-design projects">';
                $output .= '<div class="grid-design image-wrapper">';
                $output .= '<img src="' . get_field("projects_logo") . '"/>';
                $output .= "</div>";
                $output .= '<div class="grid-design body-wrapper">';
                $output .= "<h3>" . get_the_title() . "</h3>";
                $output .=
                    "<p>" .
                    wp_trim_words(get_field("projects_excerpt"), 50) .
                    "</p>";
                $output .=
                    '<a class="grid-design projects-btn" href="' .
                    get_permalink() .
                    '" target="_blank"">Learn More</a>';
                $output .= "</div>";
                $output .= "</div>";
                $count++;
                if (
                    $count == $columns ||
                    $projects_query->current_post + 1 ==
                        $projects_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            }

            //Flipbox Design
            if ($design == "Flipbox Design") {
                $projects_query->the_post();
                if ($count == 0) {
                    $output .= '<div class="flipbox-design outer">';
                }
                $output .=
                    '<div class="' .
                    $column_class .
                    ' flipbox-design projects">';
                $output .= '<div class="flipbox">';
                $output .= '<div class="flipbox-inner">';
                $output .= '<div class="flipbox-front">';
                $output .= '<img src="' . get_field("projects_logo") . '">';
                $output .= "</div>";
                $output .=
                    '<div class="flipbox-back" style="background-color: ' .
                    $accent_color .
                    '">';
                $output .= "<h3>" . get_the_title() . "</h3>";
                $output .=
                    "<p>" .
                    wp_trim_words(get_field("projects_excerpt"), 35) .
                    "</p>";
                $output .=
                    '<a class="flipbox-design projects-btn" href="' .
                    get_permalink() .
                    '" target="_blank" style="color: ' .
                    $accent_color .
                    '" ">Learn More</a>';
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
                $count++;
                if (
                    $count == $columns ||
                    $projects_query->current_post + 1 ==
                        $projects_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            }
        endwhile; /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        $output .= "No projects listed";
    }
    return $output;
}
add_shortcode("projects", "projects_grid");
