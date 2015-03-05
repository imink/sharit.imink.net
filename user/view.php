<?php
// about us index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

// SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});


if($uid = SharIt::auth()->uid){
	if($user = SharQueryAccount::getUser($uid)){
		$usermeta = SharQueryAccount::getUsermeta($uid);
	}else{
		SharIt::exception()->NotAValidUser();
	}
    	
}else{
	SharIt::exception()->NotAValidUser();
}



$_LAYOUT['left'] =  SharIt::app()->loadView("user/include/ele_sideMenu.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_view.php", array('user' => $user, 'usermeta' => $usermeta));

SharIt::app()->layout($_LAYOUT,2);
?>