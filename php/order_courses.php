<?php
if(isset($_POST['name'])){

    // logout api
    require_once 'link.php';

    $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
    $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
    date_default_timezone_set("Asia/Calcutta");
    $date_now = urlencode(date("d-m-Y"));

    $type = urlencode($_POST['type']);
    $name = urlencode($_POST['name']);
    $mobile_no = urlencode($_POST['mobile_no']);
    $address = urlencode($_POST['address']);
    $city = urlencode($_POST['city']);
    $state = urlencode($_POST['state']);
    $pincode = urlencode($_POST['pincode']);
    $ref_id = urlencode($_POST['ref_id']);
    $course_id = urlencode($_POST['course_id']);
    $amount = urlencode($_POST['amount']);

    $url = $link.'/api/v1/order_courses?name='.$name.'&phonenumber='.$mobile_no.'&address='.$address.'&city='.$city.'&state='.$state.'&pincode='.$pincode.'&referral_id='.$ref_id.'&from_ip='.$from_ip.'&from_browser='.$from_browser.'&amount='.$amount.'&payment_type='.$type.'&product_id='.$course_id.'';
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