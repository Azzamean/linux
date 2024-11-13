<?php
class MembersAPIGrid
{
    public function __construct()
    {
        add_action("init", [$this, "members_api_grid_vc_linux"], 99999);
    } 

    public function members_api_grid_vc_linux()
    {
        if (function_exists("vc_map")) :
            vc_map(
                [
                "name" => esc_html__(
                    "Members API Grid - Linux Foundation Designed",
                    "members_api_grid"
                ),
                "base" => "members_api_grid_linux_foundation",
                "icon" => "vc_element-icon icon-wpb-recent-posts",
                "class" => "",
                "category" => esc_html__("Linux Foundation", "members_api_grid"),
                "description" => esc_html__(
                    "Display carousel of member logos.",
                    "members_api_grid"
                ),
                "params" => [
                    [
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__(
                            "Members API URL",
                            "members_api_grid"
                        ),
                        "param_name" => "members_url",
                        "value" => "",
                        "description" => esc_html__(
                            "Enter the URL for the members API",
                            "members_api_grid"
                        ),
                        "save_always" => true,
                    ],
                    [
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Columns", "members_api_grid"),
                        "param_name" => "columns",
                        "value" => [
                            esc_html__("4 columns", "members") => "4",
                            esc_html__("5 columns", "members") => "5",
                            esc_html__("6 columns", "members") => "6",
                        ],
                        "description" => esc_html__(
                            "Please select the number of columns you want displayed",
                            "members"
                        ),
                        "save_always" => true
                    ],
                ],
                ]
            );
        endif;
    }
}

$members_api_grid = new MembersAPIGrid();
function members_api_grid_linux($atts, $content)
{
    extract(
        shortcode_atts(
            [
                "members_url" => "",
                "columns" => "",
            ],
            $atts
        )
    );

    $columns = !empty($columns) ? $columns : "4";

    switch ($columns) {
    case "4":
        $column_class = "mg-4";
        break;
    case "5":
        $column_class = "mg-5";
        break;
    case "6":
        $column_class = "mg-6";
        break;           
    default:
        $column_class = "mg-4";
        break;
    }

    $members_url = !empty($members_url) ? $members_url : "";

    if ($members_url != null || $members_url != "") {
        $url = $members_url; 
        $jsonData = file_get_contents($url);
        if ($jsonData === false) {
            die("Error fetching JSON data.");
        }
        $data = json_decode($jsonData, true);
        if ($data === null) {
            die("Error decoding JSON data.");
        }
        
        $output .= '<div class="members-grid-outer"> <div class="members-grid-inner"><div id="members-grid" class="members-grid ' . $column_class . '">';

        foreach ($data as $user):
            $logoURL = $user['Logo'];
            if ($logoURL != null) {   
                $output .= '<div class="members-grid-item">';
                $output .= '<img class="membersLogo" src="'. $logoURL . '"/>';       
                $output .= '</div>';
            }
        endforeach;
        $output .= '</div></div></div>';     
    }
    return $output;
}

add_shortcode("members_api_grid_linux_foundation", "members_api_grid_linux");
