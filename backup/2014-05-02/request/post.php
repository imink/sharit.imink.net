<?php
// request post
require_once(dirname(dirname(__FILE__))."/framework/import.php");


if(!$uid = SharIt::auth()->uid){
	$_LAYOUT['right'] =  SharIt::app()->loadView("request/include/ele_no_authority.php");
}else{
	$gid=SharQuerySupervisor::getGid($uid);
	if($gid==2){
		SharIt::exception()->unAuth();
	}

$requestForm = array();
$requestFormError = array();
$categoryList = SharQueryMain::listCategory();

if($requestForm =SharIt::request()->post('requestForm')){

	if(!$requestForm[category]){
		$requestForm[category]=-1;
	}

	// Create Validator
	$requestValidator = SharValidator::key('topic', SharValidator::shar_required('Request Topic'))
									->key('category', SharValidator::shar_notEmptyList('Category'))
									->key('message', SharValidator::shar_required('Description'))
									->key('topic', SharValidator::shar_requestTopic('Request Topic'))
									->key('message',SharValidator::shar_description('Description'));
if($requestForm[agree]){
		$requestValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}else{
		$requestForm[agree]='off';
		$requestValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}

	try {
	    $requestValidator->assert($requestForm);
	} catch(\InvalidArgumentException $e) {
		$requestFormError = $e->findMessages(array('Category','Request Topic','Description','The terms of use'));
	}

	if(!$requestFormError){
		$userid=SharIt::auth()->uid;
		$requestid = SharQueryRequest::insertRequest($requestForm[category], 
															$userid, 
															$requestForm[topic], 
															$requestForm[message]);

		SharIt::app()->flashMsg()->add('s',"Request Succeed!");
		SharIt::app()->redirect("request/single.php",array('id'=>$requestid));
	}
	
}
$_LAYOUT['right'] =  SharIt::app()->loadView("request/include/ele_post.php",array('categoryList'=>$categoryList,'requestForm'=>$requestForm,'requestFormErrors'=>$requestFormError));
}

$_LAYOUT['left'] =  SharIt::app()->loadView("request/include/ele_sideMenu.php");



SharIt::app()->layout($_LAYOUT,2);
?>