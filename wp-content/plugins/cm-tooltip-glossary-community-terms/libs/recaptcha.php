<?php

class CMTCT_Recaptcha {

    public static $response = '';
    const POST_RESPONSE = 'g-recaptcha-response';
    const VERIFY_URL    = 'https://www.google.com/recaptcha/api/siteverify';

    public static function init() {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue'));
    }
    
    public static function enqueue(){
        wp_enqueue_script( 'cmr-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), false, true );
    }

    static function getWrapper() {
        return '<div class="g-recaptcha" data-sitekey="' . esc_attr( static::getSiteKey() ) . '"></div>';
    }

    static function getScript() {
        ob_start();
        ?>
        <script>
            function cmCaptcha( token ) {
                jQuery('.g-recaptcha').parents('form').submit();
            }
        </script>
        <?php
        $content = ob_get_clean();
        return $content;
    }

    static function getAtts() {
        return 'class="g-recaptcha" data-sitekey="' . esc_attr( static::getSiteKey() ) . '" data-callback="cmCaptcha"';
    }

    static function getSiteKey() {
        return \CM\CMTT_Settings::get( CMTooltipCommunityTermsBackend::COMMUNITYTERMS_CAPTCHA_KEY );
    }

    static function getSecretKey() {
        return \CM\CMTT_Settings::get( CMTooltipCommunityTermsBackend::COMMUNITYTERMS_CAPTCHA_PRIVATE_KEY );
    }

    static function isConfigured() {
        $key    = self::getSiteKey();
        $secret = self::getSecretKey();
        return (!empty( $key ) AND ! empty( $secret ));
    }

    static function verify( $code = null, $remoteIp = null ) {
        if ( empty( $code ) ) {
            $code = filter_input( INPUT_POST, self::POST_RESPONSE );
        }
        if ( empty( $remoteIp ) ) {
            $remoteIp = self::getRemoteIP();
        }

        $data = array(
            'secret'   => self::getSecretKey(),
            'response' => $code,
            'remoteip' => $remoteIp,
        );

        $result = self::postRequest( self::VERIFY_URL, $data );
        $result = json_decode( $result, true );
        if ( $result AND $result[ 'success' ] ) {
            return true;
        } else {
            self::$response = $result;
            return false;
        }
    }

    static function getRemoteIP() {
        $ip = null;
        if ( !empty( $_SERVER[ 'HTTP_CLIENT_IP' ] ) ) {
            //check ip from share internet
            $ip = $_SERVER[ 'HTTP_CLIENT_IP' ];
        } elseif ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
            //to check ip is pass from proxy
            $ip = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
        } else {
            $ip = $_SERVER[ 'REMOTE_ADDR' ];
        }
        return $ip;
    }

    static function postRequest( $url, $data ) {
        $postdata = http_build_query( $data );

        $opts = array( 'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 60,
            )
        );

        $context = stream_context_create( $opts );

        return file_get_contents( $url, false, $context );
    }

}
