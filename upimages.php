<?php
/*
 * author gaoxueping
 * upload image
 */
class upimages {

    public $appKey = '5156593';
    public $appSecret = 'J:}E}tc1uXUb';
    public $accessToken = '';
    public $fileName = 'panduo.jpg';
    public $groupId = '';

    public function __construct(){
        $this->accessToken = file_get_contents('data/accessToken');
    }
    public function upload($images,$model) {
        $imgUrlArr = array();
        for ($i = 0; $i < count($images); $i++) {
            $upload_image_server = 'http://gw.api.alibaba.com/fileapi/param2/1/aliexpress.open/api.uploadImage/' . $this->appKey . '?access_token=' . $this->accessToken . '&fileName=' . $model . '&groupId=' . $this->groupId;
            $handle = fopen($images[$i], "rb");
            $flow = fread($handle, filesize($images[$i]));
            fclose($handle);
            $imgInfoArr = json_decode($this->request_post($upload_image_server, $flow), true);
            var_dump($imgInfoArr);
            $imgUrlArr[] = $imgInfoArr['photobankUrl'];
        }
        return $imgUrlArr;
    }

    // post数据到url的函数
    public function request_post($remote_server, $content) {
        $http_entity_type = 'application/x-www-from-urlencoded'; //发送的格式
        $context = array(
            'http' => array(
                'method' => 'POST',
                // 这里可以增加其他header..
                'header' => "Content-type: " . $http_entity_type . "\r\n" .
                'Content-length: ' . strlen($content),
                'content' => $content)
        );
        $stream_context = stream_context_create($context);
        $data = file_get_contents($remote_server, FALSE, $stream_context);
        return $data;
    }


}

?>
