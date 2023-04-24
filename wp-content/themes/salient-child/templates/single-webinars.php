<?php
/**
 *
 * The template for displaying single webinars custom post types.
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

<div class="container-wrap">
	<div class="container main-content">

		<div class="wpb_row vc_row-fluid vc_row top-level full-width-section first-section loaded webinars-banner" style="padding-top: 100px; padding-bottom: 200px; ">
		   <div class="row-bg-wrap">
			  <div class="inner-wrap row-bg-layer using-image">
				 <div class="row-bg viewport-desktop using-image" style="background-image: url(<?php echo $banner; ?>); background-position: center bottom; background-repeat: no-repeat; "></div>
			  </div>
		   </div>
		   <div class="row_col_wrap_12 col span_12 dark left">
			  <div class="vc_col-sm-12 wpb_column column_container vc_column_container col no-extra-padding inherit_tablet inherit_phone ">
				 <div class="vc_column-inner">
					<div class="wpb_wrapper">
					   <h1 style="text-align: center;font-family:Fira Sans;font-weight:300;font-style:normal" class="vc_custom_heading">
						<?php the_title(); ?>
					   </h1>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
		<!--/full-width-section-->	

		<div class="row">
			<div class="col">
				<div class="row webinars-video-link">
				<?php
    $iframe = get_field("webinars_video_link");
    preg_match('/src="(.+?)"/', $iframe, $matches);
    $src = $matches[1];
    $params = ["controls" => 0, "hd" => 1, "autohide" => 1];
    $new_src = add_query_arg($params, $src);
    $iframe = str_replace($src, $new_src, $iframe);
    $attributes = 'frameborder="0"';
    $iframe = str_replace(
        "></iframe>",
        " " . $attributes . "></iframe>",
        $iframe
    );
    if ($matches[1]) {
        echo $iframe;
    } else {
        echo '<div class="webinars-non-iframe">' .
            get_field("webinars_video_link") .
            "</div>";
    }
    ?>
				</div>
			</div>
			<!--/post-area-->
		</div>
		<!--/row-->	

		<div class="row">
			<div class="col">
				<div class="row webinars-description">
				<h2>Description</h2>
				<?php echo $description; ?>
				</div>
			</div>
			<!--/post-area-->
		</div>
		<!--/row-->	

		<div class="row">
			<div class="col">
				<div class="row webinars-speakers">
				<h2>Speakers</h2>
					<?php if (have_rows("webinars_speakers")):
         while (have_rows("webinars_speakers")):
             the_row();
             if (get_row_layout() == "webinars_speakers_information"):
                 if (
                     get_sub_field("webinars_speakers_company") != null &&
                     get_sub_field("webinars_speakers_title") != null
                 ):
                     echo "<h3>" .
                         '<span class="webinars-speaker">' .
                         get_sub_field("webinars_speakers_name") .
                         '<span class="webinars-comma">, </span>' .
                         "</span>" .
                         '<span class="webinars-speaker">' .
                         get_sub_field("webinars_speakers_title") .
                         "</span>" .
                         '<span class="webinars-comma">, </span>' .
                         '<span class="webinars-designation">' .
                         get_sub_field("webinars_speakers_company") .
                         "</span>" .
                         "</h3>";
                 elseif (
                     get_sub_field("webinars_speakers_company") != null &&
                     get_sub_field("webinars_speakers_title") == null
                 ):
                     echo "<h3>" .
                         '<span class="webinars-speaker">' .
                         get_sub_field("webinars_speakers_name") .
                         '<span class="webinars-comma">, </span>' .
                         '<span class="webinars-designation">' .
                         get_sub_field("webinars_speakers_company") .
                         "</span>" .
                         "</h3>";
                 elseif (
                     get_sub_field("webinars_speakers_company") == null &&
                     get_sub_field("webinars_speakers_title") != null
                 ):
                     echo "<h3>" .
                         '<span class="webinars-speaker">' .
                         get_sub_field("webinars_speakers_name") .
                         '<span class="webinars-comma">, </span>' .
                         '<span class="webinars-designation">' .
                         get_sub_field("webinars_speakers_title") .
                         "</span>" .
                         "</h3>";
                 else:
                     echo "<h3>" .
                         '<span class="webinars-speaker">' .
                         get_sub_field("webinars_speakers_name") .
                         "</span>" .
                         "</h3>";
                 endif;
             endif;
         endwhile;
     else:
     endif; ?>
				</div>
			</div>
			<!--/post-area-->
		</div>
		<!--/row-->	
		
		<?php echo global_shortcode(); ?>
			
	</div>
	<!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
