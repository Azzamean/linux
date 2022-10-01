<?php


function nectar_get_social_media_list() {
        $social_networks = array(
		    'github'        => array(
                'icon_class' => 'fa-github-alt',
                'icon_code'  => '\f113',
                'icon_type'  => 'font-awesome',
            ),
			            'discord'       => array(
                'icon_class' => 'icon-salient-discord',
                'icon_code'  => '\e90c',
                'icon_type'  => 'salient',
            ),
			            'email'         => array(
                'icon_class' => 'fa-envelope',
                'icon_code'  => '\f0e0',
                'icon_type'  => 'font-awesome',
            ),            
			'twitter'       => array(
                'icon_class' => 'fa-twitter',
                'icon_code'  => '\f099',
                'icon_type'  => 'font-awesome',
            ),            
			'linkedin'      => array(
                'icon_class' => 'fa-linkedin',
                'icon_code'  => '\f0e1',
                'icon_type'  => 'font-awesome',
            ),
		    'facebook'      => array(
                'icon_class' => 'fa-facebook',
                'icon_code'  => '\f09a',
                'icon_type'  => 'font-awesome',
            ),
            'telegram'      => array(
                'icon_class' => 'fa-telegram',
                'icon_code'  => '\f2c6',
                'icon_type'  => 'font-awesome',
            ),
            'youtube'       => array(
                'icon_class' => 'fa-youtube-play',
                'icon_code'  => '\f16a',
                'icon_type'  => 'font-awesome',
            ),
        );
        return $social_networks;
    }