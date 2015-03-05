<?php
require_once(dirname(dirname(__FILE__))."/framework/import.php");
// SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
if($changeForm=SharIt::request()->post('change')){

	$changeValidator = SharValidator::key('password1', SharValidator::shar_required('Password'))
	                                   ->key('password2', SharValidator::shar_required('Password'))
	                                   ->key('password1', SharValidator::shar_password('Password'))
	                                   ->key('password2', SharValidator::shar_password('Password'));
	try {
		$changeValidator->assert($changeForm);
	} catch(\InvalidArgumentException $e) {
		$changeErrors = $e->findMessages(array('Password'));
	}
	if($changeForm[code] != SharIt::auth()->activation($changeForm[uid])){
		array_push($changeErrors, "forgetCode Error!");
	}

	if(!$changeErrors){
		$change=SharQueryAccount::updateSalt($changeForm[uid]);
		SharQueryAccount::updateUserPassword($changeForm[password1], $changeForm[uid]);
		SharIt::app()->flashMsg()->add('s',"Change Success!");
		SharIt::app()->redirect("",0);
	}
}else{
	if(!SharIt::request()->get('uid')||!SharIt::request()->get('forgetCode')){
		SharIt::exception()->invalidOperation();
	}else{
		$uid = SharIt::request()->get('uid');
		$forgetCode = SharIt::request()->get('forgetCode');

		$user = SharQueryAccount::getUser($uid);
		
		if($forgetCode == SharIt::auth()->activation($uid)){
			$changeForm = array('uid'=>$uid,'code'=>$forgetCode);
			$changeErrors = array();
			
		}else{
			SharIt::exception()->invalidOperation();
		}
		

	}
}
$_LAYOUT['mid'] =  SharIt::app()->loadView("user/include/ele_change.php",array('change'=>$changeForm,'changeErrors'=>$changeErrors));
SharIt::app()->layout($_LAYOUT,1);