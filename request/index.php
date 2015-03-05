<?php
// request index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

if($uid = SharIt::auth()->uid){
	$gid=SharQuerySupervisor::getGid($uid);
	if($gid==2){
		SharIt::exception()->unAuth();
	}
}

$_LAYOUT['left'] =  SharIt::app()->loadView("request/include/ele_sideMenu.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("request/list.php");

SharIt::app()->layout($_LAYOUT,2);
?>