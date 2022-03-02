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

//$templateFile = get_page_template_slug(get_queried_object_id());if ($templateFile == null){echo "This is the default template";}else{echo "This is the template file: " . $templateFile;}
get_header();

?>

<div class="container-wrap projects-wrap">
   <div class="container main-content">
      <div class="full-width-section">
         <div class="row-bg-wrap">
            <div class="inner-wrap">
               <div class="row-bg projects-background" style="background-image: url(<?php echo get_field('projects_banner'); ?>);"></div>
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
               <?php echo get_field('projects_description'); ?>
            </section>
            <section class="projects-links">
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_website'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-firefox" aria-hidden="true"></i>
               </a>			
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_github'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-github" aria-hidden="true"></i>
               </a>
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_mailing_list'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-envelope-o" aria-hidden="true"></i>
               </a>			
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_lfx_insights_link'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-bar-chart" aria-hidden="true"></i>
               </a>
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_lfx_security_link'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-shield" aria-hidden="true"></i>
               </a>
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_wiki_link'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-wikipedia-w aria-hidden="true"></i>
               </a>			
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_roadmap'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-map-o" aria-hidden="true"></i>
               </a>
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_contributions'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-handshake-o" aria-hidden="true"></i>
               </a>	
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_calendar'); ?>">
               <span class="screen-reader-text">github</span>
               <i class="fa fa-calendar" aria-hidden="true"></i>
               </a>
               <a target="_blank" rel="noopener" href="<?php echo get_field('projects_documentation'); ?>">
               <span class="screen-reader-text">documentation</span>
               <i class="fa fa-text-o" aria-hidden="true"></i>
               </a>	
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
