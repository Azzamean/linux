<?php
/**
 * Single Post Content
 *
 * @version 13.1
 */

// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}

global $nectar_options;

$nectar_post_format = get_post_format();
$hide_featrued_image = !empty($nectar_options["blog_hide_featured_image"])
    ? $nectar_options["blog_hide_featured_image"]
    : "0";
$single_post_header_inherit_fi = !empty(
    $nectar_options["blog_post_header_inherit_featured_image"]
)
    ? $nectar_options["blog_post_header_inherit_featured_image"]
    : "0";
$blog_header_type = !empty($nectar_options["blog_header_type"])
    ? $nectar_options["blog_header_type"]
    : "default";
$blog_social_style = get_option("salient_social_button_style")
    ? get_option("salient_social_button_style")
    : "fixed";

$protocol =
    (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") ||
    $_SERVER["SERVER_PORT"] == 443
        ? "https://"
        : "http://";
$url = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="inner-wrap">

		<div class="post-content" data-hide-featured-media="<?php echo esc_attr(
      $hide_featrued_image
  ); ?>">
          
			<div class="post-area col span_9">
				
				<div class="fixed-social">
				<a class="fixed-sharing" href="mailto:?" title="Share with Email" target="_blank"><i class="fa fa-envelope"></i></a>
				<a class="fixed-sharing" href="https://twitter.com/intent/tweet?text=<?php echo $url; ?>" title="Share with Twitter" target="_blank"> <i class="fa fa-twitter"></i></a>
				<a class="fixed-sharing" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" title="Share with Facebook" target="_blank"> <i class="fa fa-facebook"></i></a>
				<a class="fixed-sharing" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>" title="Share with LinkedIn" target="_blank"> <i class="fa fa-linkedin"></i></a>
				</div>
			
			<?php
			$format = get_post_format();
			echo $format;
   the_content();

   if (
       !has_category([
           "techstrongtv",
           "making-our-strong-community-stronger-initiative",
           "tfir-partnership",
       ])
   ) { ?>
				
				<div class="author-meta-box">
					<h6>About the Author</h6>
					<p><?php echo get_the_author_meta("description"); ?></p>
				</div>			
			<?php }
   ?>
					
			</div><!--/span_9-->

<?php
$category = "";
if (has_category("announcements")) {
    $category = "announcements";
} elseif (has_category("i-am-a-mainframer")) {
    $category = "i-am-a-mainframer";
} elseif (has_category("techstrongtv")) {
    $category = "techstrongtv";
} elseif (has_category("tfir-partnership")) {
    $category = "tfir-partnership";
} elseif (has_category("making-our-strong-community-stronger-initiative")) {
    $category = "making-our-strong-community-stronger-initiative";
} else {
    $category = "default";
}
?>


			
		<div id="sidebar" class="col span_3 col_last">
			<?php
   if ($category == "announcements") {
       echo '<h3 class="simlar-videos">SIMILAR ANNOUNCEMENTS</h3>';
   } elseif ($category == "i-am-a-mainframer") {
       echo '<h3 class="simlar-videos">SIMILAR PODCASTS</h3>';
   } elseif (
       $category == "techstrongtv" ||
       ($category == "making-our-strong-community-stronger-initiative" ||
           $category == "tfir-partnership")
   ) {
       echo '<h3 class="simlar-videos">SIMILAR VIDEOS</h3>';
   } else {
       echo '<h3 class="simlar-videos">SIMILAR BLOGS</h3>';
   }

   $args = [
       "posts_per_page" => 5,
       "category_name" => $category,
   ];
   $last_5_posts_query = new WP_Query($args);
   while ($last_5_posts_query->have_posts()):
       $last_5_posts_query->the_post();
       $link = get_permalink();
       $title = get_the_title();
       $content .= '<div class="latest-posts">';
       $content .= "<a href=" . $link . ">" . $title . "</a>";
       $content .= "</div>";
   endwhile;
   echo $content;
   ?>
		</div><!--/span_9-->
		
      </div><!--/post-content-->
  
    </div><!--/inner-wrap-->
  
</article>
