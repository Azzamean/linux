<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();

echo do_shortcode(
    '[vc_row type="full_width_background" full_screen_row_position="middle" column_margin="default" column_direction="default" column_direction_tablet="default" column_direction_phone="default" bg_image="214" bg_position="left top" background_image_loading="default" bg_repeat="no-repeat" scene_position="center" top_padding="120" constrain_group_1="yes" bottom_padding="120" text_color="dark" text_align="left" row_border_radius="none" row_border_radius_applies="bg" overflow="visible" overlay_strength="0.3" gradient_direction="left_to_right" shape_divider_position="bottom" bg_image_animation="none" gradient_type="default" shape_type=""][vc_column column_padding="no-extra-padding" column_padding_tablet="inherit" column_padding_phone="inherit" column_padding_position="all" column_element_direction_desktop="default" column_element_spacing="default" desktop_text_alignment="default" tablet_text_alignment="default" phone_text_alignment="default" background_color_opacity="1" background_hover_color_opacity="1" column_backdrop_filter="none" column_shadow="none" column_border_radius="none" column_link_target="_self" column_position="default" gradient_direction="left_to_right" overlay_strength="0.3" width="1/1" tablet_width_inherit="default" animation_type="default" bg_image_animation="none" border_type="simple" column_border_width="none" column_border_style="solid"][vc_custom_heading text="Events and Meetups" font_container="tag:h2|text_align:center|color:%23ffffff" use_theme_fonts="yes" el_class="banner-title"][/vc_column][/vc_row]'
);

echo tribe(Template_Bootstrap::class)->get_view_html();

echo do_shortcode(
    '[vc_row type="in_container" full_screen_row_position="middle" column_margin="default" column_direction="default" column_direction_tablet="default" column_direction_phone="default" scene_position="center" text_color="dark" text_align="left" row_border_radius="none" row_border_radius_applies="bg" overflow="visible" class="events-container top" overlay_strength="0.3" gradient_direction="left_to_right" shape_divider_position="bottom" bg_image_animation="none" gradient_type="default" shape_type=""][vc_column column_padding="no-extra-padding" column_padding_tablet="inherit" column_padding_phone="inherit" column_padding_position="all" column_element_direction_desktop="default" column_element_spacing="default" desktop_text_alignment="default" tablet_text_alignment="default" phone_text_alignment="default" background_color_opacity="1" background_hover_color_opacity="1" column_backdrop_filter="none" column_shadow="none" column_border_radius="none" column_link_target="_self" column_position="default" gradient_direction="left_to_right" overlay_strength="0.3" width="1/1" tablet_width_inherit="default" animation_type="default" bg_image_animation="none" border_type="simple" column_border_width="none" column_border_style="solid"][vc_column_text]These are events where you can learn more about the Open 3D Foundation and Open 3D Engine, either from the Foundation team or from one of our many community members around the world. If you are hosting an event that doesn’t appear here, add your event below. We’ll review your information and if appropriate, will add it to this page.[/vc_column_text][nectar_btn size="large" button_style="regular" button_color_2="Accent-Color" icon_family="none" text="Add an Event" url="https://docs.google.com/forms/d/e/1FAIpQLSeAvt3N9BRxKJlxakRl26gzuRfLtY6Ecwe3YkahD7Jda-qoQw/viewform?vc=0&c=0&w=1&flr=0"][/vc_column][/vc_row][vc_row type="in_container" full_screen_row_position="middle" column_margin="default" column_direction="default" column_direction_tablet="default" column_direction_phone="default" scene_position="center" text_color="dark" text_align="left" row_border_radius="none" row_border_radius_applies="bg" overflow="visible" class="events-container bottom" overlay_strength="0.3" gradient_direction="left_to_right" shape_divider_position="bottom" bg_image_animation="none" gradient_type="default" shape_type=""][vc_column column_padding="no-extra-padding" column_padding_tablet="inherit" column_padding_phone="inherit" column_padding_position="all" column_element_direction_desktop="default" column_element_spacing="default" desktop_text_alignment="default" tablet_text_alignment="default" phone_text_alignment="default" background_color_opacity="1" background_hover_color_opacity="1" column_backdrop_filter="none" column_shadow="none" column_border_radius="none" column_link_target="_self" column_position="default" gradient_direction="left_to_right" overlay_strength="0.3" width="1/1" tablet_width_inherit="default" animation_type="default" bg_image_animation="none" border_type="simple" column_border_width="none" column_border_style="solid"][nectar_global_section id="239"][/vc_column][/vc_row]'
);

get_footer();
