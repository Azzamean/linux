<?php
class Vendors
{
    function __construct()
    {
        add_action('vc_before_init', array($this, 'vendors_grid_nodejsf_vc'));
    }

    function vendors_grid_nodejsf_vc()
    {
        if (function_exists('vc_map')) :
            $tax_filters = array();
            $taxonomies = get_object_taxonomies('vendor', 'objects');
            foreach ($taxonomies as $taxonomy) {
                $tax_filters[$taxonomy->label] = $taxonomy->name;
            }

            $vc_params = array();
            $taxonomies = get_object_taxonomies('vendor', 'objects');
            foreach ($taxonomies as $taxonomy):
                $tax_terms = get_terms(
                    array(
                    'taxonomy' => $taxonomy->name,
                    'hide_empty' => false,
                    'orderby' => 'name'
                    )
                );
                if ($tax_terms) :
                    $tt = array('All' => '');
                    foreach ($tax_terms as $term) {
                        $tt[$term->name] = $term->slug;
                    }

                    $vc_params[] = array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => __($taxonomy->label, 'vendors'),
                        'param_name' => $taxonomy->name,
                        'value' => $tt,
                        'std' => 'All',
                        'description' => __(
                            'Select ' . $taxonomy->label,
                            'vendors'
                        ),
                        'group' => __('Data Settings', 'vendors'),
                        'admin_label' => true
                    );
                endif;
            endforeach;

            $vc_param_args = array(
                'name' => __('Vendors', 'vendors'),
                'base' => 'vendors',
                'icon' => 'icon-wpb-images-stack',
                'class' => '',
                'category' => __('Linux Foundation', 'vendors'),
                'description' => __('Display logo in a grid view.', 'vendors'),
                'params' => array(
                    // General settings
                    array(
                        'type' => 'textfield',
                        'class' => '',
                        'heading' => __('Total items', 'vendors'),
                        'param_name' => 'limit',
                        'value' => 15,
                        'description' => __(
                            'Enter number of logo to be displayed. Enter -1 to display all.',
                            'vendors'
                        ),
                        'group' => __('Data Settings', 'vendors')
                    ),
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => __('Image Size', 'vendors'),
                        'param_name' => 'image_size',
                        'value' => array(
                            __('Original', 'vendors') => '',
                            __('Large', 'vendors') => 'large',
                            __('Medium', 'vendors') => 'medium',
                            __('Thumbnail', 'vendors') => 'thumbnail'
                        ),
                        'description' => __(
                            'Choose logo image size.',
                            'vendors'
                        )
                    ),
                    array(
                        'type' => 'checkbox',
                        'class' => '',
                        'heading' => __('Filters', 'vendors'),
                        'param_name' => 'tax_filters',
                        'value' => $tax_filters,
                        'description' => __('Select Filters.', 'vendors'),
                        'group' => __('Data Settings', 'vendors'),
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => __('Order By', 'vendors'),
                        'param_name' => 'orderby',
                        'value' => array(
                            __('Post Title', 'vendors') => 'title',
                            __('Post Date', 'vendors') => 'date',
                            __('Post ID', 'vendors') => 'ID',
                            __('Post Author', 'vendors') => 'author',
                            __('Post Modified Date', 'vendors') => 'modified',
                            __('Random', 'vendors') => 'rand',
                            __('Menu Order', 'vendors') => 'menu_order'
                        ),
                        'description' => __('Select order type.', 'vendors'),
                        'group' => __('Data Settings', 'vendors')
                    ),

                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => __('Sort order', 'vendors'),
                        'param_name' => 'order',
                        'value' => array(
                            __('Descending', 'vendors') => 'DESC',
                            __('Ascending', 'vendors') => 'ASC'
                        ),
                        'description' => __('Select sorting order.', 'vendors'),
                        'group' => __('Data Settings', 'vendors')
                    )
                )
            );

            foreach ($vc_params as $vc_param) {
                $vc_param_args['params'][] = $vc_param;
            }

            vc_map($vc_param_args);
        endif;
    }
}

$vendors = new Vendors();

