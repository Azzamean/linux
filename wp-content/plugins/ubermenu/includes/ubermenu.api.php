<?php

function ubermenu( $config_id = 'main' , $args = array() ){
	$args = ubermenu_get_nav_menu_args( $args , 'api' , $config_id );
	return wp_nav_menu( $args );
}


function ubermenu_toggle( $target = '_any_' , $config_id = 'main' , $echo = true , $args = array() ){

	extract( wp_parse_args( $args , array(
		'toggle_content'	=> 'Menu',
		'icon_class'		=> 'bars',
		'tag'				=> 'a',
		'skin'				=> '',
		'toggle_id'			=> '',
		'content_align'		=> 'left',
		'align'				=> 'full',
		'close_icon'		=> 'bars',
		'classes'			=> '',
		'tabindex'			=> "0",
	)));

	//responsive_toggle_text

	if( !$skin && $config_id ){
		$skin = ubermenu_op( 'skin' , $config_id );
	}

	$class = 'ubermenu-responsive-toggle';
	if( $config_id ) $class.= ' ubermenu-responsive-toggle-'.$config_id;
	if( $skin ) $class.= ' ubermenu-skin-'.$skin;
	if( isset( $args['theme_location'] ) )$class.= ' ubermenu-loc-'.sanitize_title( $args['theme_location'] );
	$class.= ' ubermenu-responsive-toggle-content-align-'.$content_align;
	$class.= ' ubermenu-responsive-toggle-align-'.$align;
	if( !$toggle_content ) $class.= ' ubermenu-responsive-toggle-icon-only';
	if( $close_icon !== 'bars' ) $class.= " ubermenu-responsive-toggle-close-icon-$close_icon";

	$id = '';
	if( $toggle_id ) $id = ' id="'.$toggle_id.'" ';

	$class.= ' '.$classes;
	$class = apply_filters( 'ubermenu_toggle_class' , $class , $config_id );

	$aria = '';
	if( ubermenu_op( 'aria_responsive_toggle' , 'general' ) == 'on' ){
		$aria = ' role="button" aria-controls="'.$target.'" ';
	}

	$toggle = '<'.$tag . $aria . $id.' class="'.$class.'" tabindex="'.$tabindex.'" data-ubermenu-target="'.
				$target.'">';

	if( $icon_class ){

		$aria = '';

		if( ubermenu_op( 'aria_hidden_icons' , 'general' ) == 'on' ){	//TODO deprecate
			$aria = 'aria-hidden="true"';
		}

		if( ubermenu_op( 'use_core_svgs', 'general' ) === 'on' ){
			$toggle.= ubermenu_get_essential_icon( 'bars', $aria );
			if( $close_icon !== 'bars' ) $toggle.= ubermenu_get_essential_icon( 'times', $aria );
		}
		else{
			$toggle_icon_tag = ubermenu_op( 'icon_tag' , $config_id );
			if( !$toggle_icon_tag ) $toggle_icon_tag = 'i';
			$toggle.= '<'.$toggle_icon_tag.' class="fas fa-'.$icon_class.'" '.$aria.'></'.$toggle_icon_tag.'>';
		}

	}
	if( $toggle_content ) $toggle.= do_shortcode( $toggle_content );
	$toggle.= '</'.$tag.'>';

	if( $echo ) echo $toggle;
	return $toggle;
}



function ubermenu_toggle_shortcode( $atts, $content ){

	extract( shortcode_atts( array(
		'instance_id'	=> '',
		'config_id'		=> 'main',
		'target' 		=> '_any_',
		'toggle_id' 	=> '',
		'tag'			=> 'a',
		'icon_class'	=> 'bars',
		'close_icon' 	=> 'bars',
		'skin'			=> '',
	), $atts, 'ubermenu_toggle' ) );

	//If an instance_id (deprecated) was passed, use it as the config_id
	if( $instance_id != '' ) $config_id = $instance_id;

	$args = array();
	if( $content ) $args['toggle_content'] = $content;
	$args['icon_class']		= $icon_class;
	$args['tag']			= $tag;
	$args['skin']			= $skin;

	$toggle = ubermenu_toggle( $target , $config_id , false , $args );

	return $toggle;
}
add_shortcode( 'ubermenu_toggle' , 'ubermenu_toggle_shortcode' );



function uberMenu_direct( $theme_location = 'ubermenu' , $filter = true , $echo = true , $args = array() , $config_id = 'main' ){
	$args['theme_location'] = $theme_location;
	$args['filter'] = $filter;
	$args['echo'] = $echo;

	return ubermenu( $config_id , $args );
}

function uberMenu_easyIntegrate( $config_id = 'main' , $args = array() ){

	//Check that Easy Integration is enabled
	if( ubermenu_op( 'ubermenu_theme_location' , 'general' ) != 'on' ){
		$msg = 'To use Easy Integration, please enable the <strong>Register Easy Integration UberMenu Theme Location</strong> setting in the <a target="_blank" href="'.admin_url( 'themes.php?page=ubermenu-settings').'">UberMenu Control Panel > General Settings > Advanced</a> and <a target="_blank" href="'.admin_url( 'nav-menus.php?action=locations' ).'">assign a menu</a> to the <strong>UberMenu [Easy Integration]</strong> theme locaiton';
		ubermenu_admin_notice( $msg );
		return;
	}

	//Check that the theme location has been assigned
	else if( !has_nav_menu( 'ubermenu' ) ){
		$msg = 'To use Easy Integration, please <a target="_blank" href="'.admin_url( 'nav-menus.php?action=locations' ).'">assign a menu</a> to the <strong>UberMenu [Easy Integration]</strong> theme location';
		ubermenu_admin_notice( $msg );
		return;
	}


	//$args = array();
	$args['theme_location'] = 'ubermenu';
	return ubermenu( $config_id , $args );
}
