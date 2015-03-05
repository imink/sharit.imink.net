<?php
// user index
require_once(dirname(dirname(__FILE__))."/framework/import.php");
if(!$uid = SharIt::auth()->uid){
	$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_no_authority.php");
}else{
	$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_default.php");
}
$_LAYOUT['left'] =  SharIt::app()->loadView("user/include/ele_sideMenu.php");


SharIt::app()->layout($_LAYOUT,2);
?>