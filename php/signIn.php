<?php
    require_once 'link.php';

    // login api
    $url = $link.'/api/v1/verify?mobile_no=7009427959&otp=123456';
    $request_url = $url ;

    $curl = curl_init($request_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'X-RapidAPI-Host: kvstore.p.rapidapi.com',
    'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
    'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    
    curl_close($curl);

    $obj = json_decode($response, true);
    echo json_encode($url);
?>