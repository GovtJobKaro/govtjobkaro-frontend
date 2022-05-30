<?php

if(isset($_POST['name'])){
 
    $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
    $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
    date_default_timezone_set("Asia/Calcutta");
    $date_now = urlencode(date("d-m-Y"));

    $type = urlencode($_POST['type']);
    $name = urlencode($_POST['name']);
    $mobile = urlencode($_POST['mobile']);

    require_once 'link.php';
    // register api
    $url = $link.'/api/v1/register?full_name='.$name.'&mobile_no='.$mobile.'&user_type='.$type.'&device='.$from_browser.'&ip_address='.$from_ip.'&time='.$date_now.'';
    
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
// }else if(isset($_POST['mobileNo'])){
//     $mobile = $_POST['mobileNo'];
//     $otp = $_POST['otp'];

//     // login api
//     $url = 'http://134.209.155.102/api/v1/verify?mobile_no='.$mobile.'&otp='. $otp .'';
//     $request_url = $url ;

//     $curl = curl_init($request_url);

//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($curl, CURLOPT_HTTPHEADER, [
//     'X-RapidAPI-Host: kvstore.p.rapidapi.com',
//     'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
//     'Content-Type: application/json'
//     ]);

//     $response = curl_exec($curl);
//     curl_close($curl);

//     $obj = json_decode($response, true);
//     echo json_encode($obj);
}

?>
