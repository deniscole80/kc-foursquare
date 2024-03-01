<?php

function perform_http_request($method, $url, $data = false) {
    $key = 'pt_sk_b067e1645681ee0c7bcbbdb19953a7a800485eb0'; //staging key for collins
    //$key = 'pt_sk_e9dfcd4df1bf3ca81126c87242031dd51464b03d'; //dev key for Niyi
    //$key = 'pt_sk_c87c885209a39e993b25c791f8a6e52da6a6c191'; //production key for Foursquare National Youth Ministry

    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);

            break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$key,
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //If SSL Certificate Not Available, for example, I am calling from http://localhost URL

    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, true);
}
