<?php
//Louise Mengxue Huang
require_once(dirname(dirname(dirname(__FILE__)))."/framework/import.php");
echo "<h1>This is test for Shait[Louise]</h1>";
//echo SharQueryMain::getPrice(8);
//echo '<br />';
//print_r (SharQueryRecord::listPublish(2,1,0));

//print_r (SharQueryMain::listCategory(0));
//print_r (SharQueryMain::listAllCategory(1));
//echo SharQueryMain::getCategory(1);
//SharQueryMain::deleteCategory(2);
//SharQueryMain::activeCategory(2);
//SharQueryRequest::closeRequest(1);
//SharQueryRequest::deleteRequest(1);
//SharQueryRequest::activeRequest(1);
//print_r(SharQueryListProduct::listProductOnBid(1));
//print_r (SharQueryBid::getFinalBid(1));
//print_r( SharQueryListProduct::listProductOnBidCategory(3,1));
//SharQueryManageProduct::activateBid(8);
//echo SharQueryMain::getPrice(1);
//SharQueryBid::insertBid(440, 5, 12);
//echo SharQueryBid::getHighPrice(5);
//SharQueryManageProduct::activateProduct(11);
echo '<br/>';
//print_r(SharQueryListProduct::listProductDecrease(null,1,'price'));
//print_r(SharQueryListProduct::listProductIncrease(1,'price'));
//print_r(SharQueryListProduct::listProductRate(1));
//print_r(SharQueryListProduct::listProductRateCategory(1,1));
//print_r(SharQueryListProduct::listProductCategoryDecrease(1, 1, 'price'));
//print_r(SharQueryListProduct::listProductCategoryIncrease(1, 1, 'price'));
//print_r(SharQueryListProduct::listProductNoBidDecrease(1, 'price'));
//print_r(SharQueryListProduct::listProductNoBidIncrease(1, 'price'));
//print_r(SharQueryListProduct::listProductRateNoBid(1));
//print_r(SharQueryListProduct::listProductNoBidCategoryDecrease(1,1, 'price'));
//print_r(SharQueryListProduct::listProductNoBidCategoryIncrease(1,1, 'price'));
//print_r(SharQueryListProduct::listProductRateNoBidCategory(1,1));
//print_r(SharQueryListProduct::listProductOnBid(1));
//print_r(SharQueryListProduct::listProduct(null,3,1,1,'due_date','DESC'));
echo '<br/>';
//print_r(SharQueryListProduct::listProductOnBidCategory(null,3,1));

//print_r(SharQueryMain::listCategory());
//echo SharQueryOrder::getUserStatus(12);
//echo SharQueryOrder::insertOrder(7,9);
//print_r(SharQueryOrder::makeBidOrder('2014-04-15'));
//SharQueryManageProduct::activateBid(5);
//print_r(SharQueryRecord::listPurchasePrice(12,1));
$array=array('id'=>11,'picture_name'=>'20140415092314sjdhty');
$array2=array('id'=>5,'picture_name'=>'20140415092446kjsydh');
$array3=array('id'=>9,'picture_name'=>'20140415091557shdtgf');
$array4=array('id'=>10,'picture_name'=>'20140415092456shyjsk');
//SharQuerySupervisor::insertPictureDisplay($array2);
//SharQuerySupervisor::insertPictureDisplay($array3);
//SharQuerySupervisor::insertPictureDisplay($array4);
//SharQuerySupervisor::deletePictureDisplay();
//SharQuerySupervisor::insertAdvertisement(10, 'Bracelet', 'From Forever 21, Beautiful');
//SharQuerySupervisor::insertAdvertisement(9, 'Harry Potter', 'Harry Potter and the Sorcerer\'s Stone, totally new');
//SharQuerySupervisor::insertAdvertisement(5, 'Dell Laptop', 'Dell inspiron M101z-1020');
//SharQuerySupervisor::insertAdvertisement(11, 'test', 'Just used for test');
//print_r(SharQueryAccount::getUsermeta(4));
//echo SharQueryMain::getCategory(11);
//print_r(SharQueryListProduct::listProductDecrease('almost new',1,'view_number'));
//print_r(SharQueryRequest::listAllRequest(1));
$array5=array('first_name'=>'Shar', 'middle_name'=>'It','last_name'=>'Test', 'postcode'=>'L7 6JZ','phone_no'=>'07565454512', 'address_1'=>'1a Catharine Street,Liverpool', 'address_2'=>'UK');
//SharQuerySignUp::insertUsermeta($array5,11);
//print_r(SharQueryOrder::getOrder(1));

//print_r(SharQueryRequest::listPublish(2));
//echo SharQueryListProduct::countProduct(null,null,1);
//print_r(SharQueryRequest::listAllCategoryFromRequest());
//print_r(SharQueryRequest::listReply(1))
//print_r(SharQueryProduct::getProduct(8));
//echo SharQueryListProduct::countProduct(null,10,null);
//echo SharQuerySupervisor::getGid(15);
//SharQueryManageProduct::insertAnswer(4,'hahahah');
//echo SharQueryAccount::getSalt(11);
//print_r(SharQueryListProduct::listHottestProduct());
echo SharQueryOrder::getOrderId(5);
echo '<br />';
echo "hahahaha";
?>


	