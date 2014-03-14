<?php
include 'config/config.php';
$refreshToken = file_get_contents('data/refreshToken');

$code_arr = array(
    'client_id' => $appKey,
    'grant_type' => 'refresh_token',
    'client_secret' => $appSecret,
    'refresh_token' => $refreshToken
);

ksort($code_arr);
$sign_str = 'param2/1/system.oauth2/refreshToken/' . $appKey;
foreach ($code_arr as $key => $val)
    $sign_str .= $key . $val;
$code_sign = strtoupper(bin2hex(hash_hmac("sha1", $sign_str, $appSecret, true)));

$getTokenUrl = 'https://gw.api.alibaba.com/openapi/param2/1/system.oauth2/refreshToken/' . $appKey;
$data = 'grant_type=refresh_token&refresh_token=' . $refreshToken . '&client_id=' . $appKey . '&client_secret=' . $appSecret . '&_aop_signature=' . $code_sign;


$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $getTokenUrl);
curl_setopt($ch, CURLOPT_POST, true); //启用POST提交
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$result = curl_exec($ch);
curl_close($ch);
file_put_contents('data/accessToken', $result['access_token']);
print_r($result);
