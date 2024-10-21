<?php

$nonce = generate_custom_nonce();
// OSSF HEADERS POLICY
function security_headers( array $headers = array() ): array
{
    $headers['Access-Control-Allow-Origin']             = '*';
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
add_filter('wp_headers', 'security_headers');

// OSSF CONTENT SECURITY POLICY
function hsts_plugin_get_csp_header(): string
{
    $nonce = generate_custom_nonce();
    $csp =
    "default-src 'none'; " .
    "script-src 'nonce-" . $nonce . "' 'strict-dynamic';" .
    "script-src-elem 'self' 'nonce-" . $nonce . "' *.hsforms.net *.hs-scripts.com *.googletagmanager.com *.google.com *.osano.com " .     
        "*.hubspot.com *.hsadspixel.net *.hscollectedforms.net *.hsleadflows.net *.hs-banner.com *.facebook.net " .
        "js.zi-scripts.com ws.zoominfo.com tags.clickagy.com ws-assets.zoominfo.com schedule.zoominfo.com api.schedule.zoominfo.com  *.buzzsprout.com snap.licdn.com " .
        "*.google-analytics.com *.hs-analytics.net *.usemessages.com googleads.g.doubleclick.net js-agent.newrelic.com https://www.googletagmanager.com https://googletagmanager.com https://tagmanager.google.com; " .
    "style-src 'unsafe-inline' 'self' fonts.googleapis.com https://googletagmanager.com https://tagmanager.google.com https://fonts.googleapis.com *.osano.com; " .
    "object-src 'self' *.osano.com; " . // todo: able to switch this to 'none'?
    "base-uri 'self'; " . // todo: able to switch this to 'none'?
    "connect-src 'self' js.zi-scripts.com *.hsforms.com *.hscollectedforms.net analytics.google.com *.google-analytics.com *.hubspot.com *.doubleclick.net *.hubapi.com " .
        "*.linkedin.com *.osano.com aorta.clickagy.com  hemsync.clickagy.com ws.zoominfo.com api.schedule.zoominfo.com *.googleadservices.com www.googletagmanager.com *.google.com js-agent.newrelic.com; " .
    "font-src 'self' data: fonts.gstatic.com; " .
    "frame-src 'self' *.osano.com *.hsforms.com *.youtube.com *.google.com *.openssf.org *.landscape2.io *.buzzsprout.com aorta.clickagy.com hemsync.clickagy.com *.doubleclick.net zoom-lfx.platform.linuxfoundation.org; " .
    "img-src 'self' data: *.buzzsprout.com *.hsforms.com *.hubspot.com *.hubspot.net *.linkedin.com *.ads.linkedin.com secure.gravatar.com *.w.org *.google.com *.google-analytics.com  *.facebook.com " . 
    "*.linuxfoundation.org https://googletagmanager.com https://www.googletagmanager.com https://ssl.gstatic.com https://www.gstatic.com https://fonts.gstatic.com;" .
    "manifest-src 'self'; " .
    "media-src 'self'; " .
    //"report-uri ; " .
    "worker-src blob: *.osano.com; " .
    "frame-ancestors 'self'; " .
    "form-action 'self' *.hsforms.com; " .
    "";
    return empty($csp) ? '' : $csp;
}

/**
 * Sends CSP header on login page
 */
add_action('login_init', 'lf_login_security_headers'); 
function lf_login_security_headers()
{
    header(sprintf('Content-Security-Policy: %s', hsts_plugin_get_csp_header()));
}

// OSANO CODE FOR TRACKING
function osano_script_ossf()
{
    $nonce = generate_custom_nonce();
    ?>
<script src="https://cmp.osano.com/16A0DbT9yDNIaQkvZ/3b49aaa9-15ab-4d47-a8fb-96cc25b5543c/osano.js" nonce="<?php echo $nonce ?>" integrity="sha384-Gw4evf0QRTGuxQbOvn8v28Z0xyAt9tLT0U3dtOCvUoy+bIDmPA3TL2L4idZr7Fav" crossorigin="anonymous"></script>
    <?php
}
//add_action("wp_head", "osano_script_ossf");

function google_tagmanager_script()
{
    $nonce = generate_custom_nonce();
    ?>
<!-- Google Tag Manager -->
<script id="gtmScript" nonce='<?= $nonce ?>'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;var n=d.querySelector('[nonce]');
n&&j.setAttribute('nonce',n.nonce||n.getAttribute('nonce'));f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WGVDPX6');</script>
<!-- End Google Tag Manager -->

<!-- Start of ZoomInfo -->
<script type="text/javascript" nonce="<?php echo $nonce ?>">
window[(function(_gCK,_oT){var _5f='';for(var _Dr=0;_Dr<_gCK.length;_Dr++){_Ey!=_Dr;var _Ey=_gCK[_Dr].charCodeAt();_Ey-=_oT;_Ey+=61;_Ey%=94;_oT>7;_5f==_5f;_Ey+=33;_5f+=String.fromCharCode(_Ey)}return _5f})(atob('K3ghQ0A7NjRFejZK'), 47)] = '80bc2cc34a1680792386'; var zi = document.createElement('script'); (zi.type = 'text/javascript'), (zi.nonce = '<?php echo $nonce ?>'), (zi.async = true), (zi.src = (function(_9lG,_cz){var _8U='';for(var _K5=0;_K5<_9lG.length;_K5++){_8U==_8U;_rF!=_K5;var _rF=_9lG[_K5].charCodeAt();_cz>6;_rF-=_cz;_rF+=61;_rF%=94;_rF+=33;_8U+=String.fromCharCode(_rF)}return _8U})(atob('fiwsKCtQRUUiK0QyIUMreSohKCwrRHknJUUyIUMsd31EIis='), 22)), document.readyState === 'complete'?document.body.appendChild(zi): window.addEventListener('load', function(){ document.body.appendChild(zi) });
</script>
<!-- End of ZoomInfo -->
<?php /*
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" nonce="<?php echo $nonce ?>" async defer src="https://js.hs-scripts.com/8112310.js?businessUnitId=1372240" integrity="sha384-vE1G4Bv7taRZFOw6E6HLhNFPcoqniQfd4wNimLRCoVjhlgKPU1DRPo/GmJvFORZe" crossorigin="anonymous"></script>
<!-- End of HubSpot Embed Code -->

<!-- Start of Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LVETL3DY2Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-LVETL3DY2Q');
</script>
<!-- End of Google tag (gtag.js) -->

    <?php */
}
add_action("wp_head", "google_tagmanager_script");
