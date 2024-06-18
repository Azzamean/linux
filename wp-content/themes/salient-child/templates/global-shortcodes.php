<?php
function global_shortcode()
{
    // GRABS SPECIFIC SUBSITES
    $current_multisite = network_home_url();
    $multisite_three_dev = "https://dev-lfprojects3.linuxfoundation.org";
    $multisite_three_live = "https://live-lfprojects3.linuxfoundation.org";
    $multisite_five_dev = "https://dev-lfprojects5.linuxfoundation.org";
    $multisite_five_live = "https://live-lfprojects5.linuxfoundation.org";
    $site_id;
    if ((is_multisite() && $current_multisite == $multisite_three_dev) || (is_multisite() && $current_multisite == $multisite_three_live)) {
        $site_id = get_current_blog_id();
    }
    switch ($site_id) {
            // CCC
            
    case "10":
        $selected_shortcode = do_shortcode('[nectar_global_section id="115"]');
        break;
            // OMP
            
    case "14":
        $selected_shortcode = do_shortcode('[nectar_global_section id="7879"]');
        break;
            // LF Network
            
    case "18":
        $selected_shortcode = do_shortcode('[nectar_global_section id="6806"]');
        break;
            // LF Edge
            
    case "24":
        $selected_shortcode = do_shortcode('[nectar_global_section id="164"]');
        break;
    }
    return $selected_shortcode;
}
