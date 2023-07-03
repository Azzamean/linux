jQuery(document).ready(function ($) {

   $("#page_template").change(function () {
      //alert($('#page_template :selected').text());
   });

   $('[data-name="projects_header_excerpt"]').hide();
   $('[data-name="projects_video"]').hide();
   $('[data-name="projects_post_category"]').hide();
   $('[data-name="projects_category"]').hide();
   $('[data-name="projects_case_studies"]').hide();

   if ($('#page_template :selected').text() == 'Default template') {
      $('[data-name="projects_header_excerpt"]').show();
      $('[data-name="projects_video"]').show();
      $('[data-name="projects_post_category"]').show();
   }

   if ($('#page_template :selected').text() == 'Template Style 1 (One)') {

   }

   if ($('#page_template :selected').text() == 'Template Style 2 (Two)') {

   }

   if ($('#page_template :selected').text() == 'Template Stlye 3 (Three)') {
      $('[data-name="projects_category"]').show();
      $('[data-name="projects_case_studies"]').show();
   }

});