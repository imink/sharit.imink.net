<?php
// patrick
require_once(dirname(dirname(dirname(__FILE__)))."/framework/import.php");

$a = SharQueryPicture::listPictureNormal(11);

$price = SharQueryMain::getPrice(5);  


$bid = SharQueryRecord::listBidPrice(11, 1);

$b = "sharit@qq.com";
$user=SharQuerySupervisor::getUserS($b);






$pictureMain = SharQueryPicture::getPictureMain(11);
// echo "$price";
$hottest = SharQueryListProduct::listHottestProduct();

print_r($hottest);


?>

