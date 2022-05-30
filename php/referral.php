<?php
if(isset($_POST['course_id'])){

    $course_id = $_POST['course_id'];
    $coupon_name = $_POST['coupon_name'];
    require_once 'link.php';

    $url = $link.'/api/v1/apply_discount_coupon?course_id=' . $course_id . '&coupon_name=' . $coupon_name;
    $request_url = $url ;

    $curl = curl_init($request_url);

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