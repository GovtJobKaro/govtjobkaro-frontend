<?php
if(isset($_POST['type'])){

    // logout api
    require_once 'link.php';

    $url = $link.'/api/v1/logout';
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