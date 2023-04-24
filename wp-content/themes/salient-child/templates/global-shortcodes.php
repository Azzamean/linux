<?php

function global_shortcode()
{
    // GRABS SPECIFIC SUBSITES
    if (is_multisite()) {
        $site_id = get_current_blog_id();
    }
    switch ($site_id) {	
        // CCC
        case "10":
            $selected_shortcode = do_shortcode(
                '[nectar_global_section id="115"]'
            );
            break;		
        // OMP
        case "14":
            $selected_shortcode = do_shortcode(
                '[nectar_global_section id="7879"]'
            );
            break;
        // LF Network
        case "18":
            $selected_shortcode = do_shortcode(
                '[nectar_global_section id="6806"]'
            );
            break;		
    }
    return $selected_shortcode;
}
