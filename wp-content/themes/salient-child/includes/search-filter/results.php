<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if (!defined("ABSPATH")) {
    exit();
}

if ($query->have_posts()) {

    $count = 0;
    while ($query->have_posts()) {
        $query->the_post();

        if ($count == 0) {
            $output .= '<div class="grid-design outer">';
        }

        $output .= '<div class="col span_6">';
        $output .= '<div class="search-filter-categories">';
        $i = 0;
        $comma = "";
        foreach (get_the_category() as $cat) {
            $output .=
                $comma .
                '<a href="' .
                get_category_link($cat->cat_ID) .
                '">' .
                $cat->cat_name .
                "</a>";
            $comma = " | ";
            if (++$i == $categories) {
                break;
            }
        }
        $output .= "</div>";

        if (has_post_format("link")) {
            global $post;
            global $nectar_options;
            $link = get_post_meta($post->ID, "_nectar_link", true);
        } else {
            $link = get_permalink();
        }

        $output .=
            '<a class="grid-design title" href="' .
            $link .
            '">' .
            get_the_title() .
            "</a>";
        $output .=
            '<a class="svg-link" href="' .
            $link .
            '">' .
            '<svg class="grid-svg" fill="#0033A1" width="80" height="32" viewBox="0 0 80 32" xmlns="http://www.w3.org/2000/svg"><path d="M80 16.0539C79.9374 16.0477 79.9071 16.0931 79.8673 16.1202C74.3618 19.8817 68.8569 23.6437 63.3521 27.4059C61.1548 28.9076 58.9579 30.4098 56.7607 31.9116C56.7194 31.9398 56.6763 31.9662 56.6241 32C56.5842 31.9373 56.6013 31.8756 56.6013 31.8181C56.6003 27.8022 56.5994 23.7863 56.6043 19.7704C56.6045 19.6195 56.571 19.5749 56.3867 19.5749C34.0985 19.5792 22.4298 19.579 0.141546 19.579C0.0943641 19.579 0.0471819 19.5798 0 19.5802V12.4348C0.0765478 12.4367 0.153096 12.4404 0.229644 12.4404C22.4706 12.4406 34.0921 12.4406 56.333 12.4406C56.5113 12.4406 56.6004 12.3611 56.6004 12.2021L56.6018 0H56.6372C56.6508 0.0577025 56.7123 0.0753928 56.7567 0.105724C59.9286 2.27479 63.1009 4.44331 66.2735 6.61156C70.8489 9.73851 75.4245 12.8652 80 15.992V16.0539L80 16.0539Z"/></svg>' .
            "</a>";

        $output .= "</div>";

        $count++;
        if ($count == 2) {
            $output .= "</div>";
            $count = 0;
        }
    }
    echo $output;
    ?>
	
		<!-- Page <?php
    //echo $query->query['paged'];
    ?> of <?php
    //echo $query->max_num_pages;
    ?><br />
	
	 <div class="pagination">
		
		<div class="nav-previous"><?php
    //next_posts_link( 'Next', $query->max_num_pages );
    ?></div>
		<div class="nav-next"><?php
    //previous_posts_link( 'Previous' );
    ?></div>
		<?php
    /* example code for using the wp_pagenavi plugin */
    //if (function_exists('wp_pagenavi'))
    //{
    //	echo "<br />";
    //	wp_pagenavi( array( 'query' => $query ) );
    //}
    ?>
	</div> -->
	
	<?php
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
 $big = 999999999;
 $pagination_output .=
     '<div class="recent-posts-pagination search-filter" style="color:#ffffff">';
 $pagination_output .=
     '<div class="links" style="color:' . $accent_color . '">';
 $pagination_output .= paginate_links([
     "base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))),
     "format" => "?paged=%#%",
     "current" => max(1, get_query_var("paged")),
     "total" => $query->max_num_pages,
     "before_page_number" =>
         '<span style="background-color:' . $accent_color . '">',
     "after_page_number" => "</span>",
     "next_text" =>
         '<span style="background-color:' . $accent_color . '">Next →</span>',
     "prev_text" =>
         '<span style="background-color:' . $accent_color . '">Prev ←</span>',
 ]);
 $pagination_output .= "</div>";
 $pagination_output .= "</div>";

 echo $pagination_output;

} else {
    echo "No Results Found";
}
?>
