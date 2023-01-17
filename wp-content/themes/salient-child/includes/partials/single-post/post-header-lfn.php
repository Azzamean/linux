<div id="page-header-wrap" data-animate-in-effect="none" data-midnight="light" class="" style="height: 550px;">

   <div id="page-header-bg" class="not-loaded  hentry" data-post-hs="default_minimal" data-padding-amt="normal" data-animate-in-effect="none" data-midnight="light" data-text-effect="" data-bg-pos="center" data-alignment="left" data-alignment-v="middle" data-parallax="0" data-height="550" style="height:550px;">
      <div class="page-header-bg-image-wrap" id="nectar-page-header-p-wrap" data-parallax-speed="fast">
         <div class="page-header-bg-image"></div>
      </div>
      <div class="container">
        <div class="row">
            <div class="col span_6 section-title blog-title" data-remove-post-date="0" data-remove-post-author="0" data-remove-post-comment-number="1">
               <div class="inner-wrap">
                  
			
				  <?php
$categories = get_the_category();
if (!empty($categories))
{
    $output = null;
    foreach ($categories as $category)
    {
        $output .= '<a class="' . esc_attr($category->slug) . '" href="' . esc_url(get_category_link($category->term_id)) . '" >' . esc_html($category->name) . '</a>';
    }
    echo apply_filters('nectar_blog_page_header_categories', trim($output));
}
?>
				 		<h1 class="entry-title"><?php the_title(); ?></h1>
							
							
									<div id="single-below-header" data-hide-on-mobile="<?php echo esc_attr($using_fixed_salient_social); ?>">
										<?php echo '<span class="meta-author vcard author"><span class="fn"><span class="author-leading">' . esc_html__('By', 'salient') . '</span> ' . get_the_author_posts_link() . '</span></span>';
$date_functionality = (isset($nectar_options['post_date_functionality']) && !empty($nectar_options['post_date_functionality'])) ? $nectar_options['post_date_functionality'] : 'published_date';

if ('1' !== $remove_single_post_date)
{
    if ('last_editied_date' === $date_functionality)
    {
        echo '<span class="meta-date date updated"><i>' . get_the_modified_date() . '</i></span>';
    }
    else
    {
        $nectar_u_time = get_the_time('U');
        $nectar_u_modified_time = get_the_modified_time('U');
        if ($nectar_u_modified_time >= $nectar_u_time + 86400)
        {
            echo '<span class="meta-date date published">' . get_the_date() . '</span>';
            echo '<span class="meta-date date updated rich-snippet-hidden">' . get_the_modified_time(__('F jS, Y', 'salient')) . '</span>';
        }
        else
        {
            echo '<span class="meta-date date updated">' . get_the_date() . '</span>';
        }
    }
}

?>
									</div><!--/single-below-header-->
               </div>
            </div>
            <!--/section-title-->
         </div>
         <!--/row-->
      </div>
   </div>
</div>