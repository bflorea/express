<?php
set_time_limit(9999999999);
//header('Content-type:application/vdn.ms-excel');
//header('Content-Disposition:attachment;filename=myexcel.xls');
mysql_connect('69.64.65.52', 'panduotec8', 'pan195013') or die('server error');
mysql_select_db('8seasons') or die('db eror');
//erp价格计算
//$handle = fopen('panduora.csv', 'r');
//
$sql = "select p.products_image, p2c.four_categories_id,pd.products_name, pd.products_description, p.products_quantity, p.products_id,p.products_weight , p.products_type, p.product_is_call, p.products_qty_box_status, p.products_model, 
                p.products_quantity_order_min, p.products_quantity_order_max, p.products_volume_weight 
                from zen_products p 
                left join zen_products_description pd on p.products_id = pd.products_id 
                left join zen_products_to_categories p2c on p2c.products_id = p.products_id 
                left join zen_categories c on three_categories_id = c.categories_id 
                where pd.language_id = '1' and p.products_status = 1 and three_categories_id = 364 and categories_status = 1 
                group by p.products_id order by p.products_date_added desc, p.products_sort_order, pd.products_name LIMIT 1,1";
$result = mysql_query($sql);
echo "categoryId\t";
echo "subject\t";
echo "images\t";
echo "isImageDynamic\t";
echo "deliveryTime\t";
echo "keyword\t";
echo "productPrice\t";
echo "freightTemplateId\t";
echo "productUnit\t";
echo "packageType\t";
echo "packageLength\t";
echo "packageWidth\t";
echo "packageHeight\t";
echo "grossWeight\t";
echo "isPackSell\t";
echo "wsValidNum\t";
echo "aeopAeProductPropertys\t";
echo "detail\t";
echo "otNum\t";
echo "cid\t";
echo "model\n";
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    preg_match_all("/^<script>.*<\/script>/", $row['products_description'] ,$match);
    print_r($match);exit;
    echo "200000142\t";
    echo $row['products_name']."\t";
    echo json_encode(array($row['products_model'].'_310_310.JPG',$row['products_model'].'01_310_310.JPG',$row['products_model'].'02_310_310.JPG'))."\t";
    echo "true\t";
    echo "2\t";
    echo "Beads\t";
    echo "5000\t";
    echo "1000\t";
    echo "100000015\t";
    echo "true\t";
    echo "1\t";
    echo "1\t";
    echo "1\t";
    echo $row['products_volume_weight']."\t";
    echo "false\t";
    echo "30\t";
    echo "[{'attrNameId':'2','attrValue':'8seasons.com'},{'attrNameId':'3','attrValue':'B00004'},{'attrNameId':'200000161','attrValueId':'200000270'},{'attrNameId':'10','attrValueId':'100012146'},{'attrNameId':'200000061','attrValue':'5'}]\t";
    echo $row['products_description']."\t";
    echo "300\t";
    echo $row['four_categories_id']."\t";
    echo $row['products_model']."\n";
}
?>