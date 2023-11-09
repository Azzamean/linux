<?php

function yocto_enqueue_styles()
{
    wp_enqueue_style(
        "yocto-style",
        get_stylesheet_directory_uri() . "/sites/yocto/yocto.css",
        "",
        nectar_get_theme_version()
    );
}
add_action("wp_enqueue_scripts", "yocto_enqueue_styles", 100);

/* PARSE GRAVITY FORM SUBMISSION TO POPULATE METADATA FOR ORGANIZATION */
add_action(
    'gform_advancedpostcreation_post_after_creation_2',
    'apc_serialize_checkboxes',
    10,
    4
);
function apc_serialize_checkboxes($post_id, $feed, $entry, $form)
{
    // Checkboxes field id.
    $field_id = 11;

    // Get field object.
    $field = GFAPI::get_field($form, $field_id);

    if ($field->type == 'checkbox') {
        // Get a comma separated list of checkboxes checked
        $checked = $field->get_value_export($entry);

        // Convert to array.
        $values = explode(', ', $checked);
    }

    update_post_meta($post_id, 'services_provided', $values);
}

function list_consultants()
{
    $queryArgs = [
        'post_type' => 'consultant',
        'post_status' => 'publish',
        'posts_per_page' => 999,
        'order' => 'ASC',
        'orderby' => 'title'
    ];

    $query = new WP_Query($queryArgs);
    if (!$query->have_posts()) {
        return;
    }

    ob_start();
    ?>
    <table class="consultants">
        <thead>
            <tr>
                <th>Consultant</th>
                <th>Location</th>
                <th>Organization</th>
                <th>Services</th>
            </tr>
        </thead>
<?php
while ($query->have_posts()) {

    $query->the_post();
    $country = wp_get_post_terms(get_the_ID(), 'country');
    $country_name = '';
    if ($country) {
        $country_name = $country[0]->name;
    }
    $services = get_field('services_provided');
    ?>
        <tr>
            <td><?php echo get_field('contact_name'); ?></td>
            <td><?php echo $country_name; ?></td>
            <td><a class="external" target="_blank" href="<?php echo get_field(
                'company_website'
            ); ?>"><?php echo the_title(); ?></a></td>
            <td>
                <ul class="consultant-services">
                <?php foreach ($services as $s) {
                    echo '<li>' . $s . '</li>';
                } ?>
                </ul>
            </td>
        </tr>
        <?php
}
echo "</table>";
wp_reset_query();
$block_content = ob_get_clean();
return $block_content;
}
add_shortcode('list-consultants', 'list_consultants');

function list_jobs()
{
    $queryArgs = [
        'post_type' => 'job',
        'post_status' => 'publish',
        'posts_per_page' => 999,
        'order' => 'DESC',
        'orderby' => 'date'
    ];

    $query = new WP_Query($queryArgs);
    if (!$query->have_posts()) {
        return '<p>🪄This looks like the perfect spot for your job listing. Add one today! We wish you the best of luck in your search!</p>';
    }

    ob_start();
    ?>
    <div class="jobs">
<?php
while ($query->have_posts()) {

    $query->the_post();
    $country = wp_get_post_terms(get_the_ID(), 'country');
    $country_name = '';
    if ($country) {
        $country_name = $country[0]->name;
    }
    ?>
        <a target="_blank" href="<?php echo get_field('job_url'); ?>">
        <div id="fws_65361d118561f" data-midnight="" data-column-margin="default" class="job wpb_row vc_row-fluid vc_row inner_row  vc_custom_1698045001143" style=""><div class="row-bg-wrap"> <div class="row-bg"></div> </div><div class="row_col_wrap_12_inner col span_12  left">
            <div class="vc_col-sm-3 wpb_column column_container vc_column_container col child_column no-extra-padding inherit_tablet inherit_phone " data-padding-pos="all" data-has-bg-color="false" data-bg-color="" data-bg-opacity="1" data-animation="" data-delay="0">
            <div class="vc_column-inner"><div class="wpb_wrapper"><div class="img-with-aniamtion-wrap " data-max-width="100%" data-max-width-mobile="default" data-shadow="none" data-animation="none">
            <div class="inner"><div class="hover-wrap"><div class="hover-wrap-inner">
                <?php the_post_thumbnail(); ?>
            </div></div></div></div></div></div></div> 

            <div class="vc_col-sm-6 wpb_column column_container vc_column_container col child_column no-extra-padding inherit_tablet inherit_phone " data-padding-pos="all" data-has-bg-color="false" data-bg-color="" data-bg-opacity="1" data-animation="" data-delay="0">
            <div class="vc_column-inner"><div class="wpb_wrapper"><div class="wpb_text_column wpb_content_element "><div class="wpb_wrapper">
                <h4><?php the_title(); ?></h4>
                <p><span class="job-company"><?php echo get_field(
                    'company'
                ); ?></span> <span class="job-country"><?php echo $country_name; ?><span></p>
            </div></div></div></div></div> 

            <div class="vc_col-sm-3 wpb_column column_container vc_column_container col child_column no-extra-padding inherit_tablet inherit_phone " data-padding-pos="all" data-has-bg-color="false" data-bg-color="" data-bg-opacity="1" data-animation="" data-delay="0">
            <div class="vc_column-inner"><div class="wpb_wrapper"><div class="wpb_text_column wpb_content_element ">
            <div class="wpb_wrapper">
                <p><?php echo get_the_date('F j'); ?></p>
            </div></div></div> </div></div> 
        </div></div>
        </a>



        <?php
}
echo "</div>";
wp_reset_query();
$block_content = ob_get_clean();
return $block_content;
}
add_shortcode('list-jobs', 'list_jobs');
