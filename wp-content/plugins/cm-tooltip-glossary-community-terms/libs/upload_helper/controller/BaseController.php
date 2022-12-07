<?php

namespace com\cminds\wp\common\upload_helper\v_1_0_2\controller;

/**
 *
 *
 */
abstract class BaseController {

    protected $pluginFile;
    protected $pluginPrefix;
    protected $pluginPath;
    protected $pluginUrl;

    function __construct( $pluginFile, $pluginPrefix ) {

        $this->pluginFile   = $pluginFile;
        $this->pluginPrefix = $pluginPrefix;
        $this->pluginPath   = dirname( $pluginFile );
        $this->pluginUrl    = plugins_url( '', $pluginFile );
    }

    function loadView( $_viewPath, $_params = array() ) {
        if ( file_exists( $_viewPath ) ) {
            extract( $_params );
            ob_start();
            include $_viewPath;
            return ob_get_clean();
        } else {
            trigger_error( '[' . $this->pluginPrefix . '] View not found: ' . $_viewPath, E_USER_WARNING );
        }
    }

    function getLibraryVersion() {
        preg_match( '~\\\\v_([0-9]+_[0-9]+_[0-9]+)\\\\~', __NAMESPACE__, $match );
        return str_replace( '_', '.', $match[ 1 ] );
    }

    function path( $path = '' ) {
        return trailingslashit( $this->getLibraryPathPart() ) . $path;
    }

    function prefix( $value ) {
        return $this->pluginPrefix . $value;
    }

    function getLibraryPathPart() {
        $dir_path = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        return $dir_path;
    }

    function getLibraryUrlPart() {
        return plugins_url( '/../', __FILE__ );
    }

    function url( $url ) {
        $res = trailingslashit( $this->getLibraryUrlPart() ) . $url;
        return $res;
    }

}
