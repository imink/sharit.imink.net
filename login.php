<?php
require_once("./framework/import.php");
SharIt::page()->setTitle("Login");

if($uid = SharIt::auth()->uid){
	$_LAYOUT['mid'] = SharIt::app()->loadView('include/ele_have_login.php');

    SharIt::app()->layout($_LAYOUT,1);

}else{
$loginForm;
$loginErrors = array();


if($loginForm = SharIt::request()->post('login')){

	if(!$loginErrors){
		if(SharIt::auth()->login($loginForm['email'].SHARIT_EMAIL_SUFIX,$loginForm['password'],$loginFrom['remember'])){
			SharIt::app()->flashMsg()->add('s',"Login Success!");
			SharIt::app()->redirect();
		}else{
			array_push($loginErrors, SharIt::auth()->getError());
		}
	}
}
$_LAYOUT['left'] = SharIt::app()->loadView('include/ele_advertisement.php');
$_LAYOUT['right'] = SharIt::app()->loadView('include/ele_login.php',array('loginForm'=>$loginForm,'loginFormErrors'=>$loginErrors));

SharIt::app()->layout($_LAYOUT,2);
}
?>