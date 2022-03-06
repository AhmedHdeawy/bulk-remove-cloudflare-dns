<?php

$zoneID = "";
$headers = [
    "X-Auth-Email: youremail@gmail.com",
    "X-Auth-Key: YOUR_API_TOKEN"
];

$dnsListURL = "https://api.cloudflare.com/client/v4/zones/{$zoneID}/dns_records";

$result = postRequestWithCurl($dnsListURL, $headers);

foreach ($result['result'] as $key => $value) {
    $deleteDNSURLl = "https://api.cloudflare.com/client/v4/zones/{$zoneID}/dns_records/{$value['id']}";

    deleteRequestWithCurl($deleteDNSURLl, $headers);
}

function postRequestWithCurl($url, $headers = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($result, true);
}

function deleteRequestWithCurl($url, $headers = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $hd);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);
    curl_close($ch);
}

?>
