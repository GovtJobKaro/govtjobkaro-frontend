<?php

if(isset($_POST['search'])){

    $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
    $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
    date_default_timezone_set("Asia/Calcutta");
    $date_now = urlencode(date("d-m-Y"));

    $keyword = urlencode($_POST['search']);

    require_once 'link.php';
    $url = $link.'/api/v1/all_test_series_search?search='.$keyword.'';

    $request_url = $url ;

    $curl = curl_init($request_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    
    "Content-Type: application/json"
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $obj = json_decode($response, true);
    echo json_encode($obj);
}

?>