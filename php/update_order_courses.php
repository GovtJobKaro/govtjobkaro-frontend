<?php
if(isset($_POST['razorpay_payment_id'])){

    // logout api
    require_once 'link.php';

    $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
    $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
    date_default_timezone_set("Asia/Calcutta");
    $date_now = urlencode(date("d-m-Y"));

    $order_id = urlencode($_POST['order_id']);
    $razorpay_payment_id = urlencode($_POST['razorpay_payment_id']);
    $razorpay_subscription_id = urlencode($_POST['razorpay_subscription_id']);
    $charge_date = urlencode($_POST['charge_date']);
    $amount = urlencode($_POST['amount']);
    $product_id = urlencode($_POST['product_id']);
    $mobile_no = urlencode($_POST['mobile_no']);
    $capture_status = urlencode($_POST['capture_status']);

    $url = $link.'/api/v1/update_order_courses?order_id='.$order_id.'&phonenumber='.$mobile_no.'&product_id='.$product_id.'&payment_id='.$razorpay_payment_id.'&capture_status='.$capture_status.'&razorpay_subscription_id='.$razorpay_subscription_id.'&charge_date='.$charge_date.'';
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