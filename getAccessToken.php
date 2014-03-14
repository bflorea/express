<?php
include 'config/config.php';
$redirectUrl = urlencode('http://hanshisky.taobao.com');
$code =file_get_contents("data/code");

$getTokenUrl = 'https://gw.api.alibaba.com/openapi/http/1/system.oauth2/getToken/' . $appKey;
$data = 'grant_type=authorization_code&need_refresh_token=true&client_id=' . $appKey . '&client_secret=' . $appSecret . '&redirect_uri=' . $redirectUrl . '&code=' . $code;

$ch = curl_init();
$timeout = 5000;
curl_setopt($ch, CURLOPT_URL, $getTokenUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($ch);
curl_close($ch);

echo '返回结果为:' . $result . '<br /> <br />';
$jsonResult = json_decode($result);
$loginId = $jsonResult->resource_owner;
$accessToken = $jsonResult->access_token;
$refreshToken = $jsonResult->refresh_token;
file_put_contents('data/accessToken', $accessToken);
file_put_contents('data/refreshToken', $refreshToken);
echo '你好' . $loginId . ',你的accessToken是:' . $accessToken;