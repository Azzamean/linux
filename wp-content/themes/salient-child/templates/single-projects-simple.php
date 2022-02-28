<?php
/**
 * Template Name: Projects Template - Simple Style
 * Template Post Type: projects
 * The template for displaying single projects custom post types.
 *
 * @package Salient WordPress Theme
 * @version 13.1
 *
 *
 */

// Exit if accessed directly
if (!defined("ABSPATH"))
{
    exit();
}

$templateFile = get_page_template_slug(get_queried_object_id());
if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}
get_header();

?>


<div class="container-wrap no-sidebar">
	
	<div class="container main-content">
		
    <?php get_template_part("includes/partials/single-post/post-header-no-img-regular"); ?>
   	
		<div class="row">

			<div class="post-area col">

			<?php // Main content loop.
if (have_posts()):
    while (have_posts()):
        the_post();
        get_template_part("includes/partials/single-post/post-content");
    endwhile;
endif; ?>

			</div><!--/post-area-->

		</div><!--/row-->

	</div><!--/container main-content-->
	
</div><!--/container-wrap-->


<?php get_footer(); ?>
