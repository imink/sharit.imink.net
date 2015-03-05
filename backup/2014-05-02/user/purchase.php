<?php
// about us index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

// Get current user id

if($uid = SharIt::auth()->uid){
	$gid=SharQuerySupervisor::getGid($uid);
	if($gid==2){
		SharIt::exception()->unAuth();
	}
if(!$filter[page] = SharIt::request()->get('page')){
	$filter[page] = 1;
}
$filter[perpage]=10;

$purchase = SharQueryRecord::listPurchasePrice($uid, $filter[page],$filter[perpage]);
if($purchase){
$totalPurchase=SharQueryRecord::countPurchase($uid);
$totalPageNum=ceil($totalPurchase/$filter[perpage]);
$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_purchase.php", array('purchase' => $purchase,'filter'=>$filter,'totalPageNum'=>$totalPageNum));
}else{
$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_no_purchase.php");
}
}else{
	SharIt::exception()->NotAValidUser();
}

$_LAYOUT['left'] =  SharIt::app()->loadView("user/include/ele_sideMenu.php");



SharIt::app()->layout($_LAYOUT,2);
?>