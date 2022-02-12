<?php
class RecentPostsLinux
{
    function __construct()
    {
        add_action("init", [$this, "recent_posts_vc_linux"], 99999);
    }

    function recent_posts_vc_linux()
    {
        $types = get_terms(["taxonomy" => "category", "hide_empty" => true, "orderby" => "name", "suppress_filters" => true, ]);

        $pt = ["All" => ""];
        foreach ($types as $type)
        {
            $pt[$type
                ->name] = $type->term_id;
        }
        if (function_exists("vc_map")):
            vc_map(["name" => esc_html__("Recent Posts - Linux Foundation Designed", "recent_posts") , "base" => "recent_posts_basic", "icon" => "vc_element-icon icon-wpb-recent-posts", "class" => "", "category" => esc_html__("Linux Foundation", "recent_posts") , "description" => esc_html__("Display list of recent_posts custom post type", "recent_posts") , "params" => [["type" => "dropdown", "heading" => esc_html__("Design", "salient-core") , "param_name" => "design", "admin_label" => true, "value" => [esc_html__("Basic Design", "salient-core") => "basic-design", esc_html__("Grid Design", "salient-core") => "grid-design", ], "save_always" => true, "description" => esc_html__("Please select the design you desire for your blog", "salient-core") , ], ["type" => "dropdown", "class" => "", "heading" => esc_html__("Columns", "recent_posts") , "param_name" => "columns", "value" => [esc_html__("2 Columns", "recent_posts") => "2", esc_html__("3 Columns", "recent_posts") => "3", esc_html__("4 Columns", "recent_posts") => "4", ], "dependency" => ["element" => "design", "value" => ["grid-design"], ], "description" => esc_html__("Please select the number of columns you want displayed", "salient-core") , "save_always" => true, ], ["type" => "dropdown_multi", "class" => "", "heading" => esc_html__("Recent Posts Categories", "recent_posts") , "param_name" => "category_id", "value" => $pt, "description" => esc_html__("", "recent_posts") , "save_always" => true, ], ], ]);
        endif;
    }
}

$recent_posts = new RecentPostsLinux();
function recent_posts_linux($atts, $content)
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
    $ac_rgba = 'rgba(' . esc_attr($ac_r) . ',' . esc_attr($ac_g) . ',' . esc_attr($ac_b) . ', 0.3)';
		
    extract(shortcode_atts(["limit" => "-1", "design" => "design", "columns" => "", "category_id" => "",
    //"order" => "DESC",
    //"orderby" => "date",
    "suppress_filters" => true, ], $atts));

    $limit = !empty($limit) ? $limit : "8";
    //$order = strtolower($order) == "asc" ? "ASC" : "DESC";
    //$orderby = !empty($orderby) ? $orderby : "title";
    $columns = !empty($columns) ? $columns : "4";
    $design = !empty($design) ? $design : "basic-design";
    $paged = get_query_var("paged") ? get_query_var("paged") : 1;

    $query_args = ["post_type" => "post", 
	"post_status" => ["publish"], 
	"posts_per_page" => 10, 
	//"order" => $order, 
	//"orderby" => $orderby, 
	"ignore_sticky_posts" => true, 
	"nopaging" => false, 
	"paged" => $paged, ];

    if (!empty($category_id))
    {
        $query_args["tax_query"] = [["taxonomy" => "category", "field" => "term_id", "terms" => [$category_id], ], ];
    }
    if (!empty($exclude_post_id))
    {
        $query_args["postesc_html__not_in"] = explode(",", $exclude_post_id);
    }

    switch ($columns)
    {
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

    switch ($design)
    {
        case "basic-design":
            $design = "Basic Design";
        break;
        case "grid-design":
            $design = "Grid Design";
        break;
        default:
            $design = "Basic Design";
        break;
    }

    $recent_posts_query = new WP_Query($query_args);
    $output = "";
    if ($recent_posts_query->have_posts())
    {
        $count = 0;
        while ($recent_posts_query->have_posts()):
            $recent_posts_query->the_post();
			


            //Basic DESIGN
            if ($design == "Basic Design")
            {
                if ($count == 0)
                {
                    $output .= '<div class="basic-design-outer">';
                }
                // Left Side
                $output .= '<div class="basic-design-flex">';
                $output .= '<div class="basic-design-left">';
                $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, "full", $image_attrs) . "</a>";
                $output .= "</div>";
                // Right Side
                $output .= '<div class="basic-design-right">';

                $output .= '<h3 class="basic-design-title"><a href="' . get_permalink() . '" style="color:' . $accent_color . '">' . get_the_title() . "</a></h3>";
                $output .= '<p class="basic-design-date">' . get_the_date("M j, Y") . "</p>";
                $excerpt_length = !empty($nectar_options[""]) ? intval($nectar_options[""]) : 50;
                $excerpt_markup = '<p class="basic-design-excerpt">' . nectar_excerpt($excerpt_length) . "</p>";
                $output .= $excerpt_markup;
                $output .= "</div>";
                $output .= "</div>";
                $count++;
                if ($count == $columns || $recent_posts_query->current_post + 1 == $recent_posts_query->post_count)
                {
                    $output .= "</div>";
                    $count = 0;
                }
            }

            // GRID DESIGN
            if ($design == "Grid Design") {
                if ($count == 0) {
                    $output .= '<div class="grid-design-outer">';
                }
                $output .= '<div class="' . $column_class . ' grid-design-square">';
                $output .= '<div class="grid-design-header"><h3 class="grid-design-title">' . get_the_title() . "</h3>";
                $output .= '<span class="grid-design-divider"> | </span>';
                $output .= '<span class="grid-design-date">' . get_the_date("M j, Y") . "</span></div>";
                $nectar_options = get_nectar_theme_options();
                $excerpt_length = !empty($nectar_options["blog_excerpt_length"]) ? intval($nectar_options["blog_excerpt_length"]) : 30;
                $excerpt_markup = '<div class="grid-design-excerpt"><span>' . nectar_excerpt($excerpt_length) . "</span></div>";
                $output .= $excerpt_markup;
                $output .= '<div class="grid-design-read"><a href="' . get_permalink() . '" target="_blank" style="background-color:' . $accent_color . '">Read</a></div>';
                $output .= "</div>";
                $count++;
                if ($count == $columns || $recent_posts_query->current_post + 1 == $recent_posts_query->post_count) {
                    $output .= "</div>";
                    $count = 0;
                }
            }
        endwhile;


        // PAGINATION
        $big = 999999999;
        $output .= '<div class="design-pagination" style="color:#ffffff">';
        $output .= '<div class="links" style="color:' . $accent_color . '">';
        $output .= paginate_links(["base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))) , "format" => "?paged=%#%", "current" => max(1, get_query_var("paged")) , "total" => $recent_posts_query->max_num_pages, "before_page_number" => '<span style="background-color:' . $accent_color . '">', "after_page_number" => '</span>', "next_text" => '<span style="background-color:' . $accent_color . '">Next →</span>', "prev_text" => '<span style="background-color:' . $accent_color . '">Prev ←</span>', ]);
        $output .= '</div>';
        $output .= '</div>';

        wp_reset_postdata();

    }
    else
    {
        $output .= esc_html__("No recent posts listed", "recent_posts");
    }
    return $output;
}

add_shortcode("recent_posts_basic", "recent_posts_linux");

?>
