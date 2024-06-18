<?php
/**
 * The template for displaying single working_groups custom post types.
 *
 * @package Salient WordPress Theme
 * @version 13.1
 */

// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}
// GET ACF'S
require_once "acf/templates-acf.php";

// GET SHORTCODES
require_once "global-shortcodes.php";

// GET SALIENT COLORS
$nectar_options = get_nectar_theme_options();
$accent_color = $nectar_options["accent-color"];
//$templateFile = get_page_template_slug(get_queried_object_id());if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}
//$next_post_link_url = get_permalink(get_adjacent_post(false, "", false)->ID);
get_header();
?>

<div class="container-wrap working-groups-wrap">
    <div class="container main-content">

        <div class="full-width-section">
            <div class="row-bg-wrap">
                <div class="inner-wrap">
                <?php if ($working_groups_banner != null && $working_groups_banner_type == "Image") { ?>
                    <div class="row-bg working-groups-background background-image" style="background-image: url(<?php echo $working_groups_banner; ?>);"></div>
                <?php } else { ?>
                    <div class="row-bg working-groups-background background-image" style="background-color: <?php echo $working_groups_banner_color; ?>"></div>
                <?php } ?>
                </div>
            </div>
                
            <div class="hentry working-groups-heading">
                <div class="col span_12 section-title working-groups-title">
                    <?php
                    if ($working_groups_header == "Logo") {
                        $header = $working_groups_logo; ?>
                    <img src="<?php echo $header; ?>" />
                        <?php
                    }
                    if ($working_groups_header == "Secondary Logo") {
                        $header = $working_groups_secondary_logo; ?>
                    <img src="<?php echo $header; ?>" />
                        <?php
                    }
                    if ($working_groups_header != "Logo" 
                        && $working_groups_header != "Secondary Logo"
                    ) { ?>
                    <h1 class="entry-title" style="color:#ffffff;"><?php the_title(); ?></h1>
                    <?php }

                    foreach ($working_groups_header_excerpt as $value) {
                        $values[] = $value;
                    }
                    if ($working_groups_excerpt != null 
                        && $working_groups_banner != null 
                        && $value == "yes"
                    ) {
                        // echo implode(',', $values);
                        ?><h1 class="working-groups-title-text white"> <?php echo $working_groups_excerpt; ?> </h1> <?php 
                    } else {
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--/full-width-section -->
        
        <div class="row" style="padding-bottom: 0">
            <div class="working-groups-post-area col" style="margin-bottom: 0">
            
                <div class="row">
                    <section class="working-groups-description">
                    <?php if ($working_groups_description_title != null 
                    || $working_groups_description_title != ""
) {
         echo "<h6 class='working-groups-description-title'>" .
             $working_groups_description_title .
             "</h6>";
                    } ?>    
                    <?php if ($working_groups_description != null || $working_groups_description != "") {
                        // Pull Nectar Slider CSS
                        wp_enqueue_style("nectar-slider");
                        wp_enqueue_style("font-awesome");
                        wp_enqueue_style("nectar-slider-fonts");
                        // Pull Nectar Slider JS
                        wp_enqueue_script("anime");
                        wp_enqueue_script("nectar-slider");
                        echo $working_groups_description;
                    } ?>
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
                            <div class="row-bg working-groups-background" style="<?php echo $banner; ?>"></div>
                        </div>
                    </div>
                    
                    <section class="working-groups-links" style="margin-bottom: 0">
                        <?php if (have_rows("working_groups_icon_urls")) :
                            while (have_rows("working_groups_icon_urls")):
                                the_row();
                                if (get_row_layout() == "working_groups_add_icon_url") :
                                    $working_groups_url = get_sub_field("working_groups_url");
                                    $working_groups_icon = get_sub_field("working_groups_icon");
                                    $working_groups_icon_name = get_sub_field("working_groups_icon_name");
                                    echo "<div class='working-groups-icons'>";
                                    echo "<a class='working-groups-icon' href='" .
                                      $working_groups_url .
                                      "'>" .
                                      $working_groups_icon .
                                      "</a>" .
                                      "<p><a href='" .
                                      $working_groups_url .
                                      "'>" .
                                      $working_groups_icon_name .
                                      "</a></p>";
                                    echo "</div>";
                                endif;
                            endwhile;
                        endif; ?>
                    </section>
                </div>
                <!--/full-width-section -->
                
            </div>
            <!--/working-groups-post-area-->
        </div>

        <?php echo global_shortcode(); ?>

    </div>
    <!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>