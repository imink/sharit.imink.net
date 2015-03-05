<?php
// supervisor advertisement.php

require_once(dirname(dirname(__FILE__))."/framework/import.php");
if(SharIt::auth()->uid){
$userid=SharIt::auth()->uid;
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
$gid=SharQuerySupervisor::getGid($userid);
if($gid==2){
	$check=array();
	
if($pForm = SharIt::request()->get('pForm')){
	
		
	
if($pForm[submits]||$pForm[id]){

	if($pForm[action] == 0||$pForm[action] == 1){
				SharQuerySupervisor::deleteProductS($pForm[submits]);}
	if($pForm[action] == 2||$pForm[action] == 3){
				SharQuerySupervisor::restoreProductS($pForm[submits]);}
	
	if($pForm[id]){
		$product=SharQueryProduct::getProduct($pForm[id]);
		if($product){
			$check['check']='true';
		}else{
			$check['check']='false';
		}
		$priceHistory=SharQueryProduct::listPrice($pForm[id]);
	}else{
		$product=SharQueryProduct::getProduct($pForm[submits]);
		$priceHistory=SharQueryProduct::listPrice($pForm[submits]);
	}	
    $user=SharQueryAccount::getUser($product[user_id]); 
} 

}



$_LAYOUT['left'] =  SharIt::app()->loadView("supervisor/include/ele_sideMenu.php");
$_LAYOUT['right'] =  SharIt::app()->loadView("supervisor/include/ele_productInfo.php",array('user'=>$user,'pForm'=>$pForm,'product'=>$product,'priceHistory'=>$priceHistory,'pErrors'=>$pErrors,'check'=>$check));
}else{
	SharIt::exception()->unAuth();
}
}else{
	SharIt::exception()->notAValidUser();
}
SharIt::app()->layout($_LAYOUT,2);
?>