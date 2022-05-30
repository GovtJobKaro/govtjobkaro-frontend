<?php
if(isset($_POST['course_id'])){

    require_once 'link.php';

    $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
    $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
    date_default_timezone_set("Asia/Calcutta");
    $date_now = urlencode(date("d-m-Y"));

    $course_id = urlencode($_POST['course_id']);
    $phonenumber = urlencode($_POST['phonenumber']);

    $url = $link.'/api/v1/get_order_courses?phonenumber='.$phonenumber.'&course_id='.$course_id.'';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
   
    'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $obj = json_decode($response, true);
    echo json_encode($obj);
}

?>