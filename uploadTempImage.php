<html>
    <body>
        <?php
        set_time_limit(50000);
        //读取文件
        $filePath = "F:/123.jpg";
        $fh = fopen($filePath, "rb");
        $data = fread($fh, filesize($filePath));
        fclose($fh);
        
        //==================
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //接收结果为字符串
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5000); 
//        curl_setopt($ch, CURLOPT_URL, "http://gw.api.alibaba.com/fileapi/param2/1/aliexpress.open/api.uploadTempImage/5156593?access_token=339066c7-d1cc-4fd1-a551-b4a4791298e5&srcFileName=123.jpg");
//
//        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlPost));
////        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-length: ".strlen($data),"content: ".$data,"Content-type: application/x-www-from-urlencoded"));
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-length: ".strlen($data),"Content-type: application/x-www-from-urlencoded"));
//        curl_setopt($ch, CURLOPT_POSTFIELDS, array("content" => $data));
//        $re = curl_exec($ch);
//        curl_close($ch);
//        $result = json_decode($re, true);
//        var_dump($result);exit;
        //==================

//post地址
        $upload_image_server = 'http://gw.api.alibaba.com/fileapi/param2/1/aliexpress.open/api.uploadTempImage/5156593?access_token=339066c7-d1cc-4fd1-a551-b4a4791298e5&srcFileName=123.jpg';

//post提交
        echo request_post($upload_image_server, $data);

// post数据到url的函数
        function request_post($remote_server, $content) {
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
        ?>
    </body>
</html>
