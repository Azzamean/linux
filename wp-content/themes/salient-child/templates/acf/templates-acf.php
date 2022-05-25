<?php

// PROJECTS ACF'S
$banner = get_field("projects_banner");
$excerpt = get_field("projects_excerpt");
$description = get_field("projects_description");
$details = get_field("projects_details");
$logo = get_field("projects_logo");
$white_logo = get_field("projects_white_logo");
$logo_header = get_field("use_logo_instead_of_header_text");
$icon_banner = get_field("icon_banner");
$website = get_field("projects_website");
$github = get_field("projects_github");
$mailing_list = get_field("projects_mailing_list");
$lfx_insights = get_field("projects_lfx_insights_link");
$lfx_security = get_field("projects_lfx_security_link");
$wiki = get_field("projects_wiki_link");
$roadmap = get_field("projects_roadmap");
$contributions = get_field("projects_contributions");
$calendar = get_field("projects_calendar");
$documentation = get_field("projects_documentation");

// STORE IN MULTIDIMESIONAL ARRAY
$projects_links = [
    "website_icon" => [
        "url" => $website,
        "name" => "Website",
        "icon" => "fa fa-firefox",
    ],
    "github_icon" => [
        "url" => $github,
        "name" => "Github",
        "icon" => "fa fa-github",
    ],
    "mailing_list_icon" => [
        "url" => $mailing_list,
        "name" => "Mailing List",
        "icon" => "fa fa-envelope-o",
    ],
    "lfx_insights_icon" => [
        "url" => $lfx_insights,
        "name" => "LFX Insights",
        "icon" => "fa fa-bar-chart",
    ],
    "lfx_security_icon" => [
        "url" => $lfx_security,
        "name" => "LFX Security",
        "icon" => "fa fa-shield",
    ],
    "wiki_icon" => [
        "url" => $wiki,
        "name" => "Wiki",
        "icon" => "fa fa-wikipedia-w",
    ],
    "road_map_icon" => [
        "url" => $roadmap,
        "name" => "Roadmap",
        "icon" => "fa fa-map-o",
    ],
    "contributions_icon" => [
        "url" => $contributions,
        "name" => "Contributions",
        "icon" => "fa fa-handshake-o",
    ],
    "calendar_icon" => [
        "url" => $calendar,
        "name" => "Calendar",
        "icon" => "fa fa-calendar",
    ],
    "documentation_icon" => [
        "url" => $documentation,
        "name" => "Documentation",
        "icon" => "fa fa-file-text-o",
    ],
];


// WEBINARS ACF'S
$webinarDescription = get_field("webinars_description");
$slides = get_field("webinars_slides");
$video = get_field("webinars_video");