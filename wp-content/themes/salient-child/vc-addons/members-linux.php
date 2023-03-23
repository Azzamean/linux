<?php
class Members
{
    public function __construct()
    {
        add_action("init", [$this, "members_vc_linux"], 99999);
    }

    public function members_vc_linux()
    {
        $types = get_terms([
            "taxonomy" => "members_category",
            "hide_empty" => false,
            "orderby" => "name",
        ]);

        $all_members_category = ["All Members Categories" => ""];
        foreach ($types as $type) {
            $all_members_category[$type->name] = $type->term_id;
        }

        if (function_exists("vc_map")):
            vc_map([
                "name" => esc_html__(
                    "Members - Linux Foundation Designed",
                    "members"
                ),
                "base" => "members_linux_foundation",
                "icon" => "vc_element-icon icon-wpb-portfolio",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "members"),
                "description" => esc_html__("Display member logos.", "members"),
                "params" => [
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Columns", "members"),
                        "param_name" => "columns",
                        "value" => [
                            esc_html__("2 columns", "members") => "2",
                            esc_html__("3 columns", "members") => "3",
                            esc_html__("4 columns", "members") => "4",
                            esc_html__("5 columns", "members") => "5",
                        ],
                        "description" => esc_html__(
                            "Please select the number of columns you want displayed",
                            "members"
                        ),
                        "save_always" => true,
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => __("Category", "members"),
                        "param_name" => "members_category_id",
                        "value" => $all_members_category,
                        "description" => __("", "members"),
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => __("Sort Order", "members"),
                        "param_name" => "order",
                        "value" => [
                            __("Ascending", "members") => "ASC",
                            __("Descending", "members") => "DESC",
                        ],
                        "description" => __("Select sorting order.", "members"),
                    ],
                ],
            ]);
        endif;
    }
}

$members_api = new Members();
function members_linux($atts, $content)
{
    extract(
        shortcode_atts(
            [
                "columns" => "",
                "members_category_id" => "",
                "order" => "",
            ],
            $atts
        )
    );

    $columns = !empty($columns) ? $columns : "";
    $order = !empty($order) ? $order : "ASC";

    $query_args = [
        "post_type" => "members",
        "post_status" => ["publish"],
        "posts_per_page" => -1,
        "order" => $order,
        "orderby" => "title",
        "ignore_sticky_posts" => true,
    ];

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
        case "5":
            $column_class = "vc_col-sm-1/5";
            break;
        default:
            $column_class = "vc_col-sm-3";
            break;
    }
    if (!empty($members_category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "members_category",
                "field" => "term_id",
                "terms" => $members_category_id,
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
                '<div class="' . $column_class . ' grid-design members">';
            $output .= '<div class="grid-design image-wrapper">';
            if (
                get_field("members_url") != null ||
                get_field("members_url") != ""
            ) {
                $output .=
                    '<a href="' .
                    get_field("members_url") .
                    '"><img src="' .
                    get_field("members_logo") .
                    '"/></a>';
            } else {
                $output .= '<img src="' . get_field("members_logo") . '"/>';
            }
            $output .= "</div>";
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
        $output .= "No members listed";
    }
    return $output;
}

add_shortcode("members_linux_foundation", "members_linux");
