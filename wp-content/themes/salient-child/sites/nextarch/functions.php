<?php


// FORCE YOAST DEFAULT 2 FOR SHARING
$default_opengraph = 'https://nextarch.dev-lfprojects3.linuxfoundation.org/wp-content/uploads/sites/15/2022/11/NextArch-social.jpg';
function add_default_opengraph($object){
	global $default_opengraph; 
	$object->add_image($default_opengraph);
}
add_action('wpseo_add_opengraph_images','add_default_opengraph');

