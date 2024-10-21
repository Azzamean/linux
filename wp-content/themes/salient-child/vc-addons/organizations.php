<?php
class organizations
{
    function __construct()
    {
        add_action('vc_before_init', array($this, 'organizations_grid_vc'));
    }

    function organizations_grid_vc()
    {
        $types = get_terms(
            array(
            'taxonomy' => 'organizations_category',
            'hide_empty' => false,
            'orderby' => 'name'
            )
        );

        $pt = array('All' => '');
        foreach ($types as $type) {
            $pt[$type->name] = $type->term_id;
        }
        vc_map(
            array(
            'name' => __('Organizations - Linux Foundation Designed', 'organizations'),
            'base' => 'organizations',
            "icon" => "vc_element-icon icon-wpb-recent-posts",
            'class' => '',
            "category" => esc_html__("Linux Foundation", "organizations"),
            'description' => __(
                'Display list of Organizations custom post type',
                'organizations'
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __('Limit', 'organizations'),
                    'param_name' => 'limit',
                    'value' => '-1',
                    'description' => __(
                        'Enter number of organizations to be displayed. Enter -1 to display all.',
                        'organizations'
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Order By', 'organizations'),
                    'param_name' => 'orderby',
                    'value' => array(
                        __('Name', 'organizations') => 'title',
                        __('Date', 'organizations') => 'date',
                        __('ID', 'organizations') => 'ID',
                        __('Random', 'organizations') => 'rand'
                    ),
                    'description' => __('Select order type.', 'organizations')
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Sort order', 'organizations'),
                    'param_name' => 'order',
                    'value' => array(
                        __('Descending', 'organizations') => 'DESC',
                        __('Ascending', 'organizations') => 'ASC'
                    ),
                    'description' => __('Select sorting order.', 'organizations')
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Organizations Category', 'organizations'),
                    'param_name' => 'organizations_category',
                    'value' => $pt,
                    'description' => __('', 'organizations')
                ),
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Columns", "organizations"),
                    "param_name" => "columns",
                    "value" => [
                        esc_html__("4 columns", "organizations") => "4",
                    ],
                    "description" => esc_html__(
                        "Please select the number of columns you want displayed",
                        "organizations"
                    ),
                    "save_always" => true,
                ],
            )
            )
        );
    }
}

$organizations = new Organizations();

function organizations_grid($atts, $content)
{
    extract(
        shortcode_atts(
            array(
                'limit' => '-1',
                'order' => 'ASC',
                'orderby' => 'title',
                'organizations_category' => '',
                'columns' => '4 columns'
            ),
            $atts
        )
    );

    $limit = !empty($limit) ? $limit : "15";
    $order = !empty($order) ? $order : "ASC";
    $orderby = !empty($orderby) ? $orderby : "title";
    $columns = !empty($columns) ? $columns : "4";

    switch ($columns) {
    case '4':
        $column_class = 'vc_col-sm-3';
        break;
    default:
        $column_class = 'vc_col-sm-3';
        break;
    }

    $query_args = array(
        'post_type' => 'organizations',
        'post_status' => array('publish'),
        'posts_per_page' => $limit,
        'order' => $order,
        'orderby' => $orderby,
        'ignore_sticky_posts' => true
    );

    if (!empty($organizations_category)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'organizations_category',
                'field' => 'term_id',
                'terms' => $organizations_category
            )
        );
    }

    $output = '';
    $organizations_query = new WP_Query($query_args);
    $count = 0;

    if ($organizations_query->have_posts()) {
        $count = 0;
        while ($organizations_query->have_posts()):
                $organizations_query->the_post();
            if ($count == 0) {
                $output .= '<div class="grid-design outer organizations">';
            }
                global $post;
                $post_id = $post->ID;
                $output .= '<div class="vc_col-sm-4 grid-design organizations">';
                $output .= '<a class="grid-design link-wrap organizations" href="#" data-featherlight="#' . $post_id . '">';         
                $output .= '<img src="' . get_field('organizations_logo') . '"/>';  
                $output .= '</a>'; // link-wrap 
                $output .= '<div class="grid-design body-wrapper organizations">';
                $output .= '<a href="#" data-featherlight="#' . $post_id . '"><h3 class="name organizations">' . get_the_title() . '</h3></a>';
                $output .= '<div class="social organizations">';
                $output .= '<a href="' . get_field('organizations_url') . '"><i class="fa fa-link" aria-hidden="true"></i></a>';
                $output .= '</div>';



                $output .= '<div id="' . $post_id . '" class="lightbox">';
                $output .= '<div class="modal organizations">';
                $output .= '<div class="modal logo-wrap">';
                $output .= '<img src="' . get_field('organizations_logo') . '"/>';  
                $output .= '</div>';
                $output .= '<div class="content organizations">';
                $output .= '<h3 class="title organizations">' . get_the_title() . '</h3>';            
                $output .= '<div class="biography organizations">' .  get_field('organizations_biography') . '</div>';
                $output .= '<div class="social organizations">';
                $output .= '<a href="' . get_field('organizations_url') . '"><i class="fa fa-link" aria-hidden="true"></i></a>';
                $output .= '</div>';
                $output .= '</div>'; // content organizations
                $output .= '</div>'; // modal organizations
                $output .= '</div>'; // modal lightbox



                $output .= "</div>"; // body-wrapper
                $output .= "</div>"; // organizations
                $count++;
            if ($count == $columns 
                || $organizations_query->current_post + 1 == $organizations_query->post_count
            ) {
                $output .= "</div>";
                $count = 0;
            }
            
        endwhile; /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        $output .= "No Organizations listed";
    }
    return $output;

}

add_shortcode('organizations', 'organizations_grid');
