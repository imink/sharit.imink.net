<?php
// user edit my profile
require_once(dirname(dirname(__FILE__))."/framework/import.php");
// Get current user id
SharIt::page()->setTitle("edit");
$editForm;
$editErrors = array();



if($uid = SharIt::auth()->uid){
	$user = SharQueryAccount::getUser($uid);
	if(!$user){
		SharIt::exception()->notAValidUser();
	}
$usermeta = SharQueryAccount::getUsermeta($uid);
	if($editForm = SharIt::request()->post('edit')){
	
	$editValidator = SharValidator::key('display_name', SharValidator::shar_required('Display Name'))
	                               ->key('email', SharValidator::shar_required('Email'))
	                               ->key('display_name', SharValidator::shar_displayname('Display Name'))
	                               ->key('email', SharValidator::shar_email('Email'));
	                               
	                               
	
	if($editForm['first_name']){
		
		$editValidator = $editValidator ->key('first_name',SharValidator::shar_realname('Real Name'));
	}
	if ($editForm['middle_name']){
		
		$editValidator = $editValidator ->key('middle_name',SharValidator::shar_realname('Real Name'));
	}
	if($editForm['last_name']){
		
		$editValidator = $editValidator ->key('last_name',SharValidator::shar_realname('Real Name'));
	}
	if($editForm['phone_no']){
		
		$editValidator = $editValidator ->key('phone_no',SharValidator::shar_phonenumber('Phone Number'));
	}
	if($registerForm['postcode']){
		
		$editValidator = $editValidator ->key('postcode',SharValidator::shar_postcode('Post Code'));
	}
	if($registerForm['address_1']){
		
        $editValidator = $editValidator ->key('address_1',SharValidator::shar_address('Address'));
	}
	if($registerForm['address_2']){
		
        $editValidator = $editValidator ->key('address_2',SharValidator::shar_address('Address'));
	}
	
	if($editForm[agree]){
		 $editValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}else{
		$editForm[agree]='off';
		 $editValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}
	                              
	try {
	    $editValidator->assert($editForm);
	} catch(\InvalidArgumentException $e) {
		$editErrors = $e->findMessages(array('Display Name','Email','Real Name','Post Code','Phone Number','Address','The terms of use'));

	}
	if(!$editErrors){
//这里发邮件并且输入一个用户
    
		
			
			SharQueryAccount::updateUser($editForm[display_name],$uid);
			SharQueryAccount::updateUsermeta(array('first_name'=>$editForm[first_name],
				'middle_name'=>$editForm[middle_name],
				'last_name'=>$editForm[last_name],
				'phone_no'=>$editForm[phone_no],
				'postcode'=>$editForm[postcode],
				'address_1'=>$editForm[address_1],
				'address_2'=>$editForm[address_2]),
			$uid);
			SharIt::app()->flashMsg()->add('s',"Sign Up Success!");
			
		
	}
}
}else{
	SharIt::exception()->invalidOperation();
}

$_LAYOUT['left'] = SharIt::app()->loadView("user/include/ele_sideMenu.php");

$_LAYOUT['right'] = SharIt::app()->loadView("user/include/ele_edit.php", array('user' => $user, 'usermeta' => $usermeta,'editForm'=>$editForm,'editErrors'=>$editErrors));

SharIt::app()->layout($_LAYOUT,2);
?>