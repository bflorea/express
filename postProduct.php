<?php
/*
 * author gaoxueping
 * post products
 */
set_time_limit(0);
/**
 * 上传商品到速卖通
 */
include_once('processData.php');
include_once 'classes/upimages.php';
$successId = array();
echo '上传条数：'.count($products).'<br>';
for ($j = 1; $j < count($products); $j++) {
    echo '第'.$j.'开始'.'<br/>';
    $products[$j]['images'] = json_decode($products[$j]['images']);
    for ($jj = 0; $jj < count($products[$j]['images']); $jj++) {
        $products[$j]['images'][$jj] = $products[$j]['images'][$jj];
    }
    $fileArr = $products[$j]['images'];
    $upimages = new upimages();
    $imgUrlArr = $upimages->upload($fileArr,$products[$j]['model'].".jpg");
    $detail =$products[$j]['detail'];
    $accessToken = file_get_contents('data/accessToken');
    $deliveryTime = $products[$j]['deliveryTime'];
    $categoryId = $products[$j]['categoryId'];
    $subject = $products[$j]['subject'];
    $keyword = $products[$j]['keyword'];
    $productPrice = sprintf("%.2f", $products[$j]['productPrice']);
    $freightTemplateId = $products[$j]['freightTemplateId'];
    $isImageDynamic = "false";
    $imageURLs = join(";", $imgUrlArr);
    $productUnit = $products[$j]['productUnit'];
    $packageType = $products[$j]['packageType'];
    $packageLength = $products[$j]['packageLength'];
    $packageWidth = $products[$j]['packageWidth'];
    $packageHeight = $products[$j]['packageHeight'];
    $grossWeight = $products[$j]['grossWeight'];
    $isPackSell = $products[$j]['isPackSell'];
    $wsValidNum = $products[$j]['wsValidNum'];
    $aeopAeProductPropertys = $products[$j]['aeopAeProductPropertys'];
    $lotNum = $products[$j]['lotNum'];
    $groupId = $products[$j]['groupId'];
    $promiseTemplateId = $products[$j]['promiseTemplateId'];
    $isImageWatermark = $products[$j]['isImageWatermark'];

    $curlPost = array(
        'detail' => $detail,
        'deliveryTime' => $deliveryTime,
        'categoryId' => $categoryId,
        'subject' => $subject,
        'keyword' => $keyword,
        'productPrice' => $productPrice,
        'freightTemplateId' => $freightTemplateId,
        'isImageDynamic' => $isImageDynamic,
        'imageURLs' => $imageURLs,
        'productUnit' => $productUnit,
        'packageType' => $packageType,
        'lotNum' => $lotNum,
        'packageLength' => $packageLength,
        'packageWidth' => $packageWidth,
        'packageHeight' => $packageHeight,
        'grossWeight' => $grossWeight,
        'isPackSell' => $isPackSell,
        'wsValidNum' => $wsValidNum,
        'aeopAeProductPropertys' => $aeopAeProductPropertys,
        'groupId' => 0,
        'promiseTemplateId' => $promiseTemplateId,
        'isImageWatermark' => $isImageWatermark,
    );
    var_dump($curlPost);
    $appkey = "5156593";
    $ch = curl_init();
    $accessToken = file_get_contents('data/accessToken');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //接收结果为字符串
    curl_setopt($ch, CURLOPT_URL, "http://gw.api.alibaba.com/openapi/param2/1/aliexpress.open/api.postAeProduct/" . $appkey.'?access_token=' . $accessToken);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $re = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($re, true);
    var_dump($result);
    $successId[] = $result['productId'];
    header("Content-type: text/html; charset=utf-8");
    if ($result['success']) {
        echo '第'.$j.'上传成功！' . $result['productId'].'<br/>';
    } else {
        echo $products[$j]['model'];
        throw new Exception("错误代码:" . $result['error_code']);
//        exit();
    }

}
?>