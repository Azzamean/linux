<?php

/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if (!defined("ABSPATH"))
{
    exit();
}

if ($query->have_posts())
{
    while ($query->have_posts())
    {

        $query->the_post();

        // GET THE GLOBAL VARIABLES
        include get_stylesheet_directory() . "/custom-post-types/exchange/exchange_variables.php";
?>
				
		<!-- RESULT BOX -->
		<div class="results-information">

		<div class="section-results group-results top-results">
		<!-- FIRST COLUMN -->
			<div class="col-results span_2_of_3-results">		
			<h2 class="results-title">
			<?php echo $exchange_offering_name; ?>
			</h2>		
		<!-- EXCHANGE IMAGE LOGIC -->
		<?php if (!empty($exchange_image))
        {	?>
			<img class="results-image" src="<?php echo $exchange_image; ?>">
			<?php
        }
		
		elseif (!empty($exchange_product_image))
		{	?>
			<img class="results-image" src="<?php echo $exchange_product_image; ?>">
			<?php
        }
		
        else
        { ?>
			<!-- <img class="results-image" src="/wp-content/uploads/2021/03/placeholder.png"> -->
			<?php
        } ?>
		<!-- END OF EXCHANGE IMAGE LOGIC -->
			<?php if ($exchange_organization != null) { ?><p><strong>Organization:</strong> <?php echo $exchange_organization; ?></p><?php } ?>
			<?php if ($exchange_offering_description != null) { ?><p><?php echo $exchange_offering_description; ?></p><?php } ?>
			<?php if ($exchange_license_type != null) { ?> <p><strong>License Type:</strong> <?php $license_type = '';$license_types = $exchange_license_type;if ($license_types) {$license_type = implode(', ', $license_types);} echo "$license_type"; ?> </p><?php } ?>
			<?php if ($exchange_core_type != null) { ?> <p><strong>Software Type:</strong> <?php $core_type = '';$core_types = $exchange_core_type;if ($core_types) {$core_type = implode(', ', $core_types);} echo "$core_type"; ?> </p><?php } ?>
			<?php if ($exchange_user_spec != null) { ?> <p><strong>Software Type:</strong> <?php $exchange_user_spec = '';$user_specs = $exchange_user_spec;if ($user_specs) {$exchange_user_spec = implode(', ', $user_specs);} echo "$exchange_user_spec"; ?> </p><?php } ?>
			<?php if ($exchange_software_type != null) { ?> <p><strong>Software Type:</strong> <?php $software_type = '';$software_types = $exchange_software_type;if ($software_types) {$software_type = implode(', ', $software_types);} echo "$software_type"; ?> </p><?php } ?>
			<?php if ($exchange_learn_language != null) { ?> <p><strong>Learn Language:</strong> <?php $learn_language = '';$learn_languages = $exchange_learn_language;if ($learn_languages) {$learn_language = implode(', ', $learn_languages);} echo "$learn_language"; ?> </p><?php } ?>	
			</div>
		<!-- END OF FIRST COLUMN -->
		<!-- SECOND COLUMN -->
			<div class="col-results span_1_of_3-results vertical-middle"></div>
		<!-- END OF SECOND COLUMN -->	
		</div>
			
		<div class="section-results group-results bottom-results">		
			<div class="col-results span_1_of_2-results bottom-results-left">
			
<?php
        $exchange_category = get_field('exchange_category');
        if ($exchange_category):

            foreach ($exchange_category as $term):
                $name = $term->name;
                if ($name == 'Board' || $name == 'Hardware')
                {
                    $name = 'Hardware';
                    $color = '#0A3799';
                }
                if ($name == 'Core' || $name == 'Cores' || $name == 'SOC' || $name == 'SOC Platforms')
                {
                    $name = 'Cores';
                    $color = '#FFC72C';
                }
                if ($name == 'Software')
                {
                    $name = 'Software';
                    $color = '#0A6B7C';
                }
                if ($name == 'Services')
                {
                    $name = 'Services';
                    $color = '#62cbc9';
                }
                if ($name == 'Learning')
                {
                    $name = 'Learning';
                    $color = '#FDDA64';
                }
            endforeach;

        endif;
?>			
			<div class="results-category" style="background-color:<?php echo $color ?>"><?php echo $name ?></div>
			</div>
			<div class="col-results span_1_of_2-results bottom-results-right">
			<a class="results-page" href="<?php echo $exchange_links; ?>" target="_blank" >Learn More</a>
			</div>
		</div>
		
		<!-- END OF RESULT BOX -->
		</div>
		 
		<?php
    }
}
else
{
    echo "No Results Found";
}
?>