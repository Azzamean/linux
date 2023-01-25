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
		<?php echo do_shortcode('[nectar_global_section id="7879"]'); ?>
		</div>
	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
