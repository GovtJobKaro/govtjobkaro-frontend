<?php
if(isset($_POST['mobile'])){

    // logout api
    require_once 'link.php';

    $mobile = urlencode($_POST['mobile']);
    $product_id = urlencode($_POST['product_id']);
    $url = $link.'/api/v1/check_order?product_id='.$product_id.'&phonenumber='.$mobile.'';
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