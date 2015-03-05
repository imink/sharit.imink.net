<?php 
require_once(dirname(dirname(__FILE__))."/framework/import.php");
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
if($uid=SharIt::request()->get('uid')){
if(SharIt::auth()->uid){

$user = SharQueryAccount::getUser($uid);

$_LAYOUT['mid'] =  SharIt::app()->loadView("order/include/ele_profile.php", array('user' => $user));
}else
{
	SharIt::exception()->NotAValidUser();
}
}else{
	SharIt::exception()->invalidOperation();
}
SharIt::app()->layout($_LAYOUT,1);

?>