function vendors_grid_nodejsf($atts, $content)
{
    $taxonomies = get_object_taxonomies('vendor', 'objects');
    $sc_array = array(
        'limit' => '',
        'cat_id' => '',
        'include_cat_child' => '',
        'tax_filters' => '',
        'order' => 'ASC',
        'orderby' => 'title',
        'grid' => '4',
        'link_target' => '_blank',
        'image_size' => 'large',
        'exclude_post' => array(),
        'posts' => array(),
        'content_words_limit' => '20',
        'content_tail' => '...'
    );

    foreach ($taxonomies as $taxonomy):
        $sc_array[$taxonomy->name] = '';
    endforeach;

    // Shortcode Parameters
    extract(shortcode_atts($sc_array, $atts));

    $limit = !empty($limit) ? $limit : '-1';
    $order = strtolower($order) == 'asc' ? 'ASC' : 'DESC';
    $orderby = !empty($orderby) ? $orderby : 'title';
    $grid = !empty($grid) && $grid <= 12 ? $grid : '4';
    $grid_class = $grid <= 12 ? 'wpls-col-' . $grid : 'wpls-col-4';
    $cat_id = !empty($cat_id) ? explode(',', $cat_id) : '';
    $exclude_cat = !empty($exclude_cat) ? explode(',', $exclude_cat) : array();
    $posts = !empty($posts) ? explode(',', $posts) : array();
    $tf = !empty($tax_filters) ? explode(',', $tax_filters) : array();

    // WP Query Parameters
    $query_args = array(
        'post_type' => 'vendor',
        'post_status' => array('publish'),
        'posts_per_page' => $limit,
        'order' => $order,
        'orderby' => $orderby,
        'post__not_in' => $exclude_post,
        'post__in' => $posts,
        'ignore_sticky_posts' => true
    );

    $tax_query = array('relation' => 'AND');
    foreach ($taxonomies as $taxonomy):
        $t_name = $taxonomy->name;
        if (!empty($$t_name)) {
            $tax_query[] = array(
                'taxonomy' => $taxonomy->name,
                'field' => 'slug',
                'terms' => $$t_name
            );
        }
    endforeach;

    $query_args['tax_query'] = $tax_query;
    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

    $logo_query = new WP_Query($query_args);
    $post_count = $logo_query->post_count;

    if ($logo_query->have_posts()) :
        $output = '';
        $output .= '<div id="vendor-dropdown">
			<form>';
        foreach ($taxonomies as $taxonomy):
            $tax_terms = get_terms(
                array(
                'taxonomy' => $taxonomy->name,
                'hide_empty' => true,
                'orderby' => 'name',
                'parent' => 0
                )
            );
            if ($tax_terms && in_array($taxonomy->name, $tf)) :
                $output .=
                    '
							<fieldset data-filter-group class="pull-left">
								<label>' .
                    $taxonomy->label .
                    '</label>
								<select>
									<option value="">All</option>';
                foreach ($tax_terms as $tax_term) {
                    if ($tax_term->slug == 'members') {
                        //echo $tax_term->slug . "<br/>";
                        $output .=
                            '<option selected="selected" value=".' .
                            $tax_term->slug .
                            '" id="' .
                            $tax_term->slug .
                            '" class="term-filter-parent">' .
                            $tax_term->name .
                            ' (' .
                            $tax_term->count .
                            ')</option>';
                    } else {
                        $output .=
                            '<option value=".' .
                            $tax_term->slug .
                            '" id="' .
                            $tax_term->slug .
                            '" class="term-filter-parent">' .
                            $tax_term->name .
                            ' (' .
                            $tax_term->count .
                            ')</option>';
                    }
                    $child_terms = get_terms(
                        array(
                        'taxonomy' => $taxonomy->name,
                        'hide_empty' => true,
                        'orderby' => 'name',
                        'child_of' => $tax_term->term_id
                        )
                    );

                    if ($child_terms) {
                        foreach ($child_terms as $child_term) {
                            $output .=
                                '<option value=".' .
                                $child_term->slug .
                                '" id="' .
                                $child_term->slug .
                                '" class="term-filter-child">&nbsp; ' .
                                $child_term->name .
                                ' (' .
                                $child_term->count .
                                ')</option>';
                        }
                    }
                }
                $output .= '
								</select>
							</fieldset>';
            endif;
        endforeach;
        $output .= '</form>
		</div>
		<div id="vendor-parent" class="wpls-logo-grid wpls-logo-showcase">';
        while ($logo_query->have_posts()):
            $logo_query->the_post();
            $filters = array();
            $taxonomy_terms = array();
            foreach ($tf as $taxonomy) {
                $vendor_tax_terms = get_the_terms(get_the_ID(), $taxonomy);
                if (is_array($vendor_tax_terms) 
                    || is_object($vendor_tax_terms)
                ) {
                    foreach ($vendor_tax_terms as $tax_term) {
                        $filters[] = $tax_term->slug;
                        if ($taxonomy == "vendor_categories") {
                            $taxonomy_terms[] = $tax_term->name;
                        }
                    }
                }
            }
            $image = get_field('logo');
            if (strlen(strip_tags(get_field('short_description'))) > 150) {
                $short_desc =
                    substr(strip_tags(get_field('short_description')), 0, 150) .
                    '...';
            } else {
                $short_desc = strip_tags(get_field('short_description'));
            }
            $output .=
                '<div class="vendor-container mix ' .
                implode(" ", $filters) .
                '" data-shortdesc="' .
                strip_tags(get_field('short_description')) .
                '">';
            $output .=
                '<img src="' .
                $image['sizes']['medium'] .
                '" data-featherlight="#' .
                get_post_field('post_name') .
                '" alt="' .
                get_the_title() .
                '">';
            $output .= '<div class="vendor-title">' . get_the_title() . '</div>';
            $output .=
                '<div class="vendor-shortdesc">' .
                $short_desc .
                '</div>
												<div class="vendor-readmore"><a data-featherlight="#' .
                get_post_field('post_name') .
                '" class="nectar-button small see-through-2 " style="visibility: visible; color: rgb(0, 0, 0); border-color: rgba(0, 0, 0, 0.75); background-color: transparent;" href="#" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#ffffff"><span>Read More</span></a></div>
						</div>
						<div id="' .
                get_post_field('post_name') .
                '" class="lightbox">
							<img src="' .
                $image['sizes']['medium'] .
                '" alt="' .
                get_the_title() .
                '">
							<h3>' .
                get_the_title() .
                '</h3>
							' .
                wpautop(get_field('short_description'));
            // $output .= '<p class="vendor-question">Who are the consumers/users of your app, product or project?</p><p class="vendor-answer">'. get_field('consumers') .'</p>';
            // $output .= '<p class="vendor-question">What business or technology benefit do your users get by using your app, product or project?</p><p class="vendor-answer">'. get_field('benefits') .'</p>';
            // $output .= '<p class="vendor-question">What were the most compelling features of Node.js for this project?</p><p class="vendor-answer">'. get_field('features') .'</p>';
            
            $vendor_classification = taxonomy_exists('vendor_classification');
            $vendor_version_support = taxonomy_exists('vendor_version_support');

            if ($vendor_classification == true) {
                $vc_terms = get_the_terms($post->ID, 'vendor_classification');
                if (! empty($vc_terms) && ! is_wp_error($vc_terms) ) {          
                    $output .= '<h3>Classification</h3>';
                    $output .= '<p>';
                    $comma = '';
                    foreach ( $vc_terms as $tax ) {
                        $output .= '<span>' . $comma . __($tax->name) . '</span>';
                        $comma = ', ';
                    }       
                    $output .= '</p>';
                }
            }

            if ($vendor_version_support == true) {
                $vvs_terms = get_the_terms($post->ID, 'vendor_version_support');
                if (! empty($vvs_terms) && ! is_wp_error($vvs_terms) ) {          
                    $output .= '<h3>Version Support</h3>';
                    $output .= '<p>';
                    $comma = '';
                    foreach ( $vvs_terms as $tax ) {
                        $output .= '<span>' . $comma . __($tax->name) . '</span>';
                        $comma = ', ';
                    }       
                    $output .= '</p>';
                }
            }
            
            $output .=
                '<div class="vendor-twitter"><a href="' .
                get_field('website') .
                '" target="_blank">Visit</a>
							<a href="https://twitter.com/intent/tweet?url=https://' .
                $_SERVER['HTTP_HOST'] .
                $uri_parts[0] .
                '?application=' .
                get_post_field('post_name') .
                '"><i class="fa fa-twitter"></i></a></div>
						</div>
					';
        endwhile;
        $output .= '</div>';
        $output .=
            '<div id="vendor-filter-error" class="hidden">No vendors found.</div>';
    endif;
    return $output;
}

add_shortcode('vendors', 'vendors_grid_nodejsf');
