<?php
// about us index
require_once(dirname(dirname(__FILE__))."/framework/import.php");
// SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
if(!SharIt::request()->get('uid')||!SharIt::request()->get('activation')){
	SharIt::exception()->invalidOperation();
}else{
	$uid = SharIt::request()->get('uid');
	$activation = SharIt::request()->get('activation');
	$user = SharQueryAccount::getUser($uid);
	if($user[status]==SharQuery::$STATUSCODE['user_status']['UNACTIVATED']){
		if($activation == SharIt::auth()->activation($uid)){
			//change user status
			SharQuerySignUp::activateUser($uid);

			//activate success
			SharIt::app()->flashMsg()->add('s',"Sign Up Success! If you want to complete your personal information, please go to my account after login.");
			SharIt::app()->redirect("login.php",0);
		}else{
			//激活码不对
			SharIt::exception()->wrongActivationCode();
		}
	}else{
		//用户已经激活
		SharIt::exception()->alreadyActivated();
	}

}
