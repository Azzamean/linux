<?php

namespace com\cminds\searchwidget\plugin\helpers;

use com\cminds\searchwidget\App;

class HTMLHelper {

    public static function inputColor($name, $value = '#FFFFFF', $arr = array()) {
        $cssClassName = sprintf('%s-input-color', App::PREFIX);
        if (isset($arr['class'])) {
            $arr['class'] = $arr['class'] . " {$cssClassName}";
        } else {
            $arr['class'] = $cssClassName;
        }
        $arr = array_merge(array(
            'size' => '40',
            'aria-required' => 'false',
            'id' => uniqid('id')
                ), $arr);
        array_walk($arr, function(&$v, $k) {
            $v = sprintf('%s="%s"', $k, $v);
        });
        self::enqueueInputColorAssets();
        return sprintf('<input name="%s" type="text" value="%s" %s />', $name, esc_attr($value), implode(' ', $arr));
    }

    public static function enqueueInputColorAssets() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script(sprintf('%s-backend-color-picker', App::PREFIX), plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/color-picker.js', array('wp-color-picker'), App::VERSION);
        wp_enqueue_style('cmsw-admin-style', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/css/style.css');
    }

    public static function inputFontSize($name, $value = NULL, $arr = array()) {
        $arr = array_merge(array(
            'placeholder' => 'e.g. 16px or 1.1em',
            'size' => '40',
            'aria-required' => 'false',
            'id' => uniqid('id')
                ), $arr);
        array_walk($arr, function(&$v, $k) {
            $v = sprintf('%s="%s"', $k, $v);
        });
        return sprintf('<input name="%s" type="text" value="%s" %s />', $name, esc_attr($value), implode(' ', $arr));
    }

}
