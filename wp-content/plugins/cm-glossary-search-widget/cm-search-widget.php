<?php

/*
  Plugin Name: CM Glossary Search Widget
  Plugin URI: https://www.cminds.com/
  Description: Search Widget AddOn for CM Tooltip Glossary
  Author: CreativeMindsSolutions
  Version: 1.1.0
 */

namespace com\cminds\searchwidget;

if (!class_exists('com\cminds\searchwidget\App')) {

    require_once plugin_dir_path(__FILE__) . 'plugin/PluginAbstract.php';

    class App extends plugin\PluginAbstract {

        const VERSION = '1.1.0';
        const PREFIX = 'cmsw';
        const SLUG = 'cm-search-widget';
        const PLUGIN_NAME = 'Search Widget';
        const PLUGIN_NAME_EXTENDED = 'Glossary Search Widget';
        const PLUGIN_FILE = __FILE__;

    }

    include_once plugin_dir_path(__FILE__) . 'bundle/licensing/cminds-pro.php';

    new App();
} else {
    die('Plugin is already activated.');
}

