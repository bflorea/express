<?php
/*
 * author gaoxueping
 * api for order
 */
$appKey = '5156593';
$access_token = 'a1649331-9767-403b-b5e2-7d5b177585f2';
$page = '1';
$pageSize = '50';
$getOrderListUrl = 'https://gw.api.alibaba.com/openapi/param2/1/aliexpress.open/api.findOrderListQuery/' . $appKey; //接口URL
$data = 'access_token=' . $access_token . '&page=' . $page . '&pageSize=' . $pageSize.'&createDateStart=07/04/2013'; //准备POST参数    

$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $getOrderListUrl);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$re = curl_exec($ch);
echo '<pre>';
print_r(json_decode($re));
echo '</pre>';
curl_close($ch);


