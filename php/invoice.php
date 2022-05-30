<?php

if(isset($_POST['order_id'])){

    $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
    $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
    date_default_timezone_set("Asia/Calcutta");
    $date_now = urlencode(date("d-m-Y"));

    $order_id = urlencode($_POST['order_id']);

    require_once 'link.php';

    $url = $link.'/api/v1/invoice?order_courses_id='.$order_id.'';
    // $url = 'https://api.govtjobkaro.com/api/v1/invoice?order_courses_id=acd1bd77-b062-4177-a79e-5c03ff11b12c';

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