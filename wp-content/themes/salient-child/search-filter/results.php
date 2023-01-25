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
        $output .=
            '<a class="grid-design title" href="' .
            get_permalink() .
            '" target="_blank">' .
            get_the_title() .
            "</a>";
        $output .=
            '<a class="svg-link" href="' .
            get_permalink() .
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
} else {
    echo "No Results Found";
}
?>
