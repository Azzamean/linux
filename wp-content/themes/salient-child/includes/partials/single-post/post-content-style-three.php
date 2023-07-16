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

function add_class_previous_post_link($html)
{
    $html = str_replace('<a', '<a class="view-next"', $html);
    return $html;
}
add_filter('previous_post_link', 'add_class_previous_post_link', 10, 1);

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
?>
	<?php if (has_post_thumbnail($post->ID)) { ?>
		<div class="featured-media-under-header__featured-media">
	<?php echo get_the_post_thumbnail($post_id, "full"); ?>
		</div>
	<?php } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="inner-wrap">

		<div class="post-content" data-hide-featured-media="<?php echo esc_attr(
      $hide_featrued_image
  ); ?>">
      
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

		<?php
  echo '<div class="content-inner"' . esc_html($gallery_attr) . ">";
  // Post content.
  if (
      "link" !== $nectar_post_format
  ) { ?><h2 class="entry-title-small"> <?php the_title(); ?></h2> <?php the_content(
    '<span class="continue-reading">' .
        esc_html__("Read More", "salient") .
        "</span>"
);}

  echo "</div>";
  ?>
      		<div class="single-blog-bottom-navigation">
			<a class="back-to-all" href="/blog/">< Back To All Blog Posts</a>
			<!-- <a class="view-next" href="<?php echo $next_post_link_url; ?>">View Next Blog Post ></a> -->
				<?php if (get_adjacent_post(false, "", true)) {
        previous_post_link("%link", "View Next Blog Post >");
    } else {
        $last = new WP_Query("post_type=posts&posts_per_page=1&order=DESC");
        $last->the_post();

        echo '<a class="view-next" href="' .
            get_permalink() .
            '">View Next Blog Post ></a>';
        wp_reset_postdata();
    } ?>
		</div>  
      </div><!--/post-content-->
      
    </div><!--/inner-wrap-->
    
</article>
