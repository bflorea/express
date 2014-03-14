<?php
/*
 * author gaoxueping
 * process data
 */
    set_time_limit(0);
    $type= 'shoushipeijian';
    $handle = fopen('import/gets_sales41.csv','r');
    $product = array();
    while ($data = fgetcsv($handle,1000,',')) {
        $product[] = $data;
    }
    $excelData = array();
    for ($i = 1; $i < count($product); $i++) {
        $desc = 'detail';
        $product[$i]['detail'] = $desc;
        $excelData[$i]['detail'] = $desc;
        $path = 'E:/zend_workspace/express/images';
        $excelData[$i]['images'] = json_encode(array($path.$product[$i][20]));
        $excelData[$i]['model'] = $product[$i][14];
        $excelData[$i]['subject'] = 'Free Shipping! '.$product[$i][14];
        $excelData[$i]['categoryId'] = $product[$i][11];
        $excelData[$i]['groupId'] = $product[$i][12];
        $excelData[$i]['isImageDynamic'] = "false";
        $excelData[$i]['deliveryTime'] = "5";
        $excelData[$i]['productPrice'] = $product[$i][4];
        $excelData[$i]['freightTemplateId'] = "1000";
        $excelData[$i]['productUnit'] = $product[$i][1];
        $excelData[$i]['packageType'] = $product[$i][16];
        $excelData[$i]['packageLength'] = "5";
        $excelData[$i]['packageWidth'] = "5";
        $excelData[$i]['packageHeight'] = "5";
        $excelData[$i]['grossWeight'] = ($product[$i][2]*0.001*1.1);
        $excelData[$i]['isPackSell'] = "false";
        $excelData[$i]['wsValidNum'] = "30";
        $excelData[$i]['isImageWatermark'] = "true";
        $excelData[$i]['promiseTemplateId'] = "34643";
        $excelData[$i]['lotNum'] = $product[$i][3];
        $excelData[$i]['keyword'] = $product[$i][15];
    switch (true) {
        case $type = "shoushipeijian" :
            $excelData [$i] ['aeopAeProductPropertys'] = json_encode ( array (
                    array (
                            'attrNameId' => '2',
                            'attrValue' => $product [$i] [13]
                    ),
                    array (
                            'attrNameId' => '3',
                            'attrValue' => $product [$i] [14]
                    ),
                    array (
                            'attrNameId' => '10',
                            'attrValueId' => $product [$i] [17]
                    ),
                    array (
                            'attrNameId' => '20262',
                            'attrValueId' => $product [$i] [18]
                    )
            ) );
            break;
        default :
            break;
    }

    }

    return $products = $excelData;
?>