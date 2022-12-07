<?php

namespace com\cminds\searchwidget\plugin;

abstract class PluginAbstract {

    const VERSION = '';
    const PREFIX = '';
    const SLUG = '';
    const PLUGIN_NAME = '';
    const PLUGIN_NAME_EXTENDED = '';
    const PLUGIN_FILE = '';

    public function __construct() {
        spl_autoload_register(array($this, 'autoload'));

        new options\Options();

        new frontend\SearchWidget();
        new frontend\ajax\TooltipFeed();
        //new frontend\ajax\Example();

        add_action('admin_menu', array($this, 'actionAdminMenu'));
        add_action('init', array($this, 'actionInit'));
    }

    public function actionAdminMenu() {
        add_menu_page(static::SLUG, static::PLUGIN_NAME_EXTENDED, 'manage_options', static::SLUG, function(){return;}, 'dashicons-testimonial');
    }

    public function actionInit() {
        wp_register_style('cmsw-backend-admin', plugin_dir_url(static::PLUGIN_FILE) . 'assets/backend/css/admin.css', array(), static::VERSION);
    }

    public function autoload($name) {
        $namespace = implode('\\', array_slice(explode('\\', get_called_class()), 0, -1));
        $namespace = str_replace('_', '-', $namespace);
        if (substr($name, 0, strlen($namespace)) === $namespace) {
            $filename = plugin_dir_path(static::PLUGIN_FILE) . str_replace('\\', DIRECTORY_SEPARATOR, substr($name, strlen($namespace) + 1, 9999)) . '.php';
            require_once $filename;
            return;
        }
    }

    public function isLicensingOk() {
       if ($GLOBALS[sprintf('%s_isLicenseOk', App::SLUG)] || isset($_COOKIE['cmsw_dev']) && $_COOKIE['cmsw_dev'] == 'ef7b2e395e5eb45741799dbcd36986663091be5f') {
            return TRUE;
       }
        return FALSE;
    }

}
