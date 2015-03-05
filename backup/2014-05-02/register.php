<?php
// register page
require_once(dirname(__FILE__)."/framework/import.php");
SharIt::page()->setTitle("register");
$registerForm;
$registerErrors = array();
// print_r(SharIt::request()->post('register'));
if($registerForm = SharIt::request()->post('register')){
	$regisValidator = SharValidator::key('display_name', SharValidator::shar_required('Display Name'))
	                               ->key('email', SharValidator::shar_required('Email'))
	                               ->key('password', SharValidator::shar_required('Password'))
	                               ->key('display_name', SharValidator::shar_displayname('Display Name'))
	                               ->key('password', SharValidator::shar_password('Password'));
	                               
	
	if($registerForm['first_name']){
		
		$regisValidator = $regisValidator ->key('first_name',SharValidator::shar_realname('Real Name'));
	}
	if ($registerForm['middle_name']){
		
		$regisValidator = $regisValidator ->key('middle_name',SharValidator::shar_realname('Real Name'));
	}
	if($registerForm['last_name']){
		
		$regisValidator = $regisValidator ->key('last_name',SharValidator::shar_realname('Real Name'));
	}
	if($registerForm['phone_no']){
		
		$regisValidator = $regisValidator ->key('phone_no',SharValidator::shar_phonenumber('Phone Number'));
	}
	if($registerForm['postcode']){
		
		$regisValidator = $regisValidator ->key('postcode',SharValidator::shar_postcode('Post Code'));
	}
	if($registerForm['address_1']){
		
        $regisValidator = $regisValidator ->key('address_1',SharValidator::shar_address('Address'));
	}
	if($registerForm['address_2']){
		
        $regisValidator = $regisValidator ->key('address_2',SharValidator::shar_address('Address'));
	}
	
	if($registerForm[agree]){
		 $regisValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}else{
		$registerForm[agree]='off';
		 $regisValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}
	                              
	try {
	    $regisValidator->assert($registerForm);
	} catch(\InvalidArgumentException $e) {
		$registerErrors = $e->findMessages(array('Display Name','Email','Password','Real Name','Post Code','Phone Number','Address','The terms of use'));

	}
	if(!$registerErrors){
		if(!$check=SharQueryAuth::getUserForUsername($registerForm['email'] . SHARIT_EMAIL_SUFIX)){
			if(true){
				$uid = SharQuerySignUp::insertUser( $registerForm['email'] . SHARIT_EMAIL_SUFIX, md5($registerForm['password']), $registerForm['display_name']);
			//这里发邮件并且输入一个用户

				$activation = SharIt::auth()->activation($uid);
				$url = SharIt::app()->createUrl('user/activate',array('uid'=>$uid,'activation'=>$activation));

				$mailer = SharIt::mailer();

			//Set who the message is to be sent from
				$mailer->addAddress($registerForm['email'] . SHARIT_EMAIL_SUFIX, $registerForm['display_name']);

			//Set who the message is to be sent to
				$mailer->setFrom(SHARIT_MAIL_ADDRESS, 'SharIT');

			//Set the subject line
				$mailer->Subject = 'Activate your account in SharIt';

			//message body
				$message = 'Please click the following link to finish your registration: <br /><a href="$url">'.$url.
				'</a><br /><br />If the link is disabled, please copy the link to the new tab page.';
				$mailer->msgHTML($message);
				$mailer->AltBody = $message;

			//send the message, check for errors
				if (!$mailer->send()) {
					SharHTML::alert('danger',$mailer->ErrorInfo);
				} else {
					SharIt::app()->flashMsg()->add('s',"Succeed! Please check your mailbox to activate your account.");
				}

			}else{
				array_push($registerErrors, SharIt::auth()->getError());
			}
		}else{
			SharIt::app()->flashMsg()->add('e',"Sorry! This email address has been registered before. Please use another email address.");
		}
	}
}




$_LAYOUT['mid'] =  SharIt::app()->loadView("index.php",array('registerForm'=>$registerForm,'registerErrors'=>$registerErrors));
SharIt::app()->layout($_LAYOUT,1);
?>