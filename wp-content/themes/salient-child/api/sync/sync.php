<?php
/*
function sync_api()
{
    function getdata()
    {
        $url = file_get_contents('https://scan.sv-1.global.canton.network.sync.global/api/scan/v0/scans');
        $data = json_decode($url, true);
        return $data;
    }
    
    $data = getdata();
    foreach ($data['scans'] as $items) {
        $length = count($items['scans']);
        $html = "<ul>";
        foreach ($items['scans'] as $scan) {
            $html .= "<li>" . $scan['publicUrl'] . "</li>";
        }
        $html .= "</ul>";
    }
    
    return $html;
}
add_shortcode('sync_api_shortcode', 'sync_api');
*/


function sync_api()
{
    // Client
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_URL, "https://scan.sv-1.global.canton.network.sync.global/api/scan/v0/scans");
curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
    $data = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);

if ($curl_errno > 0) {
    echo "cURL Error ($curl_errno): $curl_error\n";
} else {
    echo "Data received: $data\n";
}

}
add_shortcode('sync_api_shortcode', 'sync_api');


