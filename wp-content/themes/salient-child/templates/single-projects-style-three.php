<?php
/**
 * Template Name: Template Style 3 (Three)
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
					
					
					<h5>Get Started With <?php echo get_the_title(); ?></h5>
					
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
<?php if (have_rows("projects_case_studies")): ?>
	<div class="full-width-section case-studies-wrapper">
	  <div class="row-bg-wrap">
	    <div class="inner-wrap row-bg-layer">
	      <div class="row-bg viewport-desktop using-bg-color" style="background-color: #ececec; ">
	      </div>
	    </div>
	  </div>
	  <div class="row_col_wrap_12 col span_12 dark left">
	    <div class="vc_col-sm-12 wpb_column column_container vc_column_container col no-extra-padding inherit_tablet inherit_phone ">
	      <div class="vc_column-inner">
	        <div class="wpb_wrapper">
	          <h2 class="case-studies-heading"><?php echo get_field("projects_case_studies_title"); ?></h2>
	          <div class="wpb_row vc_row-fluid vc_row inner_row">
	            <div class="row-bg-wrap">
	              <div class="row-bg">
	              </div>
	            </div>
	            <div class="row_col_wrap_12_inner col span_12  left">
	<?php if (have_rows("projects_case_studies")):
     $i = 0;
     while (have_rows("projects_case_studies")):
         the_row();
         if (get_row_layout() == "projects_add_case_study"):
             $projects_case_studies_image = get_sub_field(
                 "projects_case_studies_image"
             );
             $projects_case_studies_title = get_sub_field(
                 "projects_case_studies_title"
             );
             $projects_case_studies_download_url = get_sub_field(
                 "projects_case_studies_download_url"
             );
             if ($i > 1) {
                 break;
             } // GRABS ONLY FIRST 2
             echo '<div class="vc_col-sm-6 wpb_column column_container vc_column_container col child_column no-extra-padding inherit_tablet inherit_phone"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="wpb_text_column wpb_content_element "><div class="wpb_wrapper">';
             echo '<div class="projects-case-studies-box">';
             echo '<div class="projects-case-studies-image">';
             echo '<img src="' . $projects_case_studies_image . '"/>';
             echo '</div>';
             echo '<div class="projects-case-studies-information">';
             echo '<h6>' . $projects_case_studies_title . '</h6>';
             echo '<a class="projects-case-studies-button" href="' .
                 $projects_case_studies_download_url .
                 '">Download Now</a>';
             echo '</div>';
             echo '</div>';

             echo "</div></div></div></div></div>";
             $i++;
         endif;
     endwhile;
 endif; ?>
					</section>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div> <?php endif; ?>
	<!--/full-width-section -->	
			

					<?php echo global_shortcode(); ?>	
					
			</div>
			<!--/projects-post-area-->
		</div>
		
	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
