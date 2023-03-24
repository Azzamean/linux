<?php

// STYLE SIMPLE BANNER
function simple_banner_head()
{
    ?>
	<style type="text/css">
	@media only screen and (min-width: 768px) {
		#header-outer {
			margin-top: 80.4px !important;
		}

		.simple-banner {
			margin-top: 33px;
		}
	}

	@media only screen and (max-width: 600px) {

		div#header-outer,
		.ocm-effect-wrap-inner {
			margin-top: 76px !important;
		}

		body[data-slide-out-widget-area-style=slide-out-from-right] .slide_out_area_close {
			top: 110px;
			z-index: 11;
		}
	}
	</style>
	<?php if (is_user_logged_in()) { ?>
		<style type="text/css">
		#wpadminbar {
			position: fixed;
		}

		</style>
		<?php }
}

// CHECK IF SIMPLE BANNER PLUGIN IS ACTIVATED
if (
    in_array(
        "simple-banner/simple-banner.php",
        apply_filters("active_plugins", get_option("active_plugins"))
    )
) {
    add_action("wp_head", "simple_banner_head");
}
