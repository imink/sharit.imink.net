<?php
// supervisor userManagement.php
require_once(dirname(dirname(__FILE__))."/framework/import.php");
if(SharIt::auth()->uid){
$userid=SharIt::auth()->uid;
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
$gid=SharQuerySupervisor::getGid($userid);
if($gid==2){
    $userForm;
    $userErrors=array();

	if($userForm = SharIt::request()->get('userForm')){
        $userValidator = SharValidator::key('email', SharValidator::shar_required('Email'));
		try{
				//echo "n";
				$userValidator->assert($userForm);
				//echo"m";
			} catch(\InvalidArgumentException $e) {
				$userErrors = $e->findMessages(array('Email'));
			}	                                  


    if(!$userErrors){
		if($userForm[submit1]){

			SharQuerySupervisor::actUserS($userForm[id]);


		}elseif($userForm[submit2]){	   
			SharQuerySupervisor::frozenUser($userForm[id]);

		}
		elseif($userForm[submit3]){	
			SharQuerySupervisor::actUserS($userForm[id]);

		} 	

		if($userForm[submits]){

			if($userForm[action] == 0||$userForm[action] == 1){

				SharQuerySupervisor::deleteProductS($userForm[submits]);
				
			}
			elseif($userForm[action] == 2||$userForm[action] == 3)
				{ SharQuerySupervisor::restoreProductS($userForm[submits]);}

		}	
	}}else{
		$userForm[email]=SharIt::request()->get('email');
	}
	if(!$userForm[page]= SharIt::request()->get('page')){
			$userForm[page] = 1;
	}
	$userForm[perpage] = 9;

	$user=SharQuerySupervisor::getUserS($userForm[email]);
		$id=$user[id];
		$product=SharQuerySupervisor::listPublishS($id,$userForm[page]);

		$totalProduct=SharQuerySupervisor::countProductS($id);
		$totalPageNum=ceil($totalProduct/$userForm[perpage]);

$_LAYOUT['left'] =  SharIt::app()->loadView("supervisor/include/ele_sideMenu.php");
$_LAYOUT['right'] =  SharIt::app()->loadView("supervisor/include/ele_userInfo.php", array('user'=>$user,'userForm'=>$userForm,'product'=>$product,'totalPageNum'=>$totalPageNum,'userErrors'=>$userErrors));//,array('user_id'=>$user_id));
}else{
	SharIt::exception()->unAuth();
}
}else{
	SharIt::exception()->notAValidUser();
}
SharIt::app()->layout($_LAYOUT,2);
?>