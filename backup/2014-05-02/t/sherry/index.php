<?php
//Sherry Xinrui Xu
require_once(dirname(dirname(dirname(__FILE__)))."/framework/import.php");
echo "<h1>This is test for Sharit[sherry]</h1>";

//echo SharQueryMain::getPrice(8);
echo '<br />';
//print_r (SharQueryRecord::listPublish(2,1));
//echo SharQueryRecord::countPulish(2);
echo '<br />';
//print_r (SharQueryRecord::listRequest(2,1,1));
echo '<br />';
//print_r (SharQueryRecord::listPurchase(2,1));
echo '<br />';
//print_r (SharQueryRecord::listBid(2,1));
echo '<br />';
//print_r (SharQueryRecord::listQuestion(6,1));
echo '<br />';
//print_r (SharQueryRecord::listAnswer(1,1));
echo '<br />';
//print_r (SharQueryAccount::getUser(4));
echo '<br />';
//print_r (SharQueryAccount::getUsermeta(1));
echo '<br />';
//SharQuerySignUp::insertUser('aaaa', 'jfjiyfufuyfufyufuyfufufuyf','test');
//SharQuerySignUp::activeUser('qdrabq');
//SharQueryMain::insertPrice(20, 11);
//echo SharQueryManageProduct::insertProduct(11,'test',3,2, 'testingtestingtestingtesting');
////SharQueryManageProduct::insertPictureMain($array1);
//SharQueryManageProduct::delectProduct(12);
////SharQueryManageProduct::insertBid(11,'2014-4-15');
//SharQueryAccount::updateUser("Jack Sparrow",1);
////print_r(SharQueryProduct::getProduct(1));
/////print_r (SharQueryMain::listCategory(0));
//print_r(SharQueryProduct::listPrice(5));
//print_r(SharQueryProduct::listQanda(6,1));
//SharQueryProduct::updateViewNo(1,133);
//print_r (SharQueryRequest::listAllRequestCategory(1,1));
//print_r(SharQueryListProduct::listProduct(1, 'upload_time'));
//print_r(SharQueryListProduct::listProductCategory(1, 1, 'upload_time'));
//print_r(SharQueryListProduct::listHottestProduct());

//print_r(SharQueryOrder::listOrderCategory(1));
$array=array("gender" => "female","phone_no"=>12345678);
//SharQueryAccount::updateUsermeta($array,3);

$array1=array('id'=>11,'ts'=>'2014-04-06 20:24:48');
//print_r(SharQueryOrder::getOrder(1));
//SharQueryOrder::updateUserReview(8, 4, 5, 4, 3, 2);
//print_r(SharQueryProduct::searchProduct('lace'));
//SharQueryManageProduct::insertQuestion(1,2,'test');
//SharQueryManageProduct::insertAnswer(6,'testing');
//echo SharQuerySupervisor::insertCategory('kindle', 5);
$array2=array('coke','coffee','juice','tea');
//SharQuerySupervisor::insertCategoryGroup('drink', $array2);
//SharQueryAuto::cancelOrder('2014-04-12');
//print_r(SharQueryRequest::listAllCategoryFromRequest());
//print_r(SharQueryRequest::getRequest(1));
//$productInfo=SharQueryListProduct::listProduct(null,2,null,1);
//print_r($productInfo);
//echo SharQueryRequest::countRequest();
//
$array3=array('id'=>1,'picture_name'=>'test');
SharQuerySupervisor::insertPictureDisplay($array3);
echo 'aaaaend';

?>