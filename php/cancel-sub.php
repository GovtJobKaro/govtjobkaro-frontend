<?php
    require_once 'link.php';
if(isset($_POST['course_id'])){ 
    $course_id = urlencode($_POST['course_id']);
    $order_courses_id = urlencode($_POST['order_courses_id']);
    $mobile_no = urlencode($_POST['mobile_no']);
    $razorpaysubscriptionid = urlencode($_POST['razorpaysubscriptionid']);
    
    $url = $link.'/api/v1/expire_subscription?order_courses_id='.$order_courses_id.'&phonenumber='.$mobile_no.'&course_id='.$course_id.'';
    $request_url = $url ;
    

    $curl1 = curl_init($request_url);

    curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl1,CURLOPT_POST, false);
    curl_setopt($curl1, CURLOPT_HTTPHEADER, [
    
    'Content-Type: application/json'
    ]);

    $response1 = curl_exec($curl1);
    curl_close($curl1);
    $obj = json_decode($response1, true);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://ENTER_YOUR_RAZORPAY_API_KEY:sVqiHyG1M8Gy1FkH7M8mbpUn@api.razorpay.com/v1/subscriptions/$razorpaysubscriptionid/cancel",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "postman-token: 67d92778-3ca8-ffb4-9680-c384d115f95a"
        ),
    )); 

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo json_encode($obj);
        echo $response;
    }
}
?>