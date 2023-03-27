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
			
	//add_action( 'myshortcode_processed', function( $shortcode_args ) {
	//	return $shortcode_args;
	//});
	//echo var_dump($shortcode_args);	
	
	
	echo do_shortcode('[recent_posts_linux_foundation design="grid-design" columns="2" limit="10" sort="DESC" offset="" category_id="12" categories="1" embedded_code="" featured_image="hide-featured-image" excerpt="" navigation="show_navigation_btn" navigation_text="LEARN MORE" date_author="date" pagination="show-pagination"]');
		
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
<?php get_footer(); ?>
