<?php
function cptui_register_my_cpts_vendor_zephyr()
{

    /**
     * Post Type: Vendors.
     */

    $labels = array(
    "name" => __('Vendors', ''),
    "singular_name" => __('Vendor', ''),
    "menu_name" => __('Vendors', ''),
    );

    $args = array(
    "label" => __('Vendors', ''),
    "labels" => $labels,
    "description" => "Member Vendors",
    "public" => true,
    "publicly_queryable" => false,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "has_archive" => true,
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => array( "slug" => "vendor", "with_front" => true ),
    "query_var" => true,
    "supports" => array( "title", "editor" ),
    );

    register_post_type("vendor", $args);
}

if(function_exists('acf_add_local_field_group') ) :

    acf_add_local_field_group(
        array(
        'key' => 'group_590b93ad94dc0',
        'title' => 'Vendors',
        'fields' => array(
        array(
        'key' => 'field_58e5d7a6ec939',
        'label' => 'Logo',
        'name' => 'logo',
        'type' => 'image',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
        ),
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'return_format' => 'array',
        'min_width' => 0,
        'min_height' => 0,
        'min_size' => 0,
        'max_width' => 0,
        'max_height' => 0,
        'max_size' => 0,
        'mime_types' => '',
        ),
        array(
        'key' => 'field_58e5d7c7ec93a',
        'label' => 'Short Description',
        'name' => 'short_description',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 2,
        'new_lines' => 'br',
        ),
        array(
        'key' => 'field_58e5d7f3ec93c',
        'label' => 'Website',
        'name' => 'website',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
        ),
        ),
        'location' => array(
        array(
        array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'vendor',
        ),
        ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'discussion',
        3 => 'comments',
        4 => 'revisions',
        5 => 'slug',
        6 => 'author',
        7 => 'format',
        8 => 'featured_image',
        9 => 'categories',
        10 => 'tags',
        11 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
        )
    );

endif;

add_action('init', 'cptui_register_my_cpts_vendor_zephyr');

function cptui_register_my_taxes_Zephyr()
{

    /**
     * Taxonomy: Development Tools.
     */

    $labels = array(
    "name" => __('Development Tools', ''),
    "singular_name" => __('Development Tools', ''),
    );

    $args = array(
    "label" => __('Development Tools', ''),
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Development Tools",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( 'slug' => 'vendor_dev_tools', 'with_front' => true, ),
    "show_admin_column" => false,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => false,
    );
    register_taxonomy("vendor_dev_tools", array( "vendor" ), $args);

    /**
     * Taxonomy: Applications & Middleware.
     */

    $labels = array(
    "name" => __('Applications & Middleware', ''),
    "singular_name" => __('Applications & Middleware', ''),
    );

    $args = array(
    "label" => __('Applications & Middleware', ''),
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Applications & Middleware",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( 'slug' => 'vendor_app_mid', 'with_front' => true, ),
    "show_admin_column" => false,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => false,
    );
    register_taxonomy("vendor_app_mid", array( "vendor" ), $args);

    /**
     * Taxonomy: Training & Consulting.
     */

    $labels = array(
    "name" => __('Training & Consulting', ''),
    "singular_name" => __('Training & Consulting', ''),
    );

    $args = array(
    "label" => __('Training & Consulting', ''),
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Training & Consulting",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( 'slug' => 'vendor_tra_con', 'with_front' => true, ),
    "show_admin_column" => false,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => false,
    );
    register_taxonomy("vendor_tra_con", array( "vendor" ), $args);
    
    /**
     * Taxonomy: All Vendors.
     */

    $labels = array(
    "name" => __('All Vendors', ''),
    "singular_name" => __('All Vendors', ''),
    );

    $args = array(
    "label" => __('All Vendors', ''),
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "All Vendors",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( 'slug' => 'vendor_all', 'with_front' => true, ),
    "show_admin_column" => false,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => false,
    );
    register_taxonomy("vendor_all", array( "vendor" ), $args);
}

add_action('vc_before_init', 'cptui_register_my_taxes_Zephyr');


class VendorsZephyr
{
    function __construct()
    {
        add_action('vc_before_init', array($this, 'vendors_grid_nodejsf_vc'));
    }

