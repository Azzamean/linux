<?php
/**
 * Template Name: Template Style 1 (One)
 * Template Post Type: webinars
 * The template for displaying single webinars custom post types.
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
get_header();
?>


<div class="container-wrap" style="padding-top:0">
    <div class="container main-content">

        <div class="wpb_row vc_row-fluid vc_row top-level full-width-section first-section loaded webinars-banner">
           <div class="row-bg-wrap">
              <div class="inner-wrap row-bg-layer using-image">
                 <div class="row-bg viewport-desktop using-image" style="background-image: url(<?php echo $webinars_banner; ?>); background-position: top center; background-repeat: no-repeat; "></div>
              </div>
           </div>
           <div class="row_col_wrap_12 col span_12 dark left">
              <div class="vc_col-sm-12 wpb_column column_container vc_column_container col no-extra-padding inherit_tablet inherit_phone ">
                 <div class="vc_column-inner">
                    <div class="wpb_wrapper webinars-title-wrap">
                       <h1 class="vc_custom_heading webinars-title">
                        <?php the_title(); ?>
                       </h1>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <!--/full-width-section-->    



<div class="webinars-content">


            <div id="single-below-header" data-hide-on-mobile="<?php echo esc_attr(
                $using_fixed_salient_social
); ?>">
                                        <?php
                                        echo '<span class="meta-author vcard author"><span class="fn"><span class="author-leading">' .
                                        esc_html__("By", "salient") .
                                        "</span> " .
                                        get_the_author_posts_link() .
                                        "</span></span>";

                                        echo " | ";

                                        $date_functionality =
                                        isset($nectar_options["post_date_functionality"]) &&
                                        !empty($nectar_options["post_date_functionality"])
                                        ? $nectar_options["post_date_functionality"]
                                        : "published_date";

                                        if ("1" !== $remove_single_post_date) {
                                            if ("last_editied_date" === $date_functionality) {
                                                echo '<span class="meta-date date updated"><i>' .
                                                  get_the_modified_date() .
                                                  "</i></span>";
                                            } else {
                                                $nectar_u_time = get_the_time("U");
                                                $nectar_u_modified_time = get_the_modified_time("U");
                                                if ($nectar_u_modified_time >= $nectar_u_time + 86400) {
                                                    echo '<span class="meta-date date published">' .
                                                      get_the_date() .
                                                      "</span>";
                                                    echo '<span class="meta-date date updated rich-snippet-hidden">' .
                                                      get_the_modified_time(__("F jS, Y", "salient")) .
                                                      "</span>";
                                                } else {
                                                    echo '<span class="meta-date date updated">' .
                                                      get_the_date() .
                                                      "</span>";
                                                }
                                            }
                                        }
                                        ?>
            </div><!--/single-below-header-->      

            <h2 class="webinars-sub-title"><?php the_title(); ?></h2>
            <?php echo $webinars_description; ?>
            
            
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
            
            
            
            
       <div class="single-blog-bottom-navigation webinars">
            <a class="back-to-all" href="/webinars/">< Back To All Webinars</a>
            <!-- <a class="view-next" href="<?php echo $next_post_link_url; ?>">View Next Webinar Post ></a> -->
                <?php if (get_adjacent_post(false, "", true)) {
                    previous_post_link("%link", "View Next Webinar>");
                } else {
                    $last = new WP_Query("post_type=webinars&posts_per_page=1&order=DESC");
                    $last->the_post();

                    echo '<a class="view-next" href="' .
                        get_permalink() .
                        '">View Next Webinars ></a>';
                    wp_reset_postdata();
                } ?>
        </div>  

</div>
<!-- /webinars-content -->


        
        <?php echo global_shortcode(); ?>
            
    </div>
    <!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>