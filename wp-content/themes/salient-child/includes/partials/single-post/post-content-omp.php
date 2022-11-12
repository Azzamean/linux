<?php
/**
* Single Post Content
*
* @version 13.1
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $nectar_options;

$nectar_post_format            = get_post_format();
$hide_featrued_image           = ( ! empty( $nectar_options['blog_hide_featured_image'] ) ) ? $nectar_options['blog_hide_featured_image'] : '0';
$single_post_header_inherit_fi = ( ! empty( $nectar_options['blog_post_header_inherit_featured_image'] ) ) ? $nectar_options['blog_post_header_inherit_featured_image'] : '0';
$blog_header_type              = ( ! empty( $nectar_options['blog_header_type'] ) ) ? $nectar_options['blog_header_type'] : 'default';
$blog_social_style             = ( get_option( 'salient_social_button_style' ) ) ? get_option( 'salient_social_button_style' ) : 'fixed';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="inner-wrap">

		<div class="post-content" data-hide-featured-media="<?php echo esc_attr( $hide_featrued_image ); ?>">
      
        <?php
  
        if( function_exists('nectar_social_sharing_output') && 'default' == $blog_social_style && 'image_under' === $blog_header_type) {
          nectar_social_sharing_output('vertical');
        }
  
        ?>
        
		<div class="post-area col span_9">
		<?php
			the_content();
		?>
				
		</div><!--/span_9-->
			
		<div id="sidebar" class="col span_3 col_last">
			<h3>SIMILAR VIDEOS</h3>
		</div><!--/span_9-->
		
      </div><!--/post-content-->

	  
	  
    </div><!--/inner-wrap-->
  
</article> 		