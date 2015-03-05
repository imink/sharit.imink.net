<?php
// user bid record
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

$bid = SharQueryRecord::listBidPrice($uid, $filter[page]);
if($bid){
$totalBid=SharQueryRecord::countBid($uid);
$totalPageNum=ceil($totalBid/$filter[perpage]);
$_LAYOUT['right'] = SharIt::app()->loadView("user/include/ele_bid.php", array('bid' => $bid, 'filter'=>$filter,'totalPageNum'=>$totalPageNum));

}else{
	$_LAYOUT['right'] = SharIt::app()->loadView("user/include/ele_no_bid.php");
}
}else{
	SharIt::exception()->NotAValidUser();
}
$_LAYOUT['left'] = SharIt::app()->loadView("user/include/ele_sideMenu.php");



SharIt::app()->layout($_LAYOUT,2);
?>