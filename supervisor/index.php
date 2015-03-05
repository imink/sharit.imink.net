<?php
// supervisor index
require_once(dirname(dirname(__FILE__))."/framework/import.php");
if(SharIt::auth()->uid){
$userid=SharIt::auth()->uid;
// SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
$gid=SharQuerySupervisor::getGid($userid);

if($gid==2){

$_LAYOUT['left'] =  SharIt::app()->loadView("supervisor/include/ele_sideMenu.php");
$_LAYOUT['right'] =  SharIt::app()->loadView("supervisor/include/ele_default.php");
}else{
	SharIt::exception()->unAuth();
}
}else{
	SharIt::exception()->notAValidUser();
}
SharIt::app()->layout($_LAYOUT,2);
?>