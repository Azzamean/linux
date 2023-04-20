<?php
/**
 * Template Name: Template Style One
 * Template Post Type: webinars
 * The template for displaying single projects custom post types.
 *
 * @package Salient WordPress Theme
 * @version 13.1
 *
 *
 */

// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}
// GET ACF'S
include_once "acf/templates-acf.php";
// GET SALIENT COLORS
$nectar_options = get_nectar_theme_options();
$accent_color = $nectar_options["accent-color"];
get_header();
?>

<div class="container-wrap">
	<div class="container main-content">

		<div class="full-width-section">
			<div class="row-bg-wrap">
				<div class="inner-wrap">
					<div class="row-bg projects-background background-image"></div>
				</div>
			</div>	
			<div class="hentry webinars-heading">
				<div class="col span_12 section-title webinars-title">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</div>
			</div>	
		</div>
		<!--/full-width-section-->	



		<div class="row">
			<div class="col">
				<div class="row"></div>
				<div class="full-width-section"></div>
			</div>
			<!--/post-area-->
		</div>
		<!--/row-->	
		
		
	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
