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

$request = array();



$totalRequest=SharQueryRecord::countRequest($uid);
$totalPageNum=ceil($totalRequest/$filter[perpage]);
if($totalRequest==0){
	$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_no_request.php");
}else{
if($status = SharIt::request()->post('status')){
	if($status[submit]){			
			if($status[action] == 0)
				SharQueryRequest::closeRequest($status[id]);
			if($status[action] == 1)
				SharQueryRequest::activeRequest($status[id]);
	}
  }

$request = SharQueryRecord::listRequest($uid,$filter[page],$filter[perpage]);
$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_request.php", array('request' => $request,'filter'=>$filter,'totalPageNum'=>$totalPageNum));
}
}else{
	SharIt::exception()->NotAValidUser();
}

$_LAYOUT['left'] =  SharIt::app()->loadView("user/include/ele_sideMenu.php");



SharIt::app()->layout($_LAYOUT,2);
?>