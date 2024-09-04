<?php

// ADD SALIENT CUSTOM FONTS

function salient_redux_custom_fonts()
{
    return [
        "Custom Fonts" => [

            "Bitter" => "Bitter",
            "Montserrat" => "Montserrat",
            "Open Sans" => "Open Sans",
            "Roboto" => "Roboto",
            "Roboto Slab" => "Roboto Slab",
            "Source Sans Pro" => "Source Sans Pro",
            "Work Sans" => "Work Sans",
            "Inter" => "Inter",
            "Fira Sans" => "Fira Sans",
            "Ubuntu" => "Ubuntu",
            "Ubuntu-Light" => "Ubuntu-Light",
            "Cairo" => "Cairo",
            "IBM Plex Sans" => "IBM Plex Sans",
            "Nunito Sans" => "Nunito Sans",
            "Archivo" => "Archivo",
            "Lato" => "Lato",
        ]
    ];
}

function check_font_loading()
{
    global $salient_redux;
    if($salient_redux['default-theme-font'] === 'from_theme') {
        add_filter(
            "redux/salient_redux/field/typography/custom_fonts",
            "salient_redux_custom_fonts"
        );
    }
}
add_action(
    "init",
    "check_font_loading"
);
