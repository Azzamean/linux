<?php


$domain_name = parse_url(get_site_url(), PHP_URL_HOST);
switch ($domain_name) {
case "omfp.dev-lfprojects3.linuxfoundation.org":
case "openmainframeproject.org":
    include_once "results-omfp.php";
    break;
case "dev-riscv.pantheonsite.io":
case "riscv.org":
    include_once "results-riscv.php";
    break;
default:
    include_once "results-default.php";
}
