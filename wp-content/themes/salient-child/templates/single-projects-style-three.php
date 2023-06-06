<?php
/**
 * Template Name: Template Style Three
 * Template Post Type: projects
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

// GET SHORTCODES
include_once "global-shortcodes.php";

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
					<?php
     if ($projects_header == "Logo") {
         $header = $projects_logo; ?>
						 <div class="projects-logo-container">
							<img src="<?php echo $header; ?>" />
						 </div>		 
					
					<?php
     }
     if ($projects_header == "Secondary Logo") {
         $header = $projects_secondary_logo; ?>
						 <div class="projects-logo-container">
							<img src="<?php echo $header; ?>" />
						 </div>
	 <?php
     }
     ?>

				</div>
				
			</div>
			
		</div>
		<!--/full-width-section -->	
									
				<div class="row">
					<section class="projects-description">
					<?php if (
         $projects_description_title != null ||
         $projects_description_title != ""
     ) {
         echo "<h6 class='projects-description-title'>" .
             $projects_description_title .
             "</h6>";
     } ?>	
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
				</div>
				<!--/row-->	
				
				
							<div class="full-width-section">
					<div class="row-bg-wrap">
						<div class="inner-wrap">
							<?php if ($icon_banner != null) {
           $banner = "background: url(" . $icon_banner . ")";
       } ?>				
							<div class="row-bg projects-background" style="<?php echo $banner; ?>"></div>
						</div>
					</div>
					
					
					<h5>Get Started With Alvarium</h5>
					
					<section class="projects-links">
						<?php if (have_rows("projects_icon_urls")):
          while (have_rows("projects_icon_urls")):
              the_row();
              if (get_row_layout() == "projects_add_icon_url"):
                  $projects_url = get_sub_field("projects_url");
                  $projects_icon = get_sub_field("projects_icon");
                  $projects_icon_name = get_sub_field("projects_icon_name");
                  echo "<div class='projects-icons'>";
                  echo "<a class='projects-icon' href='" .
                      $projects_url .
                      "'>" .
                      $projects_icon .
                      "</a>" .
                      "<p><a href='" .
                      $projects_url .
                      "'>" .
                      $projects_icon_name .
                      "</a></p>";
                  echo "</div>";
              endif;
          endwhile;
      endif; ?>
					</section>
				</div>
				<!--/full-width-section -->	
				
				
				
			</div>
			<!--/projects-post-area-->
		</div>

		<?php echo global_shortcode(); ?>

	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
