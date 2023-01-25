<?php
/**
 * Template Name: Simple Template (No Video or Blog)
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
// GET ACF'S
include_once "acf/templates-acf.php";
// GET SALIENT COLORS
$nectar_options = get_nectar_theme_options();
$accent_color = $nectar_options["accent-color"];
//$templateFile = get_page_template_slug(get_queried_object_id());if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}
get_header();
?>

<div class="container-wrap projects-wrap">
	<div class="container main-content">

		<div class="full-width-section">
			<div class="row-bg-wrap">
				<div class="inner-wrap">
				<?php if ($projects_banner != null && $projects_banner_type == "Image") { ?>
					<div class="row-bg projects-background background-image" style="background-image: url(<?php echo $projects_banner; ?>);"></div>
				<?php } else { ?>
					<div class="row-bg projects-background background-image" style="background-color: <?php echo $projects_banner_color; ?>"></div>
				<?php } ?>
				</div>
			</div>
				
			<div class="hentry projects-heading">
				<div class="col span_12 section-title projects-title">
					<?php if ($projects_header == "Logo") {
					$header = $projects_logo; ?>
					<img src="<?php echo $header; ?>" />
					<?php } if ($projects_header == "Secondary Logo") {
					$header = $projects_secondary_logo; ?>
					<img src="<?php echo $header; ?>" />
					<?php } if ($projects_header != "Logo" && $projects_header != "Secondary Logo") { ?>
					<h1 class="entry-title" style="color:#ffffff;"><?php the_title(); ?></h1>
					<?php } 
					if ($projects_excerpt != null && $projects_banner != null) { ?>		
						<p class="projects-title-text white"> <?php echo $projects_excerpt; ?> </p>
					<?php } 
					else  { ?> <p class="projects-title-text"> <?php echo $projects_excerpt; ?> </p>
					<?php } ?>
				</div>
			</div>
		</div>










		<?php echo do_shortcode('[nectar_global_section id="7879"]'); ?>
	
	
	
	
	
	
	
	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
