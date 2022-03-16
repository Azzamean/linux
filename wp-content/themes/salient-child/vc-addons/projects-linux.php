<?php
class Projects
{
    function __construct()
    {
        add_action("vc_before_init", [$this, "projects_grid_vc"]);
    }

    function projects_grid_vc()
    {
        $types = get_terms([
            "taxonomy" => "projects_category",
            "hide_empty" => false,
            "orderby" => "name",
        ]);

        $all_projects_category = ["All Projects Categories" => ""];
        foreach ($types as $type) {
            $all_projects_category[$type->name] = $type->term_id;
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
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Limit", "projects"),
                    "param_name" => "limit",
                    "value" => "-1",
                    "description" => __(
                        "Enter number of people to be displayed. Enter -1 to display all.",
                        "projects"
                    ),
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Order By", "projects"),
                    "param_name" => "orderby",
                    "value" => [
                        __("Name", "projects") => "title",
                        __("Date", "projects") => "date",
                        __("ID", "projects") => "ID",
                        __("Random", "projects") => "rand",
                    ],
                    "description" => __("Select order type.", "projects"),
                ],
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Sort order", "projects"),
                    "param_name" => "order",
                    "value" => [
                        __("Descending", "projects") => "DESC",
                        __("Ascending", "projects") => "ASC",
                    ],
                    "description" => __("Select sorting order.", "projects"),
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
                "limit" => "-1",
                "order" => "ASC",
                "orderby" => "title",
                "projects_category_id" => "",
                "columns" => "",
            ],
            $atts
        )
    );

    $query_args = [
        "post_type" => "projects",
        "post_status" => ["publish"],
        "posts_per_page" => $limit,
        "order" => $order,
        "orderby" => $orderby,
        "ignore_sticky_posts" => true,
    ];

    $limit = !empty($limit) ? $limit : "15";
    $order = strtolower($order) == "asc" ? "ASC" : "DESC";
    $orderby = !empty($orderby) ? $orderby : "title";
    $columns = !empty($columns) ? $columns : "2";

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

    if (!empty($projects_category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "projects_category",
                "field" => "term_id",
                "terms" => $projects_category_id,
            ],
        ];
    }

    $projects_query = new WP_Query($query_args);
    $output = "";
    $count = 0;

    if ($projects_query->have_posts()) {
        $count = 0;
        while ($projects_query->have_posts()):
            $projects_query->the_post();
            if ($count == 0) {
                $output .= '<div class="grid-design outer">';
            }
            $output .=
                '<div class="' . $column_class . ' grid-design projects">';
            $output .= '<img src="' . get_field("projects_logo") . '"/>';
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
            $count++;
            if (
                $count == $columns ||
                $projects_query->current_post + 1 == $projects_query->post_count
            ) {
                $output .= "</div>";
                $count = 0;
            }
        endwhile; /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        $output .= "No projects listed";
    }
    return $output;
}
add_shortcode("projects", "projects_grid");