    function vendors_grid_nodejsf_vc()
    {
        if(function_exists('vc_map')) :
            $tax_filters = array();
            $taxonomies = get_object_taxonomies('vendor', 'objects');
            foreach ($taxonomies as $taxonomy){
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
                if($tax_terms) :
                          $tt = array('All' => '');
                    foreach ($tax_terms as $term) {
                        $tt[$term->name] =  $term->slug;
                    }
                    
                    $vc_params[] = array(
                     'type'             => 'dropdown',
                     'class'         => '',
                     'heading'         => __($taxonomy->label, 'vendors'),
                     'param_name'     => $taxonomy->name,
                     'value'         => $tt,
                     'std'                => 'All',
                     'description'     => __('Select ' . $taxonomy->label, 'vendors'),
                     'group'         => __('Data Settings', 'vendors'),
                     'admin_label' => true
                    );
                endif;
            endforeach;

            $vc_param_args = array(
            'name'             => __('Vendors', 'vendors'),
            'base'             => 'vendors',
            'icon'             => 'icon-wpb-images-stack',
            'class'         => '',
            'category'         => __('Content', 'vendors'),
            'description'     => __('Display logo in a grid view.', 'vendors'),
            'params'         =>     array(
            // General settings
            array(
                        'type'             => 'textfield',
                        'class'         => '',
                        'heading'         => __('Total items', 'vendors'),
                        'param_name'     => 'limit',
                        'value'         => 15,
                        'description'     => __('Enter number of logo to be displayed. Enter -1 to display all.', 'vendors'),
                        'group'         => __('Data Settings', 'vendors'),
            ),
            array(
            'type'             => 'dropdown',
            'class'         => '',
            'heading'         => __('Image Size', 'vendors'),
            'param_name'     => 'image_size',
            'value'         => array(
                                                __('Original', 'vendors')         => '',
                                                __('Large', 'vendors')             => 'large',
                                                __('Medium', 'vendors')             => 'medium',
                                                __('Thumbnail', 'vendors')         => 'thumbnail',
                                            ),
            'description'     => __('Choose logo image size.', 'vendors'),
            ),
            array(
            'type'             => 'checkbox',
            'class'         => '',
            'heading'         => __('Filters', 'vendors'),
            'param_name'     => 'tax_filters',
            'value'         => $tax_filters,
            'description'     => __('Select Filters.', 'vendors'),
            'group'         => __('Data Settings', 'vendors'),
            'admin_label' => true
            ),
            array(
            'type'             => 'dropdown',
            'class'         => '',
            'heading'         => __('Order By', 'vendors'),
            'param_name'     => 'orderby',
            'value'         => array(
                                            __('Post Title', 'vendors')             => 'title',
                                            __('Post Date', 'vendors')             => 'date',
                                            __('Post ID', 'vendors')             => 'ID',
                                            __('Post Author', 'vendors')         => 'author',
                                            __('Post Modified Date', 'vendors')     => 'modified',
                                            __('Random', 'vendors')                 => 'rand',
                                            __('Menu Order', 'vendors')             => 'menu_order',
                                        ),
            'description'     => __('Select order type.', 'vendors'),
            'group'         => __('Data Settings', 'vendors')
            ),

            array(
            'type'             => 'dropdown',
            'class'         => '',
            'heading'         => __('Sort order', 'vendors'),
            'param_name'     => 'order',
            'value'         => array(
                                            __('Descending', 'vendors')     => 'DESC',
                                            __('Ascending', 'vendors')     => 'ASC',
                                        ),
            'description'     => __('Select sorting order.', 'vendors'),
            'group'         => __('Data Settings', 'vendors')
            ),
            )
            );

            foreach($vc_params as $vc_param){
                $vc_param_args['params'][] = $vc_param;
            }

            vc_map($vc_param_args);
        endif;
    }
}

$vendors = new VendorsZephyr();

function vendors_grid_nodejsf( $atts, $content )
{
    $taxonomies = get_object_taxonomies('vendor', 'objects');
    $sc_array = array(
    'limit'                             => '',
    'cat_id'                             => '',
    'include_cat_child'        => '',
    'tax_filters'                  => '',
    'order'                                => 'ASC',
    'orderby'                            => 'title',
    'grid'                                 => '4',
    'link_target'                 => '_blank',
    'image_size'                     => 'large',
    'exclude_post'                => array(),
    'posts'                                => array(),
    'content_words_limit' => '20',
    'content_tail'                => '...'
    );

    foreach ($taxonomies as $taxonomy):
        $sc_array[$taxonomy->name] = ''; 
    endforeach;

    // Shortcode Parameters
    extract(shortcode_atts($sc_array, $atts));

    $limit                = !empty($limit)                                     ? $limit                                         : '-1';
    $order                 = (strtolower($order) == 'asc')     ? 'ASC'                                         : 'DESC';
    $orderby            = !empty($orderby)                                 ? $orderby                                     : 'title';
    $grid                    = (!empty($grid) && $grid <= 12)     ? $grid                                         : '4';
    $grid_class        = ($grid <= 12 )                                     ? ('wpls-col-'.($grid))         : 'wpls-col-4';
    $cat_id                = (!empty($cat_id))                                ? explode(',', $cat_id)             : '';
    $exclude_cat     = !empty($exclude_cat)                        ? explode(',', $exclude_cat): array();
    $posts                 = !empty($posts)                                    ? explode(',', $posts)             : array();
    $tf                     = !empty($tax_filters)                         ? explode(',', $tax_filters): array();

    // WP Query Parameters
    $query_args = array(
    'post_type'                     => 'vendor',
    'post_status'                 => array( 'publish' ),
    'posts_per_page'            => $limit,
    'order'                      => $order,
    'orderby'                    => $orderby,
    'post__not_in'                => $exclude_post,
    'post__in'                        => $posts,
    'ignore_sticky_posts'    => true,
    );

    $tax_query = array('relation' => 'AND');
    foreach ($taxonomies as $taxonomy):
        $t_name = $taxonomy->name;
        if(!empty($$t_name)) {
            $tax_query[] = array(
            'taxonomy'    => $taxonomy->name,
            'field'            => 'slug',
            'terms'            => $$t_name
            );    
        }    
    endforeach;

    $query_args['tax_query'] = $tax_query;
    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);


