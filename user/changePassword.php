<?php

require_once(dirname(dirname(__FILE__))."/framework/import.php");

if(!SharIt::auth()->isLogin()){
		SharIt::exception()->invalidOperation();
	}

$changeForm;
$changeErrors = array();

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
	if(!$changeErrors){
		$change=SharQueryAccount::updateSalt(SharIt::auth()->uid);
		SharQueryAccount::updateUserPassword($changeForm[password1], SharIt::auth()->uid);
		SharIt::app()->flashMsg()->add('s',"Change Success!");
		SharIt::app()->redirect("",0);
	}
	
}
$_LAYOUT['mid'] =  SharIt::app()->loadView("user/include/ele_change.php",array('change'=>$changeForm,'changeErrors'=>$changeErrors));
SharIt::app()->layout($_LAYOUT,1);

?>