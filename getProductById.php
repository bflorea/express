<?php
/*
 * author gaoxueping
 * api for order
 */
include 'config/config.php';
$access_token = file_get_contents('data/accessToken');
$url = 'http://gw.api.alibaba.com/openapi/param2/1/aliexpress.open/api.findAeProductById/' . $appKey; //接口URL
$data = 'access_token=' . $access_token . '&productId=1049337196'; //准备POST参数

$ch = curl_init();
$timeout = 5;
//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$re = curl_exec($ch);
echo '<pre>';
print_r(json_decode($re));
echo '</pre>';
curl_close($ch);


