<?php
class RecentPosts
{
    function __construct()
    {
        add_action('init', array(
            $this,
            'recent_posts_vc_basic'
        ) , 99999);
    }

    function recent_posts_vc_basic()
    {
        $types = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
            'orderby' => 'name',
            'suppress_filters' => true
        ));

        $pt = array(
            'All' => ''
        );
        foreach ($types as $type)
        {
            $pt[$type
                ->name] = $type->term_id;
        }
        if (function_exists('vc_map')):
            vc_map(array(
                'name' => __('Recent Posts Basic', 'recent_posts') ,
                'base' => 'recent_posts_basic',
                'icon' => 'vc_element-icon icon-wpb-recent-posts',
                'class' => '',
                'category' => __('Content', 'recent_posts') ,
                'description' => __('Display list of recent_posts custom post type', 'recent_posts') ,
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => __('Columns', 'recent_posts') ,
                        'param_name' => 'columns',
                        'value' => array(
                            __('2 Columns', 'recent_posts') => '2',
                            __('3 Columns', 'recent_posts') => '3',
                            __('4 Columns', 'recent_posts') => '4',
                        ) ,
                        'description' => __('Select number of columns.', 'recent_posts') ,
                        'save_always' => true,
                    ) ,
                    array(
                        'type' => 'dropdown_multi',
                        'class' => '',
                        'heading' => __('Recent Posts Categories', 'recent_posts') ,
                        'param_name' => 'category_id',
                        'value' => $pt,
                        'description' => __('', 'recent_posts') ,
                        'save_always' => true,
                    ) ,
                )
            ));
        endif;
    }
}

$recent_posts = new RecentPosts();
function recent_posts_grid($atts, $content)
{
    extract(shortcode_atts(array(
        'limit' => '-1',
        'columns' => '',
        'order' => 'DESC',
        'orderby' => 'date',
        'category_id' => '',
        'image_width' => '200',
        'suppress_filters' => true,
        'exclude_post_id' => '',
        'featured_image' => 'yes'
    ) , $atts));

    $limit = !empty($limit) ? $limit : '8';
    $order = (strtolower($order) == 'asc') ? 'ASC' : 'DESC';
    $orderby = !empty($orderby) ? $orderby : 'title';
    $columns = !empty($columns) ? $columns : '4';

    $query_args = array(
        'post_type' => 'post',
        'post_status' => array(
            'publish'
        ) ,
        'posts_per_page' => 4,
        'order' => $order,
        'orderby' => $orderby,
        'ignore_sticky_posts' => true,
    );

    if (!empty($category_id))
    {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => array(
                    $category_id
                ) ,
            )
        );
    }
    if (!empty($exclude_post_id))
    {
        $query_args['post__not_in'] = explode(',', $exclude_post_id);
    }

    switch ($columns)
    {
        case '2':
            $column_class = 'col span_6';
        break;
        case '3':
            $column_class = 'col span_4';
        break;
        case '4':
            $column_class = 'col span_3';
        break;
        default:
            $column_class = 'col span_6';
        break;
    }

    $recent_posts_query = new WP_Query($query_args);
    $output = '';
    if ($recent_posts_query->have_posts())
    {
        $count = 0;
        while ($recent_posts_query->have_posts()):
            $recent_posts_query->the_post();
            if ($count == 0)
            {
                $output .= '<div class="recent_posts_basic_outer">';
            }
            $output .= '<div class="' . $column_class . ' recent_posts_basic">';
            $output .= '<div class="recent_posts_basic_top_title"><h3 class="recent_posts_basic_title">' . get_the_title() . '</h3>';
            $output .= '<span class="recent_posts_basic_divider"> | </span>';
            $output .= '<span class="recent_posts_basic_date">' . get_the_date('M j, Y') . '</span></div>';
            $nectar_options = get_nectar_theme_options();
            $excerpt_length = (!empty($nectar_options['blog_excerpt_length'])) ? intval($nectar_options['blog_excerpt_length']) : 15;
            $excerpt_markup = '<div class="recent_posts_basic_excerpt"><span>' . nectar_excerpt($excerpt_length) . '</span></div>';
            $output .= $excerpt_markup;
            $output .= '<div class="recent_posts_basic_read_more"><a href="' . get_permalink() . '">Read</a></div>';
            $output .= '</div>';
            $count++;
            if ($count == $columns || ($recent_posts_query->current_post + 1) == $recent_posts_query->post_count)
            {
                $output .= '</div>';
                $count = 0;
            }

        endwhile;
        wp_reset_postdata();
    }
    else
    {
        $output .= __("No recent posts listed", "recent_posts");
    }
    return $output;
}

add_shortcode('recent_posts_basic', 'recent_posts_grid');

