<?php

namespace com\cminds\searchwidget\plugin\helpers;

use com\cminds\searchwidget\App;

class ViewHelper {

    public static function load($filename, $data = array()) {
        ob_start();
        extract($data, EXTR_SKIP);
        include plugin_dir_path(App::PLUGIN_FILE) . $filename;
        return ob_get_clean();
    }

}
