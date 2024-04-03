<?php

// OSSF HEADERS POLICY
function security_headers( array $headers = array() ): array {
    $headers['Access-Control-Allow-Methods']             = 'GET,POST';
    $headers['Access-Control-Allow-Headers']             = 'Content-Type, Authorization';
    $headers['Content-Security-Policy']                  = hsts_plugin_get_csp_header();
    $headers['Cross-Origin-Embedder-Policy']             = "unsafe-none; report-to='default'";
    $headers['Cross-Origin-Embedder-Policy-Report-Only'] = "unsafe-none; report-to='default'";
    $headers['Cross-Origin-Opener-Policy']               = 'unsafe-none';
    $headers['Cross-Origin-Opener-Policy-Report-Only']   = "unsafe-none; report-to='default'";
    $headers['Cross-Origin-Resource-Policy']             = 'cross-origin';
    $headers['Permissions-Policy']                       = 'browsing-topics=(), accelerometer=(), autoplay=(), camera=(), cross-origin-isolated=(), display-capture=(self), encrypted-media=(), fullscreen=*, geolocation=(self), gyroscope=(), keyboard-map=(), magnetometer=(), microphone=(), midi=(), payment=*, picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), sync-xhr=(), usb=(), xr-spatial-tracking=(), gamepad=(), serial=()';
    $headers['Referrer-Policy']                          = 'strict-origin-when-cross-origin';
    $headers['Strict-Transport-Security']                = 'max-age=63072000; includeSubDomains; preload';
    $headers['X-Content-Security-Policy']                = 'default-src \'self\'; img-src *; media-src * data:;';
    $headers['X-Content-Type-Options']                   = 'nosniff';
    $headers['X-Frame-Options']                          = 'SAMEORIGIN';
    $headers['X-XSS-Protection']                         = '1; mode=block';
    $headers['X-Permitted-Cross-Domain-Policies']        = 'none';
    return $headers;
}
add_filter( 'wp_headers', 'security_headers' );

// OSSF CONTENT SECURITY POLICY
function hsts_plugin_get_csp_header(): string {
    $csp =
	"default-src 'none'; " .
	"script-src 'self' 'nonce-3423fsdf3kj34j' *.hsforms.net *.hs-scripts.com *.googletagmanager.com *.google.com *.osano.com " . 	
		"*.usemessages.com *.hubspot.com *.hsadspixel.net *.hs-analytics.net *.hscollectedforms.net *.hsleadflows.net *.hs-banner.com *.facebook.net " .
		"*.buzzsprout.com;" .
	"style-src 'unsafe-inline' 'self' fonts.googleapis.com *.osano.com;" .
	"object-src 'self' *.osano.com; " .
	"base-uri 'self'; " .
	"connect-src 'self' *.hsforms.com *.hscollectedforms.net analytics.google.com *.google-analytics.com *.hubspot.com *.doubleclick.net *.hubapi.com " .
		"*.linkedin.com *.osano.com; " .
	"font-src 'self' data: fonts.gstatic.com; " .
	"frame-src 'self' *.osano.com *.hsforms.com *.youtube.com *.google.com *.openssf.org *.landscape2.io *.buzzsprout.com;" .
	"img-src 'self' data: *.hsforms.com *.hubspot.com *.hubspot.net *.ads.linkedin.com secure.gravatar.com *.w.org *.google.com *.google-analytics.com  *.facebook.com; " . 
	"manifest-src 'self'; " .
	"media-src 'self'; " .
	//"report-uri ; " .
	"worker-src blob: *.osano.com; " .
	"frame-ancestors 'self'; " .
	"form-action 'self' *.hsforms.com; ";
    return empty($csp) ? '' : $csp;
}