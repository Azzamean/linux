<?php
class MembersAPI
{
    public function __construct()
    {
        add_action("init", [$this, "members_api_vc_linux"], 99999);
    }

    public function members_api_vc_linux()
    {
        if (function_exists("vc_map")):
            vc_map([
                "name" => esc_html__(
                    "Members API - Linux Foundation Designed",
                    "members_api"
                ),
                "base" => "members_api_linux_foundation",
                "icon" => "vc_element-icon icon-wpb-recent-posts",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "members_api"),
                "description" => esc_html__(
                    "Display carousel of member logos.",
                    "members_api"
                ),
                "params" => [
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__(
                            "Members API URL",
                            "members_api"
                        ),
                        "param_name" => "members_url",
                        "value" => "",
                        "description" => esc_html__(
                            "Enter the URL for the members API",
                            "members_api"
                        ),
                        "save_always" => true,
                    ],
                ],
            ]);
        endif;
    }
}

$members_api = new MembersAPI();
function members_api_linux($atts, $content)
{
    extract(
        shortcode_atts(
            [
                "members_url" => "",
            ],
            $atts
        )
    );

    $members_url = !empty($members_url) ? $members_url : "";

    if ($members_url != null || $members_url != "") {
        $output .=
            '<script type="text/javascript">var members_url="' .
            $members_url .
            '";</script>';
        $output .=
            '<script type="text/javascript" src="/wp-content/themes/salient-child/vc-addons/js/members-api.js"></script>';
        $output .=
            '<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.3.15/slick.css">';
        $output .=
            '<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" defer></script>';

        $output .= '<div class="slider container">
				  <div class="slider inside">
					<div id="slider" class="slider right" dir="ltr"></div>
				  </div>
				</div>';
    }

    return $output;
}

add_shortcode("members_api_linux_foundation", "members_api_linux");
