<?php
include 'config/config.php';
//生成签名
$redirectUrl = 'http://duba/express/creatAuth.php'; //hanshisky.taobao.com');
$code_arr = array(
    'client_id' => $appKey,
    'redirect_uri' => $redirectUrl,
    'site' => 'aliexpress'
);
ksort($code_arr);
$sign_str = '';
foreach ($code_arr as $key => $val)
    $sign_str .= $key . $val;
$code_sign = strtoupper(bin2hex(hash_hmac("sha1", $sign_str, $appSecret, true)));

$get_code_url = "http://gw.api.alibaba.com/auth/authorize.htm?client_id={$appKey}&site=aliexpress&redirect_uri={$redirectUrl}&_aop_signature={$code_sign}";
//echo 'get_code_url地址:' . $get_code_url . '<br /> <br />';
echo "<script language=\"javascript\">";
echo "location.href=\"$get_code_url\"";
echo "</script>";