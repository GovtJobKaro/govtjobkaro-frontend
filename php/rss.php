<?php

function curl_get_contents($url) {
    // Initiate the curl session
    $ch = curl_init();
    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $url);
    // Removes the headers from the output
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // Return the output instead of displaying it directly
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //set timeout
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    // Execute the curl session
    $output = curl_exec($ch);
    // Close the curl session
    curl_close($ch);
    // Return the output as a variable
    return $output;
}

$feed = curl_get_contents("https://www.youtube.com/feeds/videos.xml?channel_id=UCPCtMF4z_rD7HeQh8ZwJtUQ");
$xml = new SimpleXmlElement($feed);

$count = count($xml->entry);
// echo ($count);
$video_obj = [];
for ($i=0; $i < 5; $i++) { 
    $url = $xml->entry[$i]->link->attributes();
    $videourl = explode("&",$url['href']);
    $video = str_replace("https://www.youtube.com/watch?v=","",$videourl[0]);
    $video_obj[$i] = '<div class="container"><p><iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video.'" frameborder="0" allowfullscreen></iframe></p></div>';
    // echo '<div class="container">';
    // // echo '<h1>'.$xml->entry[$i]->title.'</h1>';
    // // echo '<p>Posted on '.date('jS M Y h:i:s', strtotime($xml->entry[$i]->published)).'</p>';
    // echo '<p><iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video.'" frameborder="0" allowfullscreen></iframe></p>';
    // // echo '<p>'.$xml->entry[$i]->content.'</p>';
    // // echo '<p><a href="'.$url['href'].'">Play on Youtube</a></p>';
    // echo '</div>';
}
$obj = [];
$obj['data'] = $video_obj;
$obj['status'] = 'success';
echo json_encode($obj);

?>