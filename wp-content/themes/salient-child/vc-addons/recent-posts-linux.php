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

        $single_category = ["All" => ""];
        foreach ($types as $type) {
            $single_category[$type->name] = $type->term_id;
        }
        if (function_exists("vc_map")):
            vc_map([
                "name" => esc_html__(
                    "Recent Posts - Linux Foundation Designed",
                    "recent_posts"
                ),
                "base" => "recent_posts_linux_foundation",
                "icon" => "vc_element-icon icon-wpb-recent-posts",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "recent_posts"),
                "description" => esc_html__(
                    "Display list of different recent custom post types.",
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
                                "List Design",
                                "salient-core"
                            ) => "list-design",
                            esc_html__(
                                "Grid Design",
                                "salient-core"
                            ) => "grid-design"
                        ],
                        "save_always" => true,
                        "description" => esc_html__(
                            "Select the design you desire for your posts.",
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
                            "Select the number of columns to be displayed.",
                            "salient-core"
                        ),
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
                        "type" => "dropdown_multi",
                        "class" => "",
                        "heading" => esc_html__("Categories", "recent_posts"),
                        "param_name" => "category_id",
                        "value" => $single_category,
                        "description" => esc_html__(
                            "Select the categories to display.",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown",
                        "heading" => esc_html__(
                            "Number of Categories",
                            "salient-core"
                        ),
                        "param_name" => "categories",
                        "admin_label" => true,
                        "value" => [
                            esc_html__("0", "salient-core") => "No Categories",
                            esc_html__("1", "salient-core") => "1",
                            esc_html__("2", "salient-core") => "2",
                            esc_html__("3", "salient-core") => "3"
                        ],
                        "save_always" => true,
                        "description" => esc_html__(
                            "Select the number of categories to display.",
                            "salient-core"
                        )
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
                            "value" => ["list-design"]
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
                            "value" => ["list-design", "grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide the featured image.",
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
                                "Show Excerpt",
                                "recent_posts"
                            ) => "show-excerpt"
                        ],
                        "std" => "hide-excerpt",
                        "dependency" => [
                            "element" => "design",
                            "value" => ["grid-design"]
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want to show or hide the excerpt.",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Append Excerpt Link",
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
                            "element" => "excerpt",
                            "value" => ["show-excerpt"]
                        ],

                        "description" => esc_html__(
                            "Check or uncheck the box if you want to append a link at the end of the excerpt.",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown",
                        "heading" => esc_html__("Navigation", "salient-core"),
                        "param_name" => "navigation",
                        "admin_label" => true,
                        "value" => [
                            esc_html__(
                                "None",
                                "salient-core"
                            ) => "hide_navigation",
                            esc_html__(
                                "Button",
                                "salient-core"
                            ) => "show_navigation_btn",
                            esc_html__(
                                "Arrow",
                                "salient-core"
                            ) => "show_navigation_arrow"
                        ],
                        "std" => "hide_navigation",
                        "save_always" => true,
                        "description" => esc_html__(
                            "Select the choices on displaying the publication date and author.",
                            "salient-core"
                        )
                    ],
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__(
                            "Navigation Text",
                            "recent_posts"
                        ),
                        "param_name" => "navigation_text",
                        "value" => [
                            esc_html__(
                                "Enter text for the Navigation Link",
                                "recent_posts"
                            ) => "show_navigation_text"
                        ],
                        "std" => "",
                        "dependency" => [
                            "element" => "navigation",
                            "value" => ["show_navigation_btn"]
                        ],
                        "description" => esc_html__(
                            "Enter the text for the navigation button.",
                            "recent_posts"
                        ),
                        "save_always" => true
                    ],
                    [
                        "type" => "dropdown",
                        "heading" => esc_html__(
                            "Publication Date and Author Selection",
                            "salient-core"
                        ),
                        "param_name" => "date_author",
                        "admin_label" => true,
                        "value" => [
                            esc_html__(
                                "No date of publication or author",
                                "salient-core"
                            ) => "no-date-author",
                            esc_html__("Date", "salient-core") => "date",
                            esc_html__("Author", "salient-core") => "author",
                            esc_html__(
                                "Date and Author",
                                "salient-core"
                            ) => "date-and-author"
                        ],
                        "save_always" => true,
                        "description" => esc_html__(
                            "Select the choices on displaying the publication date and author.",
                            "salient-core"
                        )
                    ],
                    [
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => esc_html__(
                            "Publication Date and Author Under Heading Title",
                            "recent_posts"
                        ),
                        "param_name" => "dut",
                        "value" => [
                            esc_html__(
                                "Put the data and author under the title",
                                "recent_posts"
                            ) => "show-dut"
                        ],
                        "std" => "hide-dut",
                        "dependency" => [
                            "element" => "date_author",
                            "value" => "date-and-author"
                        ],
                        "description" => esc_html__(
                            "Check or uncheck the box if you want the publication date and author under the heading title.",
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
                            "Check or uncheck the box if you want to show or hide pagination.",
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
                "design" => "",
                "columns" => "",
                "limit" => "",
                "category_id" => "",
                "categories" => "",
                "tags" => "",
                "featured_image" => "",
                "excerpt" => "",
                "read_link" => "",
                "navigation" => "",
                "navigation_text" => "",
                "date_author" => "",
                "dut" => "",
                "pagination" => "",
                "suppress_filters" => true
            ],
            $atts
        )
    );

    $design = !empty($design) ? $design : "list-design";
    $columns = !empty($columns) ? $columns : "4";
    $limit = !empty($limit) ? $limit : "4";
    if (!empty($category_id)) {
        $query_args["tax_query"] = [
            [
                "taxonomy" => "category",
                "field" => "term_id",
                "terms" => [$category_id]
            ]
        ];
    }
    $categories = !empty($categories) ? $categories : "0";
    $tags = !empty($tags) ? $tags : "hide-tags";
    $featured_image = !empty($featured_image)
        ? $featured_image
        : "show-featured-image";
    $excerpt = !empty($excerpt) ? $excerpt : "hide-excerpt";
    $read_link = !empty($read_link) ? $read_link : "hide_read_link";
    $navigation = !empty($navigation) ? $navigation : "hide_navigation";
    $navigation_text = !empty($navigation_text) ? $navigation_text : "";
    $date_author = !empty($date_author) ? $date_author : "no-date-author";
    $dut = !empty($dut) ? $dut : "hide-dut";
    $pagination = !empty($pagination) ? $pagination : "show-pagination";
    $paged = get_query_var("paged") ? get_query_var("paged") : 1;

    $query_args = [
        "post_type" => "post",
        "post_status" => ["publish"],
        "posts_per_page" => $limit,
        "ignore_sticky_posts" => true,
        "nopaging" => false,
        "paged" => $paged
    ];

    switch ($design) {
        case "list-design":
            $design = "List Design";
            break;
        case "grid-design":
            $design = "Grid Design";
            break;
        default:
            $design = "List Design";
            break;
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
    switch ($categories) {
        case "0":
            $categories = "0";
            break;
        case "1":
            $categories = "1";
            break;
        case "2":
            $categories = "2";
            break;
        case "3":
            $categories = "3";
            break;
        default:
            $categories = "0";
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
    switch ($navigation) {
        case "hide_navigation":
            $navigation = "hide_navigation";
            break;
        case "show_navigation_btn":
            break;
        case "show_navigation_arrow":
            $navigation = "show_navigation_arrow";
            break;
        default:
            $navigation = "hide_navigation";
            break;
    }
    switch ($navigation_text) {
        case $navigation_text != "":
            $navigation_text_exists = true;
            break;
        case ($navigation_text = ""):
            $navigation_text_exists = false;
            break;
        default:
            $navigation_text_exists = false;
            break;
    }
    switch ($date_author) {
        case "no-date-author":
            $date_author = "no-date-author";
            break;
        case "date":
            $date_author = "date";
            break;
        case "author":
            $date_author = "author";
            break;
        case "date-and-author":
            $date_author = "date-and-author";
            break;
        default:
            $date_author = "no-date-author";
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

    $recent_posts_query = new WP_Query($query_args);
    $output = "";
    if ($recent_posts_query->have_posts()) {
        $count = 0;
        while ($recent_posts_query->have_posts()):
            $recent_posts_query->the_post();

            //List Design
            if ($design == "List Design") {
                if ($count == 0) {
                    $output .= '<div class="list-design outer">';
                }

                $output .= '<div class="list-design flex">';
                // Left Side

                if ($featured_image == true) {
                    $output .= '<div class="list-design left">';
                    if (get_the_post_thumbnail($post->ID) != null) {
                        if (has_post_format("link")) {
                            global $post;
                            global $nectar_options;
                            $link = get_post_meta(
                                $post->ID,
                                "_nectar_link",
                                true
                            );
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
                    } else {
                        $output .=
                            '<img class="list-view-default" src="' .
                            nectar_options_img($nectar_options['logo']) .
                            '" />';
                    }
                    $output .= "</div>";
                }

                // Right Side
                if ($featured_image != false) {
                    $output .= '<div class="list-design right">';
                } else {
                    $output .= '<div class="list-design full-width">';
                }

                if ($dut == false) {
                    // DATE, AUTHOR, CATEGORIES, AND TAGS SECTION
                    if ($date_author == "date") {
                        $output .= '<p class="list-design date">';
                        $output .=
                            "<span>" . get_the_date("M j, Y") . "</span>";
                    }
                    if ($date_author == "author") {
                        $output .= '<p class="list-design author">';
                        $output .=
                            "<span>" .
                            get_the_author_meta("display_name", $author_id) .
                            "</span>";
                    }
                    if ($date_author == "date-and-author") {
                        $output .= '<p class="list-design date">';
                        $output .=
                            "<span>" . get_the_date("M j, Y") . "</span>";
                        $output .= " | ";
                        $output .=
                            "<span>" .
                            get_the_author_meta("display_name", $author_id) .
                            "</span>";
                    }
                    // CATEGORIES AND TAGS NEXT TO DATE
                    if ($categories > 0 && $tags == false) {
                        $i = 0;
                        $comma = "";
                        $output .= " In ";
                        foreach (get_the_category() as $cat) {
                            $output .=
                                $comma .
                                '<a href="' .
                                get_category_link($cat->cat_ID) .
                                '">' .
                                $cat->cat_name .
                                "</a>";
                            $comma = ", ";
                            if (++$i == $categories) {
                                break;
                            }
                        }
                    }
                    if ($categories > 0 && $tags == true) {
                        $i = 0;
                        $comma = "";
                        $output .= " In ";
                        foreach (get_the_category() as $cat) {
                            $output .=
                                $comma .
                                '<a href="' .
                                get_category_link($cat->cat_ID) .
                                '">' .
                                $cat->cat_name .
                                "</a>";
                            $comma = ", ";
                            if (++$i == $categories) {
                                break;
                            }
                        }
                        $output .= get_the_tag_list(", ", ", ");
                    }
                    if ($categories == 0 && $tags == true) {
                        $output .= get_the_tag_list(" In ", ", ");
                    }
                    // END OF CATEGORIES AND TAGS NEXT TO DATE
                    $output .= "</p>";
                    // END OF DATE, AUTHOR, CATEGORIES, AND TAGS SECTION
                }
                if (has_post_format("link")) {
                    global $post;
                    global $nectar_options;
                    $link = get_post_meta($post->ID, "_nectar_link", true);
                    $output .=
                        '<h3 class="list-design title"><a class="external-site" href="' .
                        $link .
                        '" style="color:' .
                        $accent_color .
                        '">' .
                        get_the_title() .
                        "</a></h3>";
                } else {
                    $output .=
                        '<h3 class="list-design title"><a href="' .
                        get_permalink() .
                        '" style="color:' .
                        $accent_color .
                        '">' .
                        get_the_title() .
                        "</a></h3>";
                }
                if ($dut == true) {
                    // DATE, AUTHOR, CATEGORIES, AND TAGS SECTION
                    if ($date_author == "date") {
                        $output .= '<p class="list-design date">';
                        $output .=
                            "<span>" . get_the_date("M j, Y") . "</span>";
                    }
                    if ($date_author == "author") {
                        $output .= '<p class="list-design author">';
                        $output .=
                            "<span>" .
                            get_the_author_meta("display_name", $author_id) .
                            "</span>";
                    }
                    if ($date_author == "date-and-author") {
                        $output .= '<p class="list-design date">';
                        $output .=
                            "<span>" . get_the_date("M j, Y") . "</span>";
                        $output .= " | ";
                        $output .=
                            "<span>" .
                            get_the_author_meta("display_name", $author_id) .
                            "</span>";
                    }
                    // CATEGORIES AND TAGS NEXT TO DATE
                    if ($categories > 0 && $tags == false) {
                        $i = 0;
                        $comma = "";
                        $output .= " In ";
                        foreach (get_the_category() as $cat) {
                            $output .=
                                $comma .
                                '<a href="' .
                                get_category_link($cat->cat_ID) .
                                '">' .
                                $cat->cat_name .
                                "</a>";
                            $comma = ", ";
                            if (++$i == $categories) {
                                break;
                            }
                        }
                    }
                    if ($categories > 0 && $tags == true) {
                        $i = 0;
                        $comma = "";
                        $output .= " In ";
                        foreach (get_the_category() as $cat) {
                            $output .=
                                $comma .
                                '<a href="' .
                                get_category_link($cat->cat_ID) .
                                '">' .
                                $cat->cat_name .
                                "</a>";
                            $comma = ", ";
                            if (++$i == $categories) {
                                break;
                            }
                        }
                        $output .= get_the_tag_list(", ", ", ");
                    }
                    if ($categories == 0 && $tags == true) {
                        $output .= get_the_tag_list(" In ", ", ");
                    }
                    // END OF CATEGORIES AND TAGS NEXT TO DATE
                    $output .= "</p>";
                    // END OF DATE, AUTHOR, CATEGORIES, AND TAGS SECTION
                }

                $excerpt_length = !empty($nectar_options[""])
                    ? intval($nectar_options[""])
                    : 50;
                $excerpt_markup =
                    '<p class="list-design excerpt">' .
                    nectar_excerpt($excerpt_length) .
                    "</p>";
                $output .= $excerpt_markup;

                if (
                    $navigation == "show_navigation_btn" &&
                    $navigation_text_exists == true
                ) {
                    $output .=
                        '<div><a class="list-design navigation-btn" href=' .
                        get_permalink() .
                        '><span>' .
                        $navigation_text .
                        '</span></a></div>';
                }
                if ($navigation == "show_navigation_arrow") {
                    $output .=
                        '<a href="' .
                        get_permalink() .
                        '">' .
                        '<svg class="grid-svg" fill="' .
                        $accent_color .
                        '" width="80" height="32" viewBox="0 0 80 32" xmlns="http://www.w3.org/2000/svg"><path d="M80 16.0539C79.9374 16.0477 79.9071 16.0931 79.8673 16.1202C74.3618 19.8817 68.8569 23.6437 63.3521 27.4059C61.1548 28.9076 58.9579 30.4098 56.7607 31.9116C56.7194 31.9398 56.6763 31.9662 56.6241 32C56.5842 31.9373 56.6013 31.8756 56.6013 31.8181C56.6003 27.8022 56.5994 23.7863 56.6043 19.7704C56.6045 19.6195 56.571 19.5749 56.3867 19.5749C34.0985 19.5792 22.4298 19.579 0.141546 19.579C0.0943641 19.579 0.0471819 19.5798 0 19.5802V12.4348C0.0765478 12.4367 0.153096 12.4404 0.229644 12.4404C22.4706 12.4406 34.0921 12.4406 56.333 12.4406C56.5113 12.4406 56.6004 12.3611 56.6004 12.2021L56.6018 0H56.6372C56.6508 0.0577025 56.7123 0.0753928 56.7567 0.105724C59.9286 2.27479 63.1009 4.44331 66.2735 6.61156C70.8489 9.73851 75.4245 12.8652 80 15.992V16.0539L80 16.0539Z"/></svg>' .
                        '</a>';
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
                $output .= '<div class="' . $column_class . '">';
                if ($featured_image == true) {
                    $output .= get_the_post_thumbnail($page->ID, "medium");
                }
                if ($categories == true) {
                    $i = 0;
                    foreach (get_the_category() as $cat) {
                        $output .=
                            '<a href="' .
                            get_category_link($cat->cat_ID) .
                            '" class="simple-grid-categories">' .
                            $cat->cat_name .
                            "</a>" .
                            " ";
                        if (++$i == $categories) {
                            break;
                        }
                    }
                }

                if ($dut == false) {
                    if ($date_author == "date") {
                        $output .=
                            '<p class="grid-design date">' .
                            get_the_date("M j, Y") .
                            "</p>";
                    }
                    if ($date_author == "author") {
                        $output .=
                            '<p class="grid-design date">' .
                            get_the_author_meta("display_name", $author_id) .
                            "</p>";
                    }
                    if ($date_author == "date-and-author") {
                        if (
                            !empty(
                                get_the_author_meta("display_name", $author_id)
                            )
                        ) {
                            $output .=
                                '<p class="grid-design date">' .
                                get_the_author_meta(
                                    "display_name",
                                    $author_id
                                ) .
                                " | " .
                                get_the_date("M j, Y") .
                                "</p>";
                        } else {
                            $output .=
                                '<p class="grid-design date">' .
                                get_the_date("M j, Y") .
                                "</p>";
                        }
                    }
                }

                $output .=
                    '<a class="grid-design title" href="' .
                    get_permalink() .
                    '" target="_blank">' .
                    get_the_title() .
                    "</a>";
                if ($dut == true) {
                    if ($date_author == "date") {
                        $output .=
                            '<p class="grid-design date">' .
                            get_the_date("M j, Y") .
                            "</p>";
                    }
                    if ($date_author == "author") {
                        $output .=
                            '<p class="grid-design date">' .
                            get_the_author_meta("display_name", $author_id) .
                            "</p>";
                    }
                    if ($date_author == "date-and-author") {
                        if (
                            !empty(
                                get_the_author_meta("display_name", $author_id)
                            )
                        ) {
                            $output .=
                                '<p class="grid-design date">' .
                                get_the_author_meta(
                                    "display_name",
                                    $author_id
                                ) .
                                " | " .
                                get_the_date("M j, Y") .
                                "</p>";
                        } else {
                            $output .=
                                '<p class="grid-design date">' .
                                get_the_date("M j, Y") .
                                "</p>";
                        }
                    }
                }

                if ($excerpt == true && $read_link == false) {
                    $excerpt_length = !empty($nectar_options[""])
                        ? intval($nectar_options[""])
                        : 50;
                    $excerpt_markup =
                        '<p class="list-design excerpt">' .
                        nectar_excerpt($excerpt_length) .
                        "</p>";
                    $output .= $excerpt_markup;
                }

                if ($excerpt == true && $read_link == true) {
                    $excerpt_length = !empty($nectar_options[""])
                        ? intval($nectar_options[""])
                        : 50;
                    $excerpt_markup =
                        '<div class="grid-design excerpt"><span>' .
                        nectar_excerpt($excerpt_length) .
                        '</span><a href="' .
                        get_permalink() .
                        '"> Read more.</a></div>';
                    $output .= $excerpt_markup;
                }

                if (
                    $navigation == "show_navigation_btn" &&
                    $navigation_text_exists == true
                ) {
                    $output .=
                        '<div class="grid-design navigation-btn"><a href="' .
                        get_permalink() .
                        '" target="_blank" style="background-color:' .
                        $accent_color .
                        '">' .
                        $navigation_text .
                        '</a></div>';
                }
                if ($navigation == "show_navigation_arrow") {
                    $output .=
                        '<a href="' .
                        get_permalink() .
                        '">' .
                        '<svg class="grid-svg" fill="' .
                        $accent_color .
                        '" width="80" height="32" viewBox="0 0 80 32" xmlns="http://www.w3.org/2000/svg"><path d="M80 16.0539C79.9374 16.0477 79.9071 16.0931 79.8673 16.1202C74.3618 19.8817 68.8569 23.6437 63.3521 27.4059C61.1548 28.9076 58.9579 30.4098 56.7607 31.9116C56.7194 31.9398 56.6763 31.9662 56.6241 32C56.5842 31.9373 56.6013 31.8756 56.6013 31.8181C56.6003 27.8022 56.5994 23.7863 56.6043 19.7704C56.6045 19.6195 56.571 19.5749 56.3867 19.5749C34.0985 19.5792 22.4298 19.579 0.141546 19.579C0.0943641 19.579 0.0471819 19.5798 0 19.5802V12.4348C0.0765478 12.4367 0.153096 12.4404 0.229644 12.4404C22.4706 12.4406 34.0921 12.4406 56.333 12.4406C56.5113 12.4406 56.6004 12.3611 56.6004 12.2021L56.6018 0H56.6372C56.6508 0.0577025 56.7123 0.0753928 56.7567 0.105724C59.9286 2.27479 63.1009 4.44331 66.2735 6.61156C70.8489 9.73851 75.4245 12.8652 80 15.992V16.0539L80 16.0539Z"/></svg>' .
                        '</a>';
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

add_shortcode("recent_posts_linux_foundation", "recent_posts_linux");
