<?php

namespace com\cminds\searchwidget\plugin\options;

use com\cminds\searchwidget\App;
use com\cminds\searchwidget\plugin\helpers\ViewHelper;

class Options {

    private static $defaultOptions = array(
        'label_title_open' => 'Search for Glossary Terms',
        'label_title_closed' => 'Site Glossary',
        'label_search_no_results' => 'Sorry, but nothing matched your search terms.',
        'label_search_placeholder' => 'Search ...',
        'widget_color' => '#0099FF',
        'widget_icon_color' => '#FFFFFF',
        'widget_icon_bg_color' => '#0099FF',
        'widget_icon_opened' => 0,
        'widget_icon_closed' => 0,
        'widget_icon_size' => 50,
        'widget_placement' => 'BL',
        'number_of_results' => 10,
        'show_content' => 1,
        'show_on_homepage' => 1,
        'show_on_glossary_page' => 1,
        'show_on_post_types' => array('glossary'),
        'show_powered_by' => 1,
        'show_icon' => 0,
        'pass_query_by_reference' => 1,
    );

    public function __construct() {
        add_action('init', array($this, 'actionInit'));
        add_action('admin_menu', array($this, 'actionAdminMenu'), 20);
    }

    public function actionInit() {
        if (isset($_POST[sprintf('%s_action_update', App::PREFIX)]) && isset($_POST['nonce']) && is_admin()) {
            if (wp_verify_nonce($_POST['nonce'], sprintf('%s_action_update', App::PREFIX))) {
                foreach ($_POST as $k => $v) {
                    $this->updateOption($k, $v);
                }
            }
        }
        if (isset($_POST[sprintf('%s_action_restore_defaults', App::PREFIX)]) && isset($_POST['nonce']) && is_admin()) {
            if (wp_verify_nonce($_POST['nonce'], sprintf('%s_action_restore_defaults', App::PREFIX))) {
                foreach (static::$defaultOptions as $k => $v) {
                    static::deleteOption($k);
                }
            }
        }
    }

    public function actionAdminMenu() {
        add_submenu_page(App::SLUG, 'Options', 'Options', 'manage_options', App::SLUG, array($this, 'displayOptionsPage'));
        //add_menu_page(App::PLUGIN_NAME_EXTENDED, App::PLUGIN_NAME_EXTENDED, 'manage_options', sprintf('%s-options', App::PREFIX), array($this, 'displayOptionsPage'), 'dashicons-testimonial');
    }

    public function displayOptionsPage() {
        $content = ViewHelper::load('views/backend/options/options.php');
        echo ViewHelper::load('views/backend/options/template.php', array(
            'nav' => $this->nav(),
            'content' => $content)
        );
    }

    public static function getOption($option) {
        if (static::isValidOption($option)) {
            return get_option(sprintf('%s_%s', App::PREFIX, $option), static::$defaultOptions[$option]);
        } else {
            return NULL;
        }
    }

    public static function updateOption($option, $value) {
        if (static::isValidOption($option)) {
            return update_option(sprintf('%s_%s', App::PREFIX, $option), $value);
        } else {
            return FALSE;
        }
    }

    private static function deleteOption($option) {
        if (static::isValidOption($option)) {
            return delete_option(sprintf('%s_%s', App::PREFIX, $option));
        }
    }

    public static function isValidOption($option) {
        return key_exists($option, static::$defaultOptions);
    }

    private static function nav() {
        global $self, $parent_file, $submenu_file, $plugin_page, $typenow, $submenu;
        $submenus = array();

        $menuItem = App::SLUG;

        if (isset($submenu[$menuItem])) {
            $thisMenu = $submenu[$menuItem];

            foreach ($thisMenu as $sub_item) {
                $slug = $sub_item[2];

                // Handle current for post_type=post|page|foo pages, which won't match $self.
                $self_type = !empty($typenow) ? $self . '?post_type=' . $typenow : 'nothing';

                $isCurrent = FALSE;
                $subpageUrl = get_admin_url('', 'admin.php?page=' . $slug);

                if ((!isset($plugin_page) && $self == $slug) || (isset($plugin_page) && $plugin_page == $slug && ($menuItem == $self_type || $menuItem == $self || file_exists($menuItem) === false))) {
                    $isCurrent = TRUE;
                }

                $url = (strpos($slug, '.php') !== false || strpos($slug, 'http') !== false) ? $slug : $subpageUrl;
                $isExternalPage = strpos($slug, 'http') !== FALSE;
                $submenus[] = array(
                    'link' => $url,
                    'title' => $sub_item[0],
                    'current' => $isCurrent,
                    'target' => $isExternalPage ? '_blank' : ''
                );
            }
        }
        return ViewHelper::load('views/backend/options/nav.php', array('submenus' => $submenus));
    }

    /**
     * 	Media Uploader
     */
    public static function _image_uploader($name) {
        wp_enqueue_media();
        $hasThumb   = '';
        $image_src  = '';
        $style      = '';
        $image      = self::getOption($name);
        $src        = wp_get_attachment_image_src($image, array(50, 50), false);
        if( !empty($image) ){
            $hasThumb = 'cmtt_hasThumb';
        }
        if( !empty($src) ){
            $image_src = $src[0];
            $style = 'style="background-image:url(\'' . $image_src . '\')"';
        }

        $q = '
            <div id="' . $name . '-preview" class="cmtt_Media_Image ' . $hasThumb . '" ' . $style . '></div>
			<input id="' . $name . '" class="' . $name . ' cmtt_Media_Storage" name="' . $name . '" type="hidden" value="' . $image . '" />
			<input class="upload_image_button cminds_link" id="_btn" type="button" value="Upload" />
			<input class="remove_image_button cminds_link" id="_btn" type="button" value="Remove" data-input="' . $name . '" />
		';
        return $q;
    }

}
