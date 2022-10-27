<?php

class RecentPostsLinux
{
    public function __construct()
    {
        add_action("init", [$this, "recent_posts_vc_linux"], 99999);
    }

    public function recent_posts_vc_linux()
    {
        $types = get_terms([
            "taxonomy" => "category",
            "hide_empty" => true,
            "orderby" => "name",
            "suppress_filters" => true
        ]);

        $pt = ["All" => ""];
        foreach ($types as $type) {
            $pt[$type->name] = $type->term_id;
        }
        if (function_exists("vc_map")):
            vc_map([
                "name" => esc_html__(
                    "Recent Posts - Linux Foundation Designed",
                    "recent_posts"
                ),
                "base" => "recent_posts_basic",
                "icon" => "vc_element-icon icon-wpb-recent-posts",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "recent_posts"),
                "description" => esc_html__(
                    "Display list of recent_posts custom post type",
                    "recent_posts"
                ),
                "params" => [
                    [
                        "type" => "dropdown",
                        "heading" => esc_html__("Design", "salient-core"),
                        "param_name" => "design",
                        "admin_label" => true,
                        "value" => [
                            esc_html__(
                                "Basic Design", //lfenergy
                                "salient-core"
                            ) => "basic-design",
                            esc_html__(
                                "Grid Design", //interuss
                                "salient-core"
                            ) => "grid-design",
                            esc_html__(
                                "Simple Grid Design", //lfaidata
                                "salient-core"
                            ) => "simple-grid-design"
                        ],
                        "save_always" => true,
                        "description" => esc_html__(
                            "Please select the design you desire for your blog",
                            "salient-core"
                        )
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Columns", "recent_posts"),
                        "param_name" => "columns",
                        "value" => [
                            esc_html__("2 Columns", "recent_posts") => "2",
                            esc_html__("3 Columns", "recent_posts") => "3",
                            esc_html__("4 Columns", "recent_posts") => "4"
                        ],
                        "dependency" => [
                            "element" => "design",
                            "value" => ["grid-design"]
                        ],
                        "description" => esc_html__(
                            "Please select the number of columns you want displayed",
                            "salient-core"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown_multi",
                        "class" => "",
                        "heading" => esc_html__(
                            "Recent Posts Categories",
                            "recent_posts"
                        ),
                        "param_name" => "category_id",
                        "value" => $pt,
                        "description" => esc_html__("", "recent_posts"),
                        "save_always" => true
                    ],
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__(
                            "Post Per Page",
                            "recent_posts"
                        ),
                        "param_name" => "limit",
                        "value" => "10",
                        "description" => esc_html__(
                            "Enter number of people to be displayed. Enter -1 to display all.",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Pagination", "recent_posts"),
                        "param_name" => "pagination",
                        "value" => [
                            //esc_html__( 'Show Pagination', 'recent_posts' ) => 'show-pagination',
                            esc_html__(
                                "Hide Pagination",
                                "recent_posts"
                            ) => "hide-pagination"
                        ],
                        "std" => "show-pagination",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide pagination",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Featured Image",
                            "recent_posts"
                        ),
                        "param_name" => "featured_image",
                        "value" => [
                            esc_html__(
                                "Hide Featured Image",
                                "recent_posts"
                            ) => "hide-featured-image"
                        ],
                        "std" => "show-featured-image",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["basic-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide the featured image",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Categories", "recent_posts"),
                        "param_name" => "categories",
                        "value" => [
                            esc_html__(
                                "Show Categories",
                                "recent_posts"
                            ) => "show-categories"
                        ],
                        "std" => "hide-categories",
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide categories",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Tags", "recent_posts"),
                        "param_name" => "tags",
                        "value" => [
                            esc_html__(
                                "Show Tags",
                                "recent_posts"
                            ) => "show-tags"
                        ],
                        "std" => "hide-tags",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["basic-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide tags",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Read More Button",
                            "recent_posts"
                        ),
                        "param_name" => "read",
                        "value" => [
                            esc_html__(
                                "Show Read More Button",
                                "recent_posts"
                            ) => "show-read"
                        ],
                        "std" => "hide-read",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["basic-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide read more button",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Read More Link",
                            "recent_posts"
                        ),
                        "param_name" => "read_link",
                        "value" => [
                            esc_html__(
                                "Show Read More Link",
                                "recent_posts"
                            ) => "show_read_link"
                        ],
                        "std" => "hide_read_link",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["basic-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide read more link",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Date of Publication",
                            "recent_posts"
                        ),
                        "param_name" => "dop",
                        "value" => [
                            esc_html__(
                                "Remove Date of Publication",
                                "recent_posts"
                            ) => "hide-dop"
                        ],
                        "std" => "show-dop",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["basic-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide date of publication",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Excerpt", "recent_posts"),
                        "param_name" => "excerpt",
                        "value" => [
                            esc_html__(
                                "Remove Excerpt",
                                "recent_posts"
                            ) => "hide-excerpt"
                        ],
                        "std" => "show-excerpt",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["basic-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide the excerpt",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__("Show Author", "recent_posts"),
                        "param_name" => "author",
                        "value" => [
                            esc_html__(
                                "Show Author",
                                "recent_posts"
                            ) => "show-author"
                        ],
                        "std" => "hide-author",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["simple-grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check the box if you want to show the author",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Date Under Title",
                            "recent_posts"
                        ),
                        "param_name" => "dut",
                        "value" => [
                            esc_html__(
                                "Date Under Title",
                                "recent_posts"
                            ) => "show-dut"
                        ],
                        "std" => "hide-dut",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["simple-grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check the box if you want the date under the title",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Add Arrow for Navigation",
                            "recent_posts"
                        ),
                        "param_name" => "right_arrow",
                        "value" => [
                            esc_html__(
                                "Add Arrow for Navigation",
                                "recent_posts"
                            ) => "show-right-arrow"
                        ],
                        "std" => "hide-right-arrow",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["simple-grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check the box if you want a right arrow for navigation",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ]
                ]
            ]);
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
                "design" => "",
                "columns" => "",
                "category_id" => "",
                "pagination" => "",
                "featured_image" => "",
                "categories" => "",
                "tags" => "",
                "read" => "",
                "read_link" => "",
                "dop" => "",
                "excerpt" => "",
                "author" => "",
                "dut" => "",
                "right_arrow" => "",
                "suppress_filters" => true
            ],
            $atts
        )
    );