    $logo_query = new WP_Query($query_args);
    $post_count = $logo_query->post_count;
            
    if($logo_query->have_posts()) :
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
            if($tax_terms && in_array($taxonomy->name, $tf)) :
                $output .= '
							<fieldset data-filter-group class="pull-left">
								<label>'.$taxonomy->label.'</label>
								<select>
									<option value="">All</option>';
                foreach ($tax_terms as $tax_term) {    
                    if($tax_term->slug == 'zephyr-members') {                                    
                         //echo $tax_term->slug . "<br/>";
                         $output .= '<option selected="selected" value=".'. $tax_term->slug .'" id="'. $tax_term->slug .'" class="term-filter-parent">'. $tax_term->name .' ('. $tax_term->count .')</option>';
                    }
                    else {
                        $output .= '<option value=".'. $tax_term->slug .'" id="'. $tax_term->slug .'" class="term-filter-parent">'. $tax_term->name .' ('. $tax_term->count .')</option>';
                    }
                    $child_terms = get_terms(
                        array(
                        'taxonomy' => $taxonomy->name,
                        'hide_empty' => true,
                        'orderby' => 'name',
                        'child_of' => $tax_term->term_id
                        )
                    );
            
                    if($child_terms) {
                        foreach($child_terms as $child_term){
                            $output .= '<option value=".'. $child_term->slug .'" id="'. $child_term->slug .'" class="term-filter-child">&nbsp; '. $child_term->name .' ('. $child_term->count .')</option>';
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
        while ( $logo_query->have_posts() ) : $logo_query->the_post();
            $filters = array();
            $taxonomy_terms = array();
            foreach ($tf as $taxonomy) {
                 $vendor_tax_terms = get_the_terms(get_the_ID(), $taxonomy);
                if(is_array($vendor_tax_terms) || is_object($vendor_tax_terms)) {
                    foreach ($vendor_tax_terms as $tax_term) {
                            $filters[] = $tax_term->slug;
                        if($taxonomy == "vendor_categories") {
                            $taxonomy_terms[] = $tax_term->name;
                        }
                    }
                }
            }
            $image = get_field('logo');
            if(strlen(strip_tags(get_field('short_description')))> 150) {
                $short_desc = substr(strip_tags(get_field('short_description')), 0, 150) . '...';
            } else {
                $short_desc = strip_tags(get_field('short_description'));
            }
            $output .= '<div class="vendor-container mix '. implode(" ", $filters) .'" data-shortdesc="'. strip_tags(get_field('short_description')) .'">';
                        $output .= '<img src="'. $image['sizes']['medium'] .'" data-featherlight="#'. get_post_field('post_name') .'" alt="'. get_the_title() .'">';
                        $output .= '<div class="vendor-shortdesc">'. $short_desc .'</div>
												<div class="vendor-readmore"><a data-featherlight="#'. get_post_field('post_name') .'" class="nectar-button small see-through-2 " style="visibility: visible; color: rgb(0, 0, 0); border-color: rgba(0, 0, 0, 0.75); background-color: transparent;" href="#" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#ffffff"><span>Read More</span></a></div>
						</div>
						<div id="'. get_post_field('post_name') .'" class="lightbox">
							<img src="'. $image['sizes']['medium'] .'" alt="'. get_the_title() .'">
							<h3>'. get_the_title() .'</h3>
							'. wpautop(get_field('short_description'));
                        // $output .= '<p class="vendor-question">Who are the consumers/users of your app, product or project?</p><p class="vendor-answer">'. get_field('consumers') .'</p>';
                        // $output .= '<p class="vendor-question">What business or technology benefit do your users get by using your app, product or project?</p><p class="vendor-answer">'. get_field('benefits') .'</p>';
                        // $output .= '<p class="vendor-question">What were the most compelling features of Node.js for this project?</p><p class="vendor-answer">'. get_field('features') .'</p>';
                        $output .= '<a href="'. get_field('website') .'" target="_blank">Visit</a>
							<a href="https://twitter.com/intent/tweet?url=https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] .'?application='. get_post_field('post_name') .'"><i class="fa fa-twitter"></i></a>
						</div>
					';
        endwhile; 
        $output .= '</div>';
        $output .= '<div id="vendor-filter-error" class="hidden">No vendors found.</div>';
    endif; 
    return $output; 
}

add_shortcode('vendors', 'vendors_grid_nodejsf');
