<?php
class people
{
    function __construct()
    {
        add_action('vc_before_init', array($this, 'people_grid_vc'));
    }

    function people_grid_vc()
    {
        $types = get_terms(
            array(
            'taxonomy' => 'people_category',
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
            'name' => __('People - Linux Foundation Designed', 'people'),
            'base' => 'people',
            "icon" => "vc_element-icon icon-wpb-recent-posts",
            'class' => '',
            "category" => esc_html__("Linux Foundation", "people"),
            'description' => __(
                'Display list of People custom post type',
                'people'
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __('Limit', 'people'),
                    'param_name' => 'limit',
                    'value' => '-1',
                    'description' => __(
                        'Enter number of people to be displayed. Enter -1 to display all.',
                        'people'
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Order By', 'people'),
                    'param_name' => 'orderby',
                    'value' => array(
                        __('Name', 'people') => 'title',
                        __('Date', 'people') => 'date',
                        __('ID', 'people') => 'ID',
                        __('Random', 'people') => 'rand'
                    ),
                    'description' => __('Select order type.', 'people')
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Sort order', 'people'),
                    'param_name' => 'order',
                    'value' => array(
                        __('Descending', 'people') => 'DESC',
                        __('Ascending', 'people') => 'ASC'
                    ),
                    'description' => __('Select sorting order.', 'people')
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('People Category', 'people'),
                    'param_name' => 'people_category',
                    'value' => $pt,
                    'description' => __('', 'people')
                ),
                [
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Columns", "people"),
                    "param_name" => "columns",
                    "value" => [
                        esc_html__("4 columns", "people") => "4",
                    ],
                    "description" => esc_html__(
                        "Please select the number of columns you want displayed",
                        "people"
                    ),
                    "save_always" => true,
                ],
            )
            )
        );
    }
}

$people = new People();

function people_grid($atts, $content)
{
    extract(
        shortcode_atts(
            array(
                'limit' => '-1',
                'order' => 'ASC',
                'orderby' => 'title',
                'people_category' => '',
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
        'post_type' => 'people',
        'post_status' => array('publish'),
        'posts_per_page' => $limit,
        'order' => $order,
        'orderby' => $orderby,
        'ignore_sticky_posts' => true
    );

    if (!empty($people_category)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'people_category',
                'field' => 'term_id',
                'terms' => $people_category
            )
        );
    }

    $output = '';
    $people_query = new WP_Query($query_args);
    $count = 0;

    if ($people_query->have_posts()) {
        $count = 0;
        while ($people_query->have_posts()):
                $people_query->the_post();
            if ($count == 0) {
                $output .= '<div class="grid-design outer people">';
            }
                global $post;
                $post_slug = $post->post_name;
                $output .= '<div class="vc_col-sm-4 grid-design people">';
                $output .= '<a class="grid-design link-wrap people" href="#" data-featherlight="#' . $post_slug . '">';         
                $output .= '<img src="' . get_field('people_headshot') . '"/>';  
                $output .= '</a>'; // link-wrap 
                $output .= '<div class="grid-design body-wrapper people">';
                $output .= '<a href="#" data-featherlight="#' . $post_slug . '"><h3 class="name people">' . get_the_title() . '</h3></a>';
                $output .= '<p class="pronoun people">' . get_field('people_pronouns') . '</p>';
               
            if(get_field('people_title') == null || get_field('people_title') == "") {
                $output .= '<h4 class="company people">' . get_field('people_company') . '</h4>';
                $output .= '<h4 class="role-tier people">' . get_field('people_role_tier') . '</h4>';
            }
            else {
                $output .= '<h4 class="title people">' . get_field('people_title') . '</h4>';
                $output .= '<h4 class="role-tier people">' . get_field('people_role_tier') . '</h4>';

            }

                $output .= '<div class="social people">';
            if(get_field('people_linkedin') != null && get_field('people_linkedin') != '') {
                $output .= '<a href="' . get_field('people_linkedin') . '"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
            }
            if(get_field('people_github') != null && get_field('people_linkedin') != '') {
                $output .= '<a href="' . get_field('people_github') . '"><i class="fa fa-github" aria-hidden="true"></i></a>';
            }
            if(get_field('people_x') != null && get_field('people_linkedin') != '') {
                $output .= '<a href="' . get_field('people_x') . '"><i class="icon-salient-x-twitter" aria-hidden="true"></i></a>';  
            }
                $output .= '</div>';



                $output .= '<div id="' . $post_slug . '" class="lightbox">';
                $output .= '<div class="modal people">';
                $output .= '<img src="' . get_field('people_headshot') . '"/>';  
                $output .= '<div class="content people">';
                $output .= '<h3 class="title people">' . get_the_title() . '</h3>'; 
                $output .= '<span class="pronoun people">' . get_field('people_pronouns') . '</span>';
                $output .= '<h4 class="title people">' . get_field('people_title') . '</h4>';            
                $output .= '<div class="biography people">' .  get_field('people_biography') . '</div>';
                $output .= '<div class="social people">';
            if(get_field('people_linkedin') != null && get_field('people_linkedin') != '') {
                $output .= '<a href="' . get_field('people_linkedin') . '"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
            }
            if(get_field('people_github') != null && get_field('people_linkedin') != '') {
                $output .= '<a href="' . get_field('people_github') . '"><i class="fa fa-github" aria-hidden="true"></i></a>';
            }
            if(get_field('people_x') != null && get_field('people_linkedin') != '') {
                $output .= '<a href="' . get_field('people_x') . '"><i class="icon-salient-x-twitter" aria-hidden="true"></i></a>';  
            }
                $output .= '</div>';
                $output .= '</div>'; // content people
                $output .= '</div>'; // modal people
                $output .= '</div>'; // modal lightbox



                $output .= "</div>"; // body-wrapper
                $output .= "</div>"; // people
                $count++;
            if ($count == $columns 
                || $people_query->current_post + 1 == $people_query->post_count
            ) {
                $output .= "</div>";
                $count = 0;
            }
            
        endwhile; /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        $output .= "No People listed";
    }
    return $output;

}

add_shortcode('people', 'people_grid');
