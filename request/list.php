<?php
// request list
require_once(dirname(dirname(__FILE__))."/framework/import.php");

if($uid = SharIt::auth()->uid){
	$gid=SharQuerySupervisor::getGid($uid);
	if($gid==2){
		SharIt::exception()->unAuth();
	}
}

$filter[cid] = SharIt::request()->get('cid');

if(!$filter[page] = SharIt::request()->get('page')){
	$filter[page] = 1;
}
$filter[perpage]=10;

$requestList=array();
//temporary use for test next page

if($filter[cid] && $filter[cid]!= -1){
	$requestList = SharQueryRequest::listAllRequestCategory($filter[cid],$filter[page],$filter[perpage]);
	$totalRequestC=SharQueryRequest::countRequestC($filter[cid]);
	$totalPageNum=ceil($totalRequestC/$filter[perpage]);
}else{	
	$requestList = SharQueryRequest::listAllRequest($filter[page],$filter[perpage]);
	$totalRequest=SharQueryRequest::countRequest();
	$totalPageNum=ceil($totalRequest/$filter[perpage]);
}

$_LAYOUT['left'] =  SharIt::app()->loadView("request/include/ele_sideMenu.php",array('filter'=>$filter));

$_LAYOUT['right'] =  SharIt::app()->loadView("request/include/ele_list.php", array('requestList'=>$requestList,'filter'=>$filter,'totalPageNum'=>$totalPageNum));

SharIt::app()->layout($_LAYOUT,2)
?>