    $limit = !empty($limit) ? $limit : "4";
    $columns = !empty($columns) ? $columns : "4";
    $design = !empty($design) ? $design : "basic-design";
    $paged = get_query_var("paged") ? get_query_var("paged") : 1;
    $pagination = !empty($pagination) ? $pagination : "show-pagination";
    $featured_image = !empty($featured_image)
        ? $featured_image
        : "show-featured-image";
    $categories = !empty($categories) ? $categories : "hide-categories";
    $tags = !empty($tags) ? $tags : "hide-tags";
    $read = !empty($read) ? $read : "hide-read";
    $read_link = !empty($read_link) ? $read_link : "hide_read_link";
    $dop = !empty($dop) ? $dop : "show-dop";
    $excerpt = !empty($excerpt) ? $excerpt : "show-excerpt";
    $author = !empty($author) ? $author : "hide-author";
    $dut = !empty($dut) ? $dut : "hide-dut";
    $right_arrow = !empty($right_arrow) ? $right_arrow : "hide-right-arrow";

    $query_args = [
        "post_type" => "post",
        "post_status" => ["publish"],
        "posts_per_page" => $limit,
        "ignore_sticky_posts" => true,
        "nopaging" => false,
        "paged" => $paged
    ];

    if (!empty($category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "category",
                "field" => "term_id",
                "terms" => [$category_id]
            ]
        ];
    }
    if (!empty($exclude_post_id)) {
        $query_args["postesc_html__not_in"] = explode(",", $exclude_post_id);
    }

    switch ($columns) {
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

    switch ($design) {
        case "basic-design":
            $design = "Basic Design";
            break;
        case "grid-design":
            $design = "Grid Design";
            break;
        case "simple-grid-design":
            $design = "Simple Grid Design";
            break;
        default:
            $design = "Basic Design";
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

    switch ($categories) {
        case "show-categories":
            $categories = true;
            break;
        case "hide-categories":
            $categories = false;
            break;
        default:
            $categories = true;
            break;
    }

    switch ($tags) {
        case "show-tags":
            $tags = true;
            break;
        case "hide-tags":
            $tags = false;
            break;
        default:
            $tags = true;
            break;
    }

    switch ($read) {
        case "show-read":
            $read = true;
            break;
        case "hide-read":
            $read = false;
            break;
        default:
            $read = true;
            break;
    }
    switch ($read_link) {
        case "show_read_link":
            $read_link = true;
            break;
        case "hide_read_link":
            $read_link = false;
            break;
        default:
            $read = true;
            break;
    }
    switch ($dop) {
        case "show-dop":
            $dop = true;
            break;
        case "hide-dop":
            $dop = false;
            break;
        default:
            $dop = true;
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
    switch ($author) {
        case "show-author":
            $author = true;
            break;
        case "hide-author":
            $author = false;
            break;
        default:
            $author = true;
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
    switch ($right_arrow) {
        case "show-right-arrow":
            $right_arrow = true;
            break;
        case "hide-right-arrow":
            $right_arrow = false;
            break;
        default:
            $right_arrow = true;
            break;
    }

    $recent_posts_query = new WP_Query($query_args);
    $output = "";
    if ($recent_posts_query->have_posts()) {
        $count = 0;
        while ($recent_posts_query->have_posts()):
            $recent_posts_query->the_post();

            //Basic DESIGN
            if ($design == "Basic Design") {
                if ($count == 0) {
                    $output .= '<div class="basic-design outer">';
                }
                $output .= '<div class="basic-design flex">';
                // Left Side
                if (get_the_post_thumbnail($post->ID) != null) {
                    $output .= '<div class="basic-design left">';
                    if (has_post_format("link")) {
                        global $post;
                        global $nectar_options;
                        $link = get_post_meta($post->ID, "_nectar_link", true);
                        $output .=
                            '<a href="' .
                            $link .
                            '">' .
                            get_the_post_thumbnail(
                                $post->ID,
                                "full",
                                $image_attrs
                            ) .
                            "</a>";
                    } else {
                        $output .=
                            '<a href="' .
                            get_permalink() .
                            '">' .
                            get_the_post_thumbnail(
                                $post->ID,
                                "full",
                                $image_attrs
                            ) .
                            "</a>";
                    }
                    $output .= "</div>";
                }
                // Right Side
                if ($featured_image != false) {
                    $output .= '<div class="basic-design right">';
                } else {
                    $output .= '<div class="basic-design full-width">';
                }

                if (has_post_format("link")) {
                    global $post;
                    global $nectar_options;
                    $link = get_post_meta($post->ID, "_nectar_link", true);
                    $output .=
                        '<h3 class="basic-design title"><a class="external-site" href="' .
                        $link .
                        '" style="color:' .
                        $accent_color .
                        '">' .
                        get_the_title() .
                        "</a></h3>";
                } else {
                    $output .=
                        '<h3 class="basic-design title"><a href="' .
                        get_permalink() .
                        '" style="color:' .
                        $accent_color .
                        '">' .
                        get_the_title() .
                        "</a></h3>";
                }

                $output .= '<p class="basic-design date">';

                if ($dop != false) {
                    $output .= "<span>" . get_the_date("M j, Y") . "</span>";
                }

                if ($categories != false && $tags != true) {
                    $output .= " In " . get_the_category_list(", ");
                }

                if ($tags != false && $categories != true) {
                    $output .= get_the_tag_list(" In ", ", ");
                }

                if ($tags != false && $categories != false) {
                    $output .=
                        " In " .
                        get_the_category_list(", ") .
                        get_the_tag_list(", ", ", ");
                }

                $output .= "</p>";

                $excerpt_length = !empty($nectar_options[""])
                    ? intval($nectar_options[""])
                    : 50;
                $excerpt_markup =
                    '<p class="basic-design excerpt">' .
                    nectar_excerpt($excerpt_length) .
                    "</p>";
                $output .= $excerpt_markup;
                if ($read != false) {
                    $output .=
                        '<a class="basic-design read" href=' .
                        get_permalink() .
                        "><span>Read More</span></a>";
                }
                $output .= "</div>";
                $output .= "</div>";
                $count++;
                if (
                    $count == $columns ||
                    $recent_posts_query->current_post + 1 ==
                        $recent_posts_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            }

            // GRID DESIGN
            if ($design == "Grid Design") {
                if ($count == 0) {
                    $output .= '<div class="grid-design outer">';
                }
                $output .=
                    '<div class="' . $column_class . ' grid-design square">';
                if ($featured_image == true) {
                    $output .= get_the_post_thumbnail($page->ID, "medium");
                }
                $output .=
                    '<div class="grid-design header"><h3 class="grid-design title"><a href="' .
                    get_permalink() .
                    '">' .
                    get_the_title() .
                    "</a></h3>";
                if ($dop == true) {
                    $output .= '<span class="grid-design divider"> | </span>';
                    $output .=
                        '<span class="grid-design date">' .
                        get_the_date("M j, Y") .
                        "</span></div>";
                } else {
                    $output .= "</div>";
                }
                $nectar_options = get_nectar_theme_options();
                $excerpt_length = !empty($nectar_options["blog_excerpt_length"])
                    ? intval($nectar_options["blog_excerpt_length"])
                    : 30;

                if ($read_link == true) {
                    $excerpt_markup =
                        '<div class="grid-design excerpt"><span>' .
                        nectar_excerpt($excerpt_length) .
                        '</span><a href="' .
                        get_permalink() .
                        '"> Read more.</a></div>';
                } else {
                    $excerpt_markup =
                        '<div class="grid-design excerpt"><span>' .
                        nectar_excerpt($excerpt_length) .
                        "</span></div>";
                }

                if ($excerpt != false) {
                    $output .= $excerpt_markup;
                }

                if ($read == true) {
                    $output .=
                        '<div class="grid-design read"><a href="' .
                        get_permalink() .
                        '" target="_blank" style="background-color:' .
                        $accent_color .
                        '">Read</a></div>';
                }

                $output .= "</div>";
                $count++;
                if (
                    $count == $columns ||
                    $recent_posts_query->current_post + 1 ==
                        $recent_posts_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            }

            // SIMPLE GRID DESIGN
            if ($design == "Simple Grid Design") {
                if ($count == 0) {
                    $output .= '<div class="simple-grid-design outer">';
                }
                $output .= '<div class="' . $column_class . '">';
                if ($categories == true) {
                    $i = 0;
                    foreach (get_the_category() as $cat) {
                        $output .=
                            '<a href="' .
                            get_category_link($cat->cat_ID) .
                            '">' .
                            $cat->cat_name .
                            '</a>' .
                            " ";
                        if (++$i == 2) {
                            break;
                        }
                    }
                }

                if ($dut == false) {
                    if ($author == false) {
                        $output .=
                            '<p class="simple-grid-design date">' .
                            get_the_date("M j, Y") .
                            "</p>";
                    } else {
                        $output .=
                            '<p class="simple-grid-design date">' .
                            get_the_author_meta('display_name', $author_id) .
                            ' | ' .
                            get_the_date("M j, Y") .
                            "</p>";
                    }
                }

                $output .=
                    '<a class="simple-grid-design title" href="' .
                    get_permalink() .
                    '" target="_blank">' .
                    get_the_title() .
                    "</a>";
                if ($dut == true) {
                    if ($author == false) {
                        $output .=
                            '<p class="simple-grid-design date">' .
                            get_the_date("M j, Y") .
                            "</p>";
                    } else {
                        $output .=
                            '<p class="simple-grid-design date">' .
                            get_the_author_meta('display_name', $author_id) .
                            ' | ' .
                            get_the_date("M j, Y") .
                            "</p>";
                    }
                }

                if ($right_arrow == true) {
                    $output .=
                        '<img src="\wp-content\themes\salient-child\vc-addons\images\right-arrow.svg" />';
                }

                $output .= "</div>";
                $count++;
                if (
                    $count == $columns ||
                    $recent_posts_query->current_post + 1 ==
                        $recent_posts_query->post_count
                ) {
                    $output .= "</div>";
                    $count = 0;
                }
            }
        endwhile;

        // PAGINATION
        if ($pagination != false) {
            $big = 999999999;
            $output .= '<div class="design-pagination" style="color:#ffffff">';
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
                "total" => $recent_posts_query->max_num_pages,
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
        $output .= esc_html__("No recent posts listed", "recent_posts");
    }
    return $output;
}

add_shortcode("recent_posts_basic", "recent_posts_linux");
