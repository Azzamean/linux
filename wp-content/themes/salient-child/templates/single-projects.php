<?php
/**
 *
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

// $templateFile = get_page_template_slug(get_queried_object_id());if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}

get_header();

?>

<div class="container-wrap projects-wrap">
	<div class="container main-content">

		<div class="full-width-section">
			<div class="row-bg-wrap">
				<div class="inner-wrap">
				<?php if ($projects_banner != null) { ?>
					<div class="row-bg projects-background background-image" style="background-image: url(<?php echo $projects_banner; ?>);"></div>
				<?php } else { ?>
					<div class="row-bg projects-background background-image"></div>
				<?php } ?>
				</div>
			</div> 
			<!-- end of row-bg-wrap -->
			<div class="hentry projects-heading">
				<div class="col span_12 section-title projects-title">
					<?php if ($projects_header == "Logo") {
					    $header = $projects_logo; ?> 
						<img src="<?php echo $header; ?>" />
					<?php } ?>
					<?php if ($projects_header == "Secondary Logo") {
					    $header = $projects_secondary_logo; ?>
						<img src="<?php echo $header; ?>" />
					<?php } ?>
					<?php if ($projects_header != "Logo" && $projects_header != "Secondary Logo") { ?>
						<h1 class="entry-title" style="color:#ffffff;"><?php the_title(); ?></h1>
					<?php } ?>
					<?php if ($projects_excerpt != null) { ?>
						<?php if ($projects_banner != null) { ?>
							<p class="projects-title-text white"><?php echo $projects_excerpt; ?></p>
						<?php } else { ?>
							<p class="projects-title-text"><?php echo $projects_excerpt; ?></p>
							<?php } ?>
					<?php } ?>
				</div>
			</div> 
			<!-- end of hentry projects-heading -->
		</div> 
		<!-- end of full-width-section -->
	
		<div class="projects-post-area col">
			<div class="wpb_row vc_row-fluid vc_row top-level">
				<div class="row_col_wrap_12 col span_12 dark left">
					<div class="vc_col-sm-6 wpb_column column_container vc_column_container col no-extra-padding inherit_tablet inherit_phone">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
							<?php echo $projects_video; ?>
							</div>
						</div>
					</div>
					<div class="vc_col-sm-6 wpb_column column_container vc_column_container col no-extra-padding inherit_tablet inherit_phone">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
							<?php echo do_shortcode('[recent_posts_linux_foundation design="grid-design" columns="1" limit="1" category_id="4" categories="1" embedded_code="" featured_image="hide-featured-image" excerpt="" navigation="show_navigation_arrow" date_author="date-and-author" dut="show-dut" pagination="hide-pagination"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end of wpb_row vc_row-fluid vc_row top-level -->
			
			<?php echo do_shortcode('[recent_posts_linux_foundation design="grid-design" columns="3" limit="3" offset="1" category_id="4" categories="1" embedded_code="" featured_image="hide-featured-image" excerpt="" navigation="show_navigation_arrow" date_author="date-and-author" dut="show-dut" pagination="hide-pagination"]'); ?>
			<!-- end of recent posts 3 column -->
					
			<div class="full-width-section">
				<div class="row-bg-wrap">
					<div class="inner-wrap">
						<?php if ($icon_banner != null) {
						    $banner = "background: url(" . $icon_banner . ")";
						} else {
						    $banner = "background-color: " . $accent_color;
						} ?>				
						<div class="row-bg projects-background" style="<?php echo $banner; ?>"></div>
					</div>
				</div>
				<!-- end of row-bg-wrap -->
				
				<section class="projects-links">
					<?php if (have_rows("projects_icon_urls")):
					    while (have_rows("projects_icon_urls")):
					        the_row();
					        if (get_row_layout() == "projects_add_icon_url"):
					            $projects_url = get_sub_field("projects_url");
					            $projects_icon = get_sub_field("projects_icon");
					            echo '<a class="projects-icon" href="' . $projects_url . '">' . $projects_icon . "</a>";
					        endif;
					    endwhile;
					endif; ?>
				</section>
			</div>
			<!-- end of full-width-section -->
			
			<section class="projects-description">
				<?php if ($projects_description != null || $projects_description != "") {
				    // Pull Nectar Slider CSS
				    wp_enqueue_style("nectar-slider");
				    wp_enqueue_style("font-awesome");
				    wp_enqueue_style("nectar-slider-fonts");
				    // Pull Nectar Slider JS
				    wp_enqueue_script("anime");
				    wp_enqueue_script("nectar-slider");
				    echo $projects_description;
				} ?>
			</section>
			<!-- end of projects-description -->
			
			<?php echo do_shortcode('[nectar_global_section id="7879"]'); ?>
			<!-- end of newsletter -->
			
		</div> 
		<!-- end of projects-post-area col -->
	</div>
	<!-- end of container main-content -->
</div>
<!-- end of container-wrap projects-wrap -->

<?php get_footer(); ?>