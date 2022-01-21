<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);

function salient_child_enqueue_styles() {
		
		$nectar_theme_version = nectar_get_theme_version();
		wp_enqueue_style( 'salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version );
		
    if ( is_rtl() ) {
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
		}
}

// TOP LINUX FOUNDATION PROJECTS HEADER BANNER STRIP
add_action('nectar_hook_after_body_open', 'lf_meta_header', 10, 0);
function lf_meta_header()
{
    echo '
  	<div class="lfprojects">
		<div class="container">
			<a href="https://www.linuxfoundation.org/projects" target="_blank" rel="noopener noreferrer"><img src="http://dev-lfprojects3.pantheonsite.io/wp-content/uploads/2022/01/lfprojects_banner.png"></a>
		</div>
	</div>
';
}



?>