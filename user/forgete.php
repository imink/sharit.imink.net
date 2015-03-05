<?php

require_once(dirname(dirname(__FILE__))."/framework/import.php");
$forgetForm;
$forgetErrors = array();

if($forgetForm=SharIt::request()->post('forget')){
	$forgetForm[email_tmp] =  $forgetForm[email].SHARIT_EMAIL_SUFIX;
	$forgetValidator = SharValidator::key('email_tmp', SharValidator::shar_required('Email'));
	try {
		$forgetValidator->assert($forgetForm);
	} catch(\InvalidArgumentException $e) {
		$forgetErrors = $e->findMessages(array('Email'));
	}

	if(!$forgetErrors){
		if($check=SharQueryAuth::getUserForUsername($forgetForm['email_tmp'])){
			//这里发邮件并且输入一个用户
				$change=SharIt::auth()->activation($check[id]);
				$url = SharIt::app()->createUrl('user/forgetPassword',array('uid'=>$check[id],'forgetCode'=>$change));

				$mailer = SharIt::mailer();

			//Set who the message is to be sent from
				$mailer->addAddress($forgetForm['email'] . SHARIT_EMAIL_SUFIX, $check['display_name']);

			//Set who the message is to be sent to
				$mailer->setFrom(SHARIT_MAIL_ADDRESS, 'SharIT');

			//Set the subject line
				$mailer->Subject = 'Forget your password?';

			//message body
				$message = 'Please click the following link to finish password changing: <br /><a href="$url">'.$url.
				'</a><br />If the link is disabled, please copy the link to the new tab page.';
				$mailer->msgHTML($message);
				$mailer->AltBody = $message;

			//send the message, check for errors
				if (!$mailer->send()) {
					array_push($forgetErrors, $mailer->ErrorInfo);
				} else {
					SharIt::app()->flashMsg()->add('s',"Succeed! Please check your mailbox to change your password.");
					SharIt::app()->redirect('login.php');
				}

		}else{
			SharIt::app()->flashMsg()->add('e',"Sorry! This email address has not been registered before. Please check your email address.");
		}
	}
}


$_LAYOUT['mid'] =  SharIt::app()->loadView("user/include/ele_forgete.php",array('forgetForm'=>$forgetForm,'forgetErrors'=>$forgetErrors));
SharIt::app()->layout($_LAYOUT,1);

?>