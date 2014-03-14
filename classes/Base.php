<?php
class Base{
    public $appKey = '5156593';
    public $appSecret = 'J:}E}tc1uXUb';
    public $accessToken = '';
    public $curlTimeOut = 5;
    public $apiUrl = '';

    public function __construct(){
        $this->accessToken = file_get_contents('data/accessToken');
        $this->apiUrl = 'https://gw.api.alibaba.com/openapi/param2/1/aliexpress.open/{*}/' . $this->appKey.'?access_token=' . $this->accessToken;

    }

    public function assembleUrl($api){
        $orginUrl = str_replace('{*}', $api, $this->apiUrl);//接口URL
        return $url;
    }

    public function sendRequest($url,$postFileds){
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFileds);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this -> curlTimeOut);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }


}