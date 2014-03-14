<?php
header("Content-type: text/html; charset=utf-8");
include 'classes/Base.php';
//
$req = $_GET['req'];
if(isset($req)){
    $xml_array = (array) simplexml_load_file('config/functions.xml');
    $index = json_decode(json_encode($xml_array),TRUE);
    $obj = new Base($index[$req]['api']);

    $result = $obj->sendRequest($index[$req]['data']);
    var_dump($result);
}else{
	echo '请添加req参数';
}
