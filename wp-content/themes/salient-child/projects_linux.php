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
            "taxonomy" => "project_type",
            "hide_empty" => false,
            "orderby" => "name",
        ]);

        $pt = ["All" => ""];
        foreach ($types as $type) {
            $pt[$type->name] = $type->term_id;
        }
        vc_map([
            "name" => __("Projects", "projects"),
            "base" => "projects",
            "icon" => "fa fa-users",
            "class" => "",
            "category" => __("Content", "projects"),
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
                    "heading" => __("Projects Type", "projects"),
                    "param_name" => "project_type_id",
                    "value" => $pt,
                    "description" => __("", "projects"),
                ],
            ],
        ]);
    }
}

$projects = new Projects();

function projects_grid($atts, $content)
{
    extract(
        shortcode_atts(
            [
                "limit" => "-1",
                "order" => "ASC",
                "orderby" => "title",
                "project_type_id" => "",
                "columns" => "vc_col-sm-3",
            ],
            $atts
        )
    );

    $limit = !empty($limit) ? $limit : "15";
    $order = strtolower($order) == "asc" ? "ASC" : "DESC";
    $orderby = !empty($orderby) ? $orderby : "title";
    switch ($columns) {
        case "3":
            $column_class = "vc_col-sm-4";
            break;
        case "4":
            $column_class = "vc_col-sm-3";
            break;
        case "5":
            $column_class = "col-sm-5cols";
            break;
        default:
            $column_class = "vc_col-sm-3";
            break;
    }

    $query_args = [
        "post_type" => "projects",
        "post_status" => ["publish"],
        "posts_per_page" => $limit,
        "order" => $order,
        "orderby" => $orderby,
        "ignore_sticky_posts" => true,
    ];

    if (!empty($project_type_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "project_type",
                "field" => "term_id",
                "terms" => $project_type_id,
            ],
        ];
    }
    $output = "";
    $projects_query = new WP_Query($query_args);
    $count = 0;
    ?>
        <?php
        if ($projects_query->have_posts()) {
            $count = 0;
            while ($projects_query->have_posts()):
                $projects_query->the_post();
                if ($count == 0) {
                    $output .=
                        '<div class="col span_12 left" data-midnight="dark">';
                }
                $output .=
                    '<div class="' .
                    $column_class .
                    ' wpb_coluon="fade-in-from-bottom" data-delay="0">
									<div class="vc_column-inner">
										<div class="wpb_wrapper">									
											<div class="single-project-grid">
												<div class="span_12 single-project-header">
													<div class="single-project-icon">
														<img src="' .
                    get_field("image") .
                    '">
													</div>
													<div class="single-project-title">
														<h3>' .
                    get_the_title() .
                    "</h3>";
                if (get_field("job")) {
                    $output .= "<h5>" . get_field("job") . "</h5>";
                }
                $output .=
                    '
													</div>
												</div> <!-- End Single project Header -->
												<div class="single-project-description">
													<p class="short_description">' .
                    get_field("short_description") .
                    '</p>
													<p class="read-more"><a href="#" data-featherlight="#' .
                    get_post_field("post_name") .
                    '">Read More</a></p>
													<div class="social-links">';
                if (!empty(get_field("links"))) {
                    foreach (get_field("links") as $link) {
                        $output .=
                            '<a href="' .
                            $link["website"] .
                            '" target="blank" title="' .
                            $link["name"] .
                            '"><i class="fa ' .
                            $link["icon"] .
                            '"></i></a>';
                    }
                }
                $output .=
                    '
													</div>
													<div id="' .
                    get_post_field("post_name") .
                    '" class="lightbox">
														<p class="description">' .
                    wpautop(get_field("description")) .
                    '</p>
													</div>                 
												</div>
											</div>
										</div>
									</div></div>';
                $count++;
                if (
                    $count == 4 ||
                    $projects_query->current_post + 1 ==
                        $projects_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            endwhile;
            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            $output .= "No projects listed";
        }

        return $output;
}

add_shortcode("projects", "projects_grid");
