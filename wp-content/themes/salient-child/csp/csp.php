<?php
// GET HOSTNAME/DOMAIN COMPONENT OF THE SITE URL WITHOUT PATHS, SCHEMA, ETC...
//echo 'THIS IS THE DOMAIN ' . parse_url( get_site_url(), PHP_URL_HOST );

// CONDITIONAL LOGIC FOR CONTENT SECURITY POLICY BASED OFF DOMAIN NAME
$domain_name = parse_url( get_site_url(), PHP_URL_HOST );
switch ($domain_name) {
    case "dev-openssf.pantheonsite.io":
	case "openssf.org":
        require_once "sites/ossf.php";
        break;
	default:
       add_action("send_headers", "default_security_headers");
}

// DEFAULT SECURITY HEADERS IF NO SITE IS IN CONDITION
function default_security_headers() {
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
if ( class_exists( 'Tribe__Main' ) ) {
	remove_action( 'wp_footer', array( Tribe__Main::instance(), 'toggle_js_class' ) );
}

// CREATE A NONCE FOR CSP; THIS IS A TEMPORARY FIX USING 3423fsdf3kj34j
function generate_custom_nonce(){
    //$created_nonce = wp_create_nonce();
	$created_nonce = '3423fsdf3kj34j';
    return $created_nonce;
}

// ADD THE NONCE TO INLINE SCRIPTS
function add_nonce_to_scripts( $attr ) {
	if ( 'text/javascript' !== $attr['type'] ) {
		return $attr;
	}
	return array(
		'type' => 'text/javascript',
		'nonce' => generate_custom_nonce(),
	);
}
add_filter( 'wp_inline_script_attributes', 'add_nonce_to_scripts', 1, 1 );

// ADD THE NONCE TO CALLED SCRIPTS
function script_tag_nonce( $tag, $handle ) {
if ( $handle != 'grab_all_ids' || $handle == null || !($handle)) {
        //$nonce = wp_create_nonce(); // Or whatever your nonce value should be
        $tag = str_replace( '<script ', "<script nonce='" . generate_custom_nonce() . "' ", $tag );
    } 

    return $tag;
}
add_filter( 'script_loader_tag', 'script_tag_nonce', 10, 2 );
