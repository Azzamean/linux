<?php
class ProjectsAPI
{
    public function __construct()
    {
        add_action("init", [$this, "projects_api_vc_linux"], 99999);
    }

    public function projects_api_vc_linux()
    {
        if (function_exists("vc_map")):
            vc_map([
                "name" => esc_html__(
                    "Projects API Carousel - Linux Foundation Designed",
                    "projects_api"
                ),
                "base" => "projects_api_linux_foundation",
                "icon" => "vc_element-icon icon-wpb-recent-posts",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "projects_api"),
                "description" => esc_html__(
                    "Display carousel of hosted projects logos.",
                    "projects_api"
                ),
                "params" => [
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__(
                            "Hosted Projects API URL",
                            "projects_api"
                        ),
                        "param_name" => "hosted_projects_url",
                        "value" => "",
                        "description" => esc_html__(
                            "Enter the URL for the Hosted Projects API URL",
                            "projects_api"
                        ),
                        "save_always" => true,
                    ],
					[
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__(
                            "Projects Items API URL",
                            "projects_api"
                        ),
                        "param_name" => "projects_items_url",
                        "value" => "",
                        "description" => esc_html__(
                            "Enter the URL for the Projects Items API URL",
                            "projects_api"
                        ),
                        "save_always" => true,
                    ],
                ],
            ]);
        endif;
    }
}

$projects_api = new ProjectsAPI();
function projects_api_linux($atts, $content)
{
    extract(
        shortcode_atts(
            [
                "hosted_projects_url" => "",
				"projects_items_url" => "",
            ],
            $atts
        )
    );

    $hosted_projects_url = !empty($hosted_projects_url) ? $hosted_projects_url : "";
    $projects_items_url = !empty($projects_items_url) ? $projects_items_url : "";


    if (($hosted_projects_url != null || $hosted_projects_url != "") && ($projects_items_url != null || $projects_items_url != "")) {
        $output .=
            '<script type="text/javascript">
			var hosted_projects_url="' . $hosted_projects_url . '";
			var projects_items_url="' . $projects_items_url . '";
			</script>';
        $output .=
            '<script type="text/javascript" src="/wp-content/themes/salient-child/vc-addons/js/projects-api.js"></script>';
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

add_shortcode("projects_api_linux_foundation", "projects_api_linux");
