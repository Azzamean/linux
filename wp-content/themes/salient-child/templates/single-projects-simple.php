<?php

/**
 * Template Name: Projects Template - Simple Style
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

//$templateFile = get_page_template_slug(get_queried_object_id());if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}
get_header();

?>

<div class="container-wrap projects-wrap">
   <div class="container main-content">
      <div class="full-width-section">
         <div class="row-bg-wrap">
            <div class="inner-wrap">
               <div class="row-bg projects-background" style="background-image: url(<?php echo $banner ?>);"></div>
            </div>
         </div>
         <div class="hentry projects-heading">
            <div class="col span_12 section-title projects-title">
               <h1 class="entry-title" style="color:#ffffff;" ><?php the_title(); ?></h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="projects-post-area col">
            <section class="projects-description">
               <?php echo $description ?>
            </section>
			
            <section class="projects-links">
			<?php foreach ($projects_links as $link)
{
    if ($link['url'] != null)
    { ?>

			<a target="_blank" rel="noopener" href="<?php echo $link['url'] ?>"><span class="screen-reader-text"><?php echo $link['name'] ?></span><i class="<?php echo $link['icon'] ?>" aria-hidden="true"></i></a>

			<?php
    }
} ?>	  
            </section>
			
			<section class="projects-details">
			<?php echo $details ?>
			</section>
			
         </div>
         <!--/post-area-->
      </div>
      <!--/row-->
   </div>
   <!--/container main-content-->
</div>
<!--/container-wrap-->

<?php get_footer(); ?>
