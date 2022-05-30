<?php

    if(isset($_POST['id'])){

        $from_ip = urlencode($_SERVER['REMOTE_ADDR']);
        $from_browser = urlencode($_SERVER['HTTP_USER_AGENT']);
        date_default_timezone_set("Asia/Calcutta");
        $date_now = urlencode(date("d-m-Y"));

        require_once 'link.php';

        $id = $_POST['id'];

        $url = $link.'/api/v1/chapters_course?subtopic_id='.$id.'';

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