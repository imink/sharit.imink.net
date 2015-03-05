<?php
// about us contact
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$contactForm = array();
$contactFormError = array();
$email_address;
$contact_name;

if($contactForm =SharIt::request()->post('contact')){

	if(!$contactForm[subject]){
		$contactForm[subject]=-1;
	}
	
	$contactValidator = SharValidator::key('content', SharValidator::shar_required('Content'))
									->key('subject', SharValidator::shar_notEmptyList('Contact subject'))
									->key('subject', SharValidator::shar_contactSubject('Contact subject'))
									->key('content', SharValidator::shar_contactContent('Content'));

	if(!SharIt::auth()->isLogin()){
		$contactValidator->key('email', SharValidator::shar_required('Email Address'))
						->key('name', SharValidator::shar_required('Your name'))
						->key('email', SharValidator::shar_email('Email Address'))
						->key('name', SharValidator::shar_contactName('The name you entered'));
	}
	
	try {
	    $contactValidator->assert($contactForm);
	} catch(\InvalidArgumentException $e) {
		$contactFormError = $e->findMessages(array('Contact subject','Content','email','name'));
	}

	if(!$contactFormError){
		$subject = '';
		if($contactForm[subject]==1){
			$subject = 'Query';
		}elseif ($contactForm[subject]==2) {
			$subject = 'Report';
		}elseif ($contactForm[subject]==3) {
			$subject = 'Suggestion';
		}

		if(SharIt::auth()->isLogin()){
			$userid=SharIt::auth()->uid;

			$user = array();
			$user = SharQueryAccount::getUser($userid);

			$email_address = $user[email];
			$contact_name = $user[display_name];
		}else{
			$email_address = $contactForm[email];
			$contact_name = $contactForm[name];
		}

		$mailer = SharIt::mailer();

		//Set who the message is to be sent from
		$mailer->setFrom($email_address, $contact_name);

		//Set who the message is to be sent to
		$mailer->addAddress(SHARIT_MAIL_ADDRESS, 'Supervisor');

		//Set the subject line
		$mailer->Subject = $subject;

		//message body
		$mailer->msgHTML($contactForm[content]);
		$mailer->AltBody = $contactForm[content];

		//send the message, check for errors
		if (!$mailer->send()) {
		    SharHTML::alert('danger',$mailer->ErrorInfo);
		} else {
		    SharIt::app()->flashMsg()->add('s',"Succeed! We will reply to you within three working days.");
		}

	}
}


$_LAYOUT['left'] =  SharIt::app()->loadView("about/include/ele_sideMenu.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("about/include/ele_contact.php",array('formData'=>$contactForm,'contactFormError'=>$contactFormError));

SharIt::app()->layout($_LAYOUT,2);
?>