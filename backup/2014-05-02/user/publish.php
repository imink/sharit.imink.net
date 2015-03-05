<?php
// user publish record
require_once(dirname(dirname(__FILE__))."/framework/import.php");
// Get current user id
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
if($uid = SharIt::auth()->uid){

	$product = array();

	if(!$filter[page] = SharIt::request()->get('page')){
		$filter[page] = 1;
	}
	$filter[perpage]=10;

	$product = SharQueryRecord::listPublish($uid, $filter[page],$filter[perpage]);
	if(!$product){
		$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_no_publish.php");
	}else{
		$totalPublish=SharQueryRecord::countPulish($uid);
		$totalPageNum=ceil($totalPublish/$filter[perpage]);
		if($act=SharIt::request()->post('act')){
			if($act[activeSoldout]||$act[activeOnsell]){
				SharQueryManageProduct::activateProduct(SharIt::request()->post('pid'));
			}elseif($act[frozen]||$act[delete]){
				SharQueryManageProduct::deleteProduct(SharIt::request()->post('pid'));
			}
		}
		$product = SharQueryRecord::listPublish($uid, $filter[page],$filter[perpage]);
		foreach ($product as $key => $value) {
			$product[$key][oid]=SharQueryOrder::getOrderId($value[id]);
		}
		$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_publish.php", array('product' => $product,'filter'=>$filter,'totalPageNum'=>$totalPageNum));
	}
}else{
	SharIt::exception()->NotAValidUser();
}

$_LAYOUT['left'] =  SharIt::app()->loadView("user/include/ele_sideMenu.php");



SharIt::app()->layout($_LAYOUT,2);
?>