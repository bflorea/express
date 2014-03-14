<?php
/**
 * panduo tec
 * upload image
 */

//读取文件
//$filePath = "F:/1344.jpg";
//$fh = fopen($filePath, "rb");
//$data = fread($fh, filesize($filePath));
//fclose($fh);
set_time_limit(0);
$appKey = '5156593';
$appSecret = 'J:}E}tc1uXUb';
$accessToken = '1f40ebd8-9f9c-47ea-bb96-30bb5312dfcb';
$fileName = '12309.jpg';
$groupId = "200506810";


//post地址
$upload_image_server = 'http://gw.api.alibaba.com/fileapi/param2/1/aliexpress.open/api.uploadImage/' . $appKey . '?access_token=' . $accessToken . '&fileName=' . $fileName .'&groupId='.$groupId;

/*
 * 上传多个图片
 */
// gaoxueping
//$fileArr = array('F:/image/2.jpg','F:/image/3.jpg');
$imgUrlArr = array();
for ($i = 0; $i < count($fileArr); $i++) {
    $upload_image_server = 'http://gw.api.alibaba.com/fileapi/param2/1/aliexpress.open/api.uploadImage/' . $appKey . '?access_token=' . $accessToken . '&fileName=' . $fileName .'&groupId='.$groupId;
    $handle = fopen($fileArr[$i], "rb"); 
    $flow = fread($handle, filesize($fileArr[$i]));
    fclose($handle);
    $imgInfoArr = json_decode(request_post($upload_image_server, $flow),true);
    $imgUrlArr[] = $imgInfoArr['photobankUrl'];
}
//print_r($imgUrlArr);
// gaoxueping

//post提交
//echo request_post($upload_image_server, $data);

// post数据到url的函数
function request_post($remote_server, $content) {
    $http_entity_type = 'application/x-www-from-urlencoded'; //发送的格式
    $context = array(
        'http' => array(
            'method' => 'POST',
            // 参数自行设定 gaoxueping
            'header' => "Content-type: " . $http_entity_type . "\r\n" .
            'Content-length: ' . strlen($content),
            'content' => $content)
    );
    $stream_context = stream_context_create($context);
    $data = file_get_contents($remote_server, FALSE, $stream_context);
    return $data;
}

?>