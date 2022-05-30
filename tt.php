<?php
echo readfile("http://govtjobkaro.com/blog");   //needs "Allow_url_include" enabled
//OR
// echo include("http://govtjobkaro.com/blog");    //needs "Allow_url_include" enabled
// //OR
// echo file_get_contents("http://govtjobkaro.com/blog");
// //OR
// echo stream_get_contents(fopen('http://govtjobkaro.com/blog', "rb")); //you may use "r" instead of "rb"  //needs "Allow_url_fopen" enabled
?>