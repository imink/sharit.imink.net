<?php
// User Q and A
require_once(dirname(dirname(__FILE__))."/framework/import.php");
// Get current user id

if($uid = SharIt::auth()->uid){

if(!$filter[pageq] = SharIt::request()->get('page')){
	$filter[pageq] = 1;
}
if(!$filter[pagea] = SharIt::request()->get('page')){
	$filter[pagea] = 1;
}
$filter[perpage]=10;

$question = SharQueryRecord::listQuestion($uid,$filter[pageq],$filter[perpage]);

$totalQuestion=SharQueryRecord::countQuestion($uid);
$totalPageNum[question]=ceil($totalQuestion/$filter[perpage]);

$answer = SharQueryRecord::listAnswer($uid, $filter[pagea],$filter[perpage]);

$totalAnswer=SharQueryRecord::countAnswer($uid);
$totalPageNum[answer]=ceil($totalAnswer/$filter[perpage]);

}else{
		SharIt::exception()->NotAValidUser();
}

$_LAYOUT['left'] =  SharIt::app()->loadView("user/include/ele_sideMenu.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("user/include/ele_q&a.php", array('question' => $question, 'answer' => $answer, 'filter'=>$filter,'totalPageNum'=>$totalPageNum));

SharIt::app()->layout($_LAYOUT,2);
?>