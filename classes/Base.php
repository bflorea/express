<?php
class Base{
    public $appKey = '5156593';
    public $appSecret = 'J:}E}tc1uXUb';
    public $accessToken = '';
    public $curlTimeOut = 5000;
    public $apiUrl = '';

    public function __construct($api){
        $this->accessToken = file_get_contents('data/accessToken');
        $apiUrl = 'https://gw.api.alibaba.com/openapi/param2/1/aliexpress.open/{*}/' . $this->appKey.'?access_token='.$this->accessToken;
        $this->apiUrl = $this->assembleUrl($api,$apiUrl);
    }

    private function assembleUrl($api,$url){
        $url = str_replace('{*}', $api, $url);//接口URL
        return $url;
    }


    public function sendRequest($postFileds){
        $data = '';
        foreach ($postFileds as $key=>$value){
            $data.=$key.'='.$value.'&';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this -> curlTimeOut);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }


}