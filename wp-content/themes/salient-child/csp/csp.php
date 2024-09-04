<?php
// GET HOSTNAME/DOMAIN COMPONENT OF THE SITE URL WITHOUT PATHS, SCHEMA, ETC...
//echo 'THIS IS THE DOMAIN ' . parse_url( get_site_url(), PHP_URL_HOST );

// CONDITIONAL LOGIC FOR CONTENT SECURITY POLICY BASED OFF DOMAIN NAME
$domain_name = parse_url(get_site_url(), PHP_URL_HOST);
switch ($domain_name) {
    case "ms-csp-openssf.pantheonsite.io":
    case "dev-openssf.pantheonsite.io":
    case "openssf.org":
        require_once "sites/ossf.php";
        break;
	default:
       add_action("send_headers", "default_security_headers");
}

// DEFAULT SECURITY HEADERS IF NO SITE IS IN CONDITION
function default_security_headers()
{
    //header("Content-Security-Policy: default-src * self blob: data: gap:; style-src * self 'unsafe-inline' blob: data: gap:; script-src * 'self' 'unsafe-eval' 'unsafe-inline' blob: data: gap:; object-src * 'self' blob: data: gap:; img-src * self 'unsafe-inline' blob: data: gap:; connect-src self * 'unsafe-inline' blob: data: gap:; frame-src * self blob: data: gap:;");
    header("Content-Security-Policy: connect-src http://ip-api.com/ 'self' https: data:");
    header("Strict-Transport-Security: max-age=31536000");
    header("X-XSS-Protection: 1; mode=block");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("Referrer-Policy: no-referrer-when-downgrade");
    header('Permissions-Policy: geolocation=(self "https://example.com") microphone=() camera=()');
}

// REMOVE TRIBE THAT CANNOT BE GRABBED BY A NONCE
if (class_exists('Tribe__Main') ) {
    remove_action('wp_footer', array( Tribe__Main::instance(), 'toggle_js_class' ));
}

// CREATE A NONCE FOR CSP; THIS IS A TEMPORARY FIX USING 3423fsdf3kj34j
function generate_custom_nonce()
{
    static $created_nonce = null;

    if ($created_nonce === null) {
        //$created_nonce = '3423fsdf3kj34j';
        $created_nonce = wp_create_nonce('lfcsp');
    }
    return $created_nonce;
}

// ADD THE NONCE TO INLINE SCRIPTS
function add_nonce_to_scripts( $attr )
{
    if ('text/javascript' !== ($attr['type'] ?? '') ) {
        return $attr;
    }

    $attr['type'] = 'text/javascript';
    $attr['nonce'] = generate_custom_nonce();
    return $attr;
}
add_filter('wp_inline_script_attributes', 'add_nonce_to_scripts', 1, 1);
add_filter('wp_script_attributes', 'add_nonce_to_scripts', 1, 1);
add_filter( 'wp_script_attributes', 'add_nonce_to_scripts', 1, 1 );

// ADD THE NONCE TO CALLED SCRIPTS
function script_tag_nonce( $tag, $handle )
{
    if ($handle != 'grab_all_ids' || $handle == null || !($handle) ) {
        // 'grab_all_ids' is just so the jQuery handle grabs every ID since that ID shouldn't / probably does not exist
        $tag = str_replace('<script ', "<script nonce='" . generate_custom_nonce() . "' ", $tag);
    } 
    return $tag;
}
//add_filter( 'script_loader_tag', 'script_tag_nonce', 10, 2 );

/**
 * Replace static CSP nonce
 */
add_action('template_redirect', 'lf_capture_start', 0);
function lf_capture_start()
{
    ob_start('lf_htmlsource_replnonce');
}

add_action('shutdown', 'lf_capture_stop', 1000); //wp_print_footer_scripts - too late or used by other caching plugins?
function lf_capture_stop()
{
    ob_end_flush();
}

function lf_htmlsource_replnonce($buffer)
{
    //get generated nonce to replace static nonce
    $nonce = 'nonce="' . generate_custom_nonce() . '"';
    //<script type="text/javascript">(window.NREUM
    $buffer = str_replace(['<script type="text/javascript">', '<script>'], '<script type="text/javascript" ' . $nonce . '>', $buffer);
    return str_replace(['nonce="3423fsdf3kj34j"', "nonce='3423fsdf3kj34j'"], $nonce, $buffer);
}

// OSANO CODE FOR TRACKING
function osano_script_global()
{
    ?>
<script src="https://cmp.osano.com/16A0DbT9yDNIaQkvZ/3b49aaa9-15ab-4d47-a8fb-96cc25b5543c/osano.js" integrity="sha384-Gw4evf0QRTGuxQbOvn8v28Z0xyAt9tLT0U3dtOCvUoy+bIDmPA3TL2L4idZr7Fav" crossorigin="anonymous"></script>
    <?php
}
