<?php
    include 'config/config.php';
    $accessToken = file_get_contents('data/accessToken');
    $getlistFreightTemplateUrl = 'https://gw.api.alibaba.com/openapi/param2/1/aliexpress.open/api.getPostCategoryById/'.$appKey.'?cateId=380210';//接口URL
    $data = 'access_token='.$accessToken;//准备POST参数

    $ch = curl_init();
    $timeout = 5000;
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//接收结果为字符串
    curl_setopt($ch, CURLOPT_URL, $getlistFreightTemplateUrl);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_POST, true);//启用POST提交
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //https请求必须加上此项

    $re = curl_exec($ch);
    curl_close($ch);
    $result=json_decode($re,true);
    header("Content-type: text/html; charset=utf-8");
    print_r($result);
