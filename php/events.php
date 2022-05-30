<?php

// register api
// $url ='http://134.209.155.102/api/v1/register?full_name=Parvinder&mobile_no=7009427959&user_type=user-typenull&device=andorid&ip_address=127.0.0.1&time=12./123';

// verify api
// $url = 'http://134.209.155.102/api/v1/verify?mobile_no=7009427959&otp=123456';

// userinfo api
// $url = 'http://134.209.155.102/api/v1/userinfo?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwaG9uZW51bWJlciI6IjcwMDk0Mjc5NTkiLCJpYXQiOjE2MTU4Mzg3MDMsImV4cCI6MTYyMTAyMjcwM30.uMgq_qapqKdvKUxwlkvMPZv3q6CAkKrKKrtdh8Iswc0';

// // logout api
// // $url = 'http://134.209.155.102/api/v1/logout';

// // login api
// // $url = 'http://134.209.155.102/api/v1/login?mobile_no=7009427959&device=andorid&ip_address=127.0.0.1&time=12./123';

// // resend otp api
// // $url = 'http://134.209.155.102/api/v1/resend?mobile_no=7009427959';

// // userinfo api
// // $url = 'http://134.209.155.102/api/v1/userinfo?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwaG9uZW51bWJlciI6IjcwMDk0Mjc5NTkiLCJpYXQiOjE2MTU4Mzg3MDMsImV4cCI6MTYyMTAyMjcwM30.uMgq_qapqKdvKUxwlkvMPZv3q6CAkKrKKrtdh8Iswc0';


// // all courses
// // $url = 'http://134.209.155.102/api/v1/all_courses';

// // category course
// // $url = 'http://134.209.155.102/api/v1/category_all_courses?category_type=punjab';

// // single course
// // $url = 'http://134.209.155.102/api/v1/single_course?course_id=09f76668-53ee-4486-889d-c1bb73cd1405';

// order courses
// $url ='http://134.209.155.102/api/v1/order_courses?name=test&phonenumber=7009427959&address=%23sector7-A()Chandigarh&city=puna&state=ludhiana&pincode=160019&referral_id=9b40bc&from_ip=123./234./&from_browser=123234&amount=200&payment_type=paytm&product_id=09f76668-53ee-4486-889d-c1bb73cd1405';

// update order
// $url ='http://134.209.155.102/api/v1/update_order_courses?order_id=acd1bd77-b062-4177-a79e-5c03ff11b12c&phonenumber=7009427959&product_id=09f76668-53ee-4486-889d-c1bb73cd1405&payment_id=e-4ba3-8&capture_status=true';


// // check order
$url ='http://134.209.155.102/api/v1/check_order?product_id=09f76668-53ee-4486-889d-c1bb73cd1405&phonenumber=7009427959';

// user_referral
// no unique visitor/
// $url ='http://134.209.155.102/api/v1/user_referral?course_id=09f76668-53ee-4486-889d-c1bb73cd1405&user_referral_code=9b40bc&revisiting=True';

//  unique visitor
// $url ='http://134.209.155.102/api/v1/user_referral?course_id=09f76668-53ee-4486-889d-c1bb73cd1405&user_referral_code=9b40bc&revisiting=False';

// affiliate_courses
// $url ='http://134.209.155.102/api/v1/affiliate_courses?user_referral_code=9b40bc';

// purchased courses
// $url ='http://134.209.155.102/api/v1/purchased_courses?phonenumber=7009427959';

// single purchased courses
// $url ='http://134.209.155.102/api/v1/single_purchased_course?course_id=09f76668-53ee-4486-889d-c1bb73cd1405&phonenumber=7009427959';

// redeem_requests
// $url ='http://134.209.155.102/api/v1/redeem_requests?user_id=2b9594d5-10a8-421c-8370-bfae57b6460d&phonenumber=7009427959&gpay_number=7009427959&account_name=Parvindertest&redeem_amount=25&from_ip=123./234./&from_browser=123234&time=123&method=Gpay';


//total_bonus
// $url ='http://134.209.155.102/api/v1/total_bonus?phonenumber=7009427959&referral_id=9b40bc';

// bonus_history
// $url ='http://134.209.155.102/api/v1/bonus_history?referral_id=9b40bc';

// redeem_history
// $url ='http://134.209.155.102/api/v1/redeem_history?user_id=2b9594d5-10a8-421c-8370-bfae57b6460d';





$request_url = $url ;

$curl = curl_init($request_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// if request is post then add this line code with true
curl_setopt($curl,CURLOPT_POST, true);
// get request add this line with false
curl_setopt($curl,CURLOPT_POST, False);

curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'X-RapidAPI-Host: kvstore.p.rapidapi.com',
  'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
  'Content-Type: application/json'
]);

$response = curl_exec($curl);
curl_close($curl);

// $obj = json_decode($response, true);
// print_r( $obj['data'][0]);
echo $response ;


// how to create cookie in php of access token
// print_r( $obj["token"]);

// $cookie_name = "access_token";
// $cookie_value = $obj["token"];
// // echo $cookie_value ;
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
// echo "The cookie is ". $_COOKIE["access_token"] ;

// function convert_text($text) {

//   $t = $text;

//   $specChars = array(
//       ' ' => '%20',    '!' => '%21',    '"' => '%22',
//       '#' => '%23',    '$' => '%24',    '%' => '%25',
//       '&' => '%26',    '\'' => '%27',   '(' => '%28',
//       ')' => '%29',    '*' => '%2A',    '+' => '%2B',
//       ',' => '%2C',    '-' => '%2D',    '.' => '%2E',
//       '/' => '%2F',    ':' => '%3A',    ';' => '%3B',
//       '<' => '%3C',    '=' => '%3D',    '>' => '%3E',
//       '?' => '%3F',    '@' => '%40',    '[' => '%5B',
//       '\\' => '%5C',   ']' => '%5D',    '^' => '%5E',
//       '_' => '%5F',    '`' => '%60',    '{' => '%7B',
//       '|' => '%7C',    '}' => '%7D',    '~' => '%7E',
//   );

//   foreach ($specChars as $k => $v) {
//       $t = str_replace($k, $v, $t);
//   }

//   return $t;
// }
?>