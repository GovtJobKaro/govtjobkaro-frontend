<?php

if(isset($_POST['returning_customer']) == "false"){

    $returning_customer = urlencode($_POST['returning_customer']);
    $ref_id = urlencode($_POST['ref_id']);
    $course_id = urlencode($_POST['course_id']);
    
    require_once 'link.php';
    // login api
    $url = $link.'/api/v1/user_referral?course_id='. $course_id .'&user_referral_code='. $ref_id .'&revisiting='. $returning_customer .'';

    $request_url = $url ;

    $curl = curl_init($request_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "X-RapidAPI-Host: kvstore.p.rapidapi.com",
    "X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx",
    "Content-Type: application/json"
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $obj = json_decode($response, true);
    echo json_encode($obj);
}else if(isset($_POST['returning_customer']) == "true"){

    $returning_customer = urlencode($_POST['returning_customer']);
    $ref_id = urlencode($_POST['ref_id']);
    $course_id = urlencode($_POST['course_id']);
    
    require_once 'link.php';
    // login api
    $url = $link.'/api/v1/user_referral?course_id='. $course_id .'&user_referral_code='. $ref_id .'&revisiting='. $returning_customer .'';
    $request_url = $url ;

    $curl = curl_init($request_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    
    'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $obj = json_decode($response, true);
    echo json_encode($obj);
}

?>
