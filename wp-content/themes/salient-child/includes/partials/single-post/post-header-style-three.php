<?php
/**
 * Post single style three
 *
 * @package Salient WordPress Theme
 * @subpackage Partials
 * @version 15.5
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit();
}

global $post;

$nectar_options = get_nectar_theme_options();

$bg = apply_filters(
    'nectar_page_header_bg_val',
    get_post_meta($post->ID, '_nectar_header_bg', true)
);
$bg_color = apply_filters(
    'nectar_page_header_bg_color_val',
    get_post_meta($post->ID, '_nectar_header_bg_color', true)
);
$blog_post_type_list = array('post');
if (has_filter('nectar_metabox_post_types_post_header')) {
    $blog_post_type_list = apply_filters(
        'nectar_metabox_post_types_post_header',
        $blog_post_type_list
    );
}
$is_blog_header_post_type =
    isset($post->post_type) &&
    in_array($post->post_type, $blog_post_type_list) &&
    is_single()
        ? true
        : false;
$single_post_header_inherit_fi =
    !empty($nectar_options['blog_post_header_inherit_featured_image']) &&
    $is_blog_header_post_type
        ? $nectar_options['blog_post_header_inherit_featured_image']
        : '0';
$theme_skin = NectarThemeManager::$skin;
$fullscreen_header =
    !empty($nectar_options['blog_header_type']) &&
    $nectar_options['blog_header_type'] === 'fullscreen' &&
    is_singular('post')
        ? true
        : false;
$blog_header_type = !empty($nectar_options['blog_header_type'])
    ? $nectar_options['blog_header_type']
    : 'default';
$fullscreen_class =
    $fullscreen_header === true ? 'fullscreen-header full-width-content' : null;
$blog_social_style = get_option('salient_social_button_style')
    ? get_option('salient_social_button_style')
    : 'fixed';
$remove_single_post_date = !empty($nectar_options['blog_remove_single_date'])
    ? $nectar_options['blog_remove_single_date']
    : '0';
$remove_single_post_author = !empty(
    $nectar_options['blog_remove_single_author']
)
    ? $nectar_options['blog_remove_single_author']
    : '0';
$remove_single_post_comment_number = !empty(
    $nectar_options['blog_remove_single_comment_number']
)
    ? $nectar_options['blog_remove_single_comment_number']
    : '0';
$remove_single_post_nectar_love = !empty(
    $nectar_options['blog_remove_single_nectar_love']
)
    ? $nectar_options['blog_remove_single_nectar_love']
    : '0';
?>

<div id="page-header-wrap" data-animate-in-effect="none" data-midnight="light" class="" style="height: 400px;">
   <div id="page-header-bg" class="not-loaded  hentry" data-post-hs="default_minimal" data-padding-amt="normal" data-animate-in-effect="none" data-midnight="light" data-text-effect="" data-bg-pos="center" data-alignment="left" data-alignment-v="middle" data-parallax="0" data-height="550" style="height:400px;">
      <div class="page-header-bg-image-wrap" id="nectar-page-header-p-wrap" data-parallax-speed="fast">
         <div class="page-header-bg-image solid-color"></div>
      </div>
      <div class="container">
        <div class="row">
            <div class="col span_6 section-title blog-title" data-remove-post-date="0" data-remove-post-author="0" data-remove-post-comment-number="1">
               <div class="inner-wrap">
				 		<h1 class="entry-title style-three"><?php the_title(); ?></h1>
						
							<div id="single-below-header" data-hide-on-mobile="<?php echo esc_attr(
           $using_fixed_salient_social
       ); ?>">


<?php
if ('1' !== $remove_single_post_author) {
    echo '<span class="meta-author vcard author"><span class="fn"><span class="author-leading">' .
        esc_html__('By', 'salient') .
        '</span> ' .
        get_the_author_posts_link() .
        '</span></span>';
}

$date_functionality =
    isset($nectar_options['post_date_functionality']) &&
    !empty($nectar_options['post_date_functionality'])
        ? $nectar_options['post_date_functionality']
        : 'published_date';
if ('1' !== $remove_single_post_date) {
    if ('last_editied_date' === $date_functionality) {
        echo '<span class="meta-date date updated"><i>' .
            get_the_modified_date() .
            '</i></span>';
    } else {
        $nectar_u_time = get_the_time('U');
        $nectar_u_modified_time = get_the_modified_time('U');
        if ($nectar_u_modified_time >= $nectar_u_time + 86400) {
            echo '<span class="meta-date date published">' .
                get_the_date() .
                '</span>';
            echo '<span class="meta-date date updated rich-snippet-hidden">' .
                get_the_modified_time(__('F jS, Y', 'salient')) .
                '</span>';
        } else {
            echo '<span class="meta-date date updated">' .
                get_the_date() .
                '</span>';
        }
    }
}
?>
						</div><!--/single-below-header-->
						
               </div>
            </div>
            <!--/section-title-->
         </div>
         <!--/row-->
      </div>
   </div>
</div>