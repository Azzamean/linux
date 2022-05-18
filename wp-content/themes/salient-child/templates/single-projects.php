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
//$templateFile = get_page_template_slug(get_queried_object_id());if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}
get_header();
?>

<div class="container-wrap projects-wrap">
	<div class="container main-content">

		<div class="full-width-section">
			<div class="row-bg-wrap">
				<div class="inner-wrap">
				<?php if ($banner != null) { ?>
					<div class="row-bg projects-background background-image" style="background-image: url(<?php echo $banner; ?>);"></div>
				<?php } else { ?>
					<div class="row-bg projects-background background-image"></div>
				<?php } ?>
				</div>
			</div>
			
	
			
			<div class="hentry projects-heading">
				<div class="col span_12 section-title projects-title">
							<?php
       if ($logo_header == "Logo") {
           $header = $logo; ?>
					<img src="<?php echo $header; ?>" />
					<?php
       }
       if ($logo_header == "White Logo") {
           $header = $white_logo; ?>
					<img src="<?php echo $header; ?>" />
					<?php
       }
       if ($logo_header != "Logo" && $logo_header != "White Logo") { ?>
					<h1 class="entry-title" style="color:#ffffff;"><?php the_title(); ?></h1>
					<?php }
       ?>
					
				</div>
			</div>
			
			
			
		</div>

		<div class="row">
			<div class="projects-post-area col">

				<div class="row">
					<section class="projects-description">
						<?php if ($description != null || $description != "") 
						{ 
							wp_enqueue_style('nectar-slider');
							wp_enqueue_style('font-awesome');
							wp_enqueue_style('nectar-slider-fonts');
							echo $description;
						} 
						?>
					</section>
				</div>

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
					<section class="projects-links">
						<div class="projects-link-item">
							<?php foreach ($projects_links as $link) {
           if ($link["url"] != null) { ?>
							<div class="projects-link-wrap">
								<a target="_blank" rel="noopener" href="<?php echo $link[
            "url"
        ]; ?>"><span class="screen-reader-text"><?php echo $link[
    "name"
]; ?></span><i class="<?php echo $link["icon"]; ?>" aria-hidden="true"></i></a>
								<p><?php echo $link["name"]; ?></p>
							</div>
							<?php }
       } ?>
						</div>
					</section>
				</div>

				<div class="row">
					<section class="projects-details">
						<?php if ($details != null || $details != "") { ?>
						<?php echo $details;} ?>
					</section>
				</div>

			</div>
			<!--/post-area-->
		</div>
		<!--/row-->
	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
