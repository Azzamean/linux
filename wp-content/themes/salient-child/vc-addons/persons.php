<?php
class Persons
{
    function __construct()
    {
        add_action('vc_before_init', array($this, 'persons_grid_vc'));
    }

    function persons_grid_vc()
    {
        $types = get_terms(array(
            'taxonomy' => 'person_type',
            'hide_empty' => false,
            'orderby' => 'name'
        ));

        $pt = array('All' => '');
        foreach ($types as $type) {
            $pt[$type->name] = $type->term_id;
        }
        vc_map(array(
            'name' => __('Persons - Linux Foundation Designed', 'persons'),
            'base' => 'persons',
            "icon" => "vc_element-icon icon-wpb-recent-posts",
            'class' => '',
            "category" => esc_html__("Linux Foundation", "persons"),
            'description' => __(
                'Display list of Persons custom post type',
                'persons'
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __('Limit', 'persons'),
                    'param_name' => 'limit',
                    'value' => '-1',
                    'description' => __(
                        'Enter number of people to be displayed. Enter -1 to display all.',
                        'persons'
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Order By', 'persons'),
                    'param_name' => 'orderby',
                    'value' => array(
                        __('Name', 'persons') => 'title',
                        __('Date', 'persons') => 'date',
                        __('ID', 'persons') => 'ID',
                        __('Random', 'persons') => 'rand'
                    ),
                    'description' => __('Select order type.', 'persons')
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Sort order', 'persons'),
                    'param_name' => 'order',
                    'value' => array(
                        __('Descending', 'persons') => 'DESC',
                        __('Ascending', 'persons') => 'ASC'
                    ),
                    'description' => __('Select sorting order.', 'persons')
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __('Persons Type', 'persons'),
                    'param_name' => 'person_type_id',
                    'value' => $pt,
                    'description' => __('', 'persons')
                )
            )
        ));
    }
}

$persons = new Persons();

function persons_grid($atts, $content)
{
    extract(
        shortcode_atts(
            array(
                'limit' => '-1',
                'order' => 'ASC',
                'orderby' => 'title',
                'person_type_id' => '',
                'columns' => 'vc_col-sm-3'
            ),
            $atts
        )
    );

    $limit = !empty($limit) ? $limit : '15';
    $order = strtolower($order) == 'asc' ? 'ASC' : 'DESC';
    $orderby = !empty($orderby) ? $orderby : 'title';
    switch ($columns) {
        case '3':
            $column_class = 'vc_col-sm-4';
            break;
        case '4':
            $column_class = 'vc_col-sm-3';
            break;
        case '5':
            $column_class = 'col-sm-5cols';
            break;
        default:
            $column_class = 'vc_col-sm-3';
            break;
    }

    $query_args = array(
        'post_type' => 'persons',
        'post_status' => array('publish'),
        'posts_per_page' => $limit,
        'order' => $order,
        'orderby' => $orderby,
        'ignore_sticky_posts' => true
    );

    if (!empty($person_type_id)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'person_type',
                'field' => 'term_id',
                'terms' => $person_type_id
            )
        );
    }
    $output = '';
    $persons_query = new WP_Query($query_args);
    $count = 0;
    ?>
        <?php
        if ($persons_query->have_posts()) {
            $count = 0;
            while ($persons_query->have_posts()):
                $persons_query->the_post();
                if ($count == 0) {
                    $output .=
                        '<div class="col span_12 left persons" data-midnight="dark">';
                }
                $output .=
                    '<div class="' .
                    $column_class .
                    ' wpb_column column_container vc_column_container col has-animation no-extra-padding instance-0 one-fourths single-person" data-using-bg="true" data-shadow="none" data-border-animation="" data-border-animation-delay="" data-border-width="none" data-border-style="solid" data-border-color="" data-bg-cover="" data-padding-pos="all" data-has-bg-color="true" data-bg-color="#fff" data-bg-opacity="0" data-hover-bg="#fff" data-hover-bg-opacity="0" data-animation="fade-in-from-bottom" data-delay="0">
									<div class="vc_column-inner">
										<div class="wpb_wrapper">									
											<div class="single-person-grid">
												<div class="span_12 single-person-header">
													<div class="single-person-icon">
														<img src="' .
                    get_field('image') .
                    '">
													</div>
													<div class="single-person-title">
														<h3>' .
                    get_the_title() .
                    '</h3>';
                if (get_field('job')) {
                    $output .= '<h5>' . get_field('job') . '</h5>';
                }
                $output .=
                    '
													</div>
												</div> <!-- End Single person Header -->
												<div class="single-person-description">
													<p class="short_description">' .
                    get_field('short_description') .
                    '</p>
													<p class="read-more"><a href="#" data-featherlight="#' .
                    get_post_field('post_name') .
                    '">Read More</a></p>
													<div class="social-links">';
                if (!empty(get_field('links'))) {
                    foreach (get_field('links') as $link) {
                        $output .=
                            '<a href="' .
                            $link['website'] .
                            '" target="blank" title="' .
                            $link['name'] .
                            '"><i class="fa ' .
                            $link['icon'] .
                            '"></i></a>';
                    }
                }
                $output .=
                    '
													</div>
													<div id="' .
                    get_post_field('post_name') .
                    '" class="lightbox">
														<p class="description">' .
                    wpautop(get_field('description')) .
                    '</p>
													</div>                 
												</div>
											</div>
										</div>
									</div></div>';
                $count++;
                if (
                    $count == 4 ||
                    $persons_query->current_post + 1 ==
                        $persons_query->post_count
                ) {
                    $output .= '</div>';
                    $count = 0;
                }
            endwhile;
            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            $output .= "No persons listed";
        }

        return $output;
}

add_shortcode('persons', 'persons_grid');
