<?php

namespace com\cminds\searchwidget\plugin\frontend;

use com\cminds\searchwidget\App;
use com\cminds\searchwidget\plugin\options\Options;

class SearchWidget {

    public function __construct() {

        add_action('wp', function () {
            if ($this->isVisible()) {
                $this->enqueueScript();
                $this->enqueueStyle();
            }
        });
    }

    private function isVisible() {
        if (is_admin()) {
            return FALSE;
        }
        if (is_front_page() && Options::getOption('show_on_homepage')) {
            return TRUE;
        }
        if (Options::getOption('show_on_glossary_page') && get_the_ID() == get_option('cmtt_glossaryID', -1)) {
            return TRUE;
        }
        if (!is_front_page() && get_post_type() && in_array(get_post_type(), Options::getOption('show_on_post_types'))) {
            return TRUE;
        }
        return FALSE;
    }

    private function enqueueScript() {
        $icon_open = wp_get_attachment_image_src(Options::getOption('widget_icon_opened'), array(50, 50), false);
        $icon_close = wp_get_attachment_image_src(Options::getOption('widget_icon_closed'), array(50, 50), false);
        wp_enqueue_script('underscore', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/underscore-min.js', array('jquery'));
        wp_enqueue_script('ba-throttle-debounce', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/jquery.ba-throttle-debounce.js', array('jquery'));
        wp_enqueue_script('cmsw', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/js/search-widget.js', array('jquery', 'ba-throttle-debounce', 'underscore'));
        wp_localize_script('cmsw', '_cmsw_search_widget_config', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'baseurl' => plugin_dir_url(App::PLUGIN_FILE),
            'labels' => array(
                'title_open' => Options::getOption('label_title_open'),
                'title_closed' => Options::getOption('label_title_closed'),
                'powered_by' => Options::getOption('show_powered_by') ? sprintf('powered by <strong>%s</strong> plugin', App::PLUGIN_NAME_EXTENDED) : '',
                'search_no_results' => Options::getOption('label_search_no_results'),
                'search_placeholder' => Options::getOption('label_search_placeholder')
            ),
            'options' => array(
                'color' => Options::getOption('widget_color'),
                'icon_color' => Options::getOption('widget_icon_color'),
                'icon_bg_color' => Options::getOption('widget_icon_bg_color'),
                'icon_size' => Options::getOption('widget_icon_size'),
                'icon_open' => !empty($icon_open) ? $icon_open[0] : 0,
                'icon_close' =>!empty($icon_close) ? $icon_close[0] : 0,
                'placement' => Options::getOption('widget_placement'),
                'show_content' => Options::getOption('show_content'),
                'show_icon' => Options::getOption('show_icon')
            )
        ));
    }

    private function enqueueStyle() {
        wp_enqueue_style('cmsw-style', plugin_dir_url(App::PLUGIN_FILE) . 'assets/frontend/css/style.css');
        if (Options::getOption('show_icon')){
            wp_enqueue_style('dashicons');
        }
    }

}
