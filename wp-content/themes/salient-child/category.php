<?php
/**
 * The template for displaying custom single category page.
 *
 * @package Salient WordPress Theme
 * @version 13.0
 */

// Exit if accessed directly.
if (!defined("ABSPATH")) {
    exit();
}

get_header();
nectar_page_header($post->ID);
$nectar_fp_options = nectar_get_full_page_options();
?>
<div class="container-wrap">
	<div class="<?php if ($nectar_fp_options["page_full_screen_rows"] !== "on") {
     echo "container";
 } ?> main-content" role="main">
		<div class="row">
			
			<div class="post-area col span_9">		
				<?php
    nectar_hook_before_content();
    if (have_posts()):
        $category_id = get_cat_ID(single_cat_title("", false));
        echo do_shortcode(
            '[recent_posts_linux_foundation design="grid-design" columns="2" limit="10" sort="DESC" offset="" category_id="' .
                $category_id .
                '" categories="0" embedded_code="" featured_image="hide-featured-image" excerpt="" navigation="show_navigation_btn" navigation_text="LEARN MORE" date_author="date" pagination="show-pagination"]'
        );
    endif;
    nectar_hook_after_content();
    ?>			
			</div><!--/span_9-->		
			<div id="sidebar" class="col span_3 col_last"> 
				<?php get_sidebar(); ?>
			</div><!--/span_9-->
			
		</div><!--/row-->
	</div>
	<?php nectar_hook_before_container_wrap_close(); ?>
</div>

<?php
//add_action( 'myshortcode_processed', function( $shortcode_args ) {
//	return $shortcode_args;
//});
//echo var_dump($shortcode_args);
//echo $post->ID . ' looking for 57 for Ambassadors Page';
//global $post;
//$category_detail = get_the_category( $post->ID );
//$category_detail[0]->term_id;
//echo $category_detail[0]->term_id . ' term id... should be 50 for CBT';
//echo $category_id . ' cat id';

//$title = get_post_meta($postid, '_nectar_header_title', true);
//echo $title . 'title...';
//$categories = get_the_category();
//if (!empty($categories)) {
//global $post;
//$category_detail = get_the_category($post->ID);
//$category_detail[0]->term_id;
//echo $category_detail[0]->term_id; // finds 57
//$output = null;
//foreach ($categories as $category) {
//$output .= '<a class="' . esc_attr( $category->slug ) . ' nectar-inherit-border-radius nectar-bg-hover-accent-color" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'salient' ), $category->name ) ) . '">' . esc_html( $category->term_id ) . '</a>';
//}
//echo apply_filters('nectar_blog_page_header_categories', trim( $output )); // WPCS: XSS ok.
//}
?>
<?php get_footer(); ?>
