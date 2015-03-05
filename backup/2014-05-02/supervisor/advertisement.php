	<?php
// supervisor advertisement.php

require_once(dirname(dirname(__FILE__))."/framework/import.php");
if(SharIt::auth()->uid){
$userid=SharIt::auth()->uid;
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
$gid=SharQuerySupervisor::getGid($userid);
if($gid==2){
$adForm ;
$adFormErrors=array();

if($adForm = SharIt::request()->post('adForm')){	
	$adValidator = SharValidator::key('product_id', SharValidator::shar_required('Product ID'))
								   ->key('title', SharValidator::shar_required('Title'))
	                               ->key('description', SharValidator::shar_required('Description'))
	                               ->key('title', SharValidator::shar_adName('Title'))
	                               ->key('description', SharValidator::shar_adDescription('Description'));

	try {
	    $adValidator->assert($adForm);
	} catch(\InvalidArgumentException $e) {
		$adFormErrors = $e->findMessages(array('Product ID','Title','Description'));
	}

	$picture = SharIt::request()->files('adpic');
	if($picture[name]==null){
		array_push($adFormErrors, "Please upload a picture for this product");
	}

	if(!$adFormErrors){
		$return = SharFiles::uploadFile($picture,SHARIT_PATH_IMG,"productPic");

		SharQuerySupervisor::insertPictureDisplay(array('id'=>$adForm[product_id],'picture_name'=>$return[0]));

	 	SharQuerySupervisor::insertAdvertisement($adForm[product_id],$adForm[title],$adForm[description]);
	  	SharIt::app()->flashMsg()->add('s', "Publish Succeed!");  
  	}	                               
}

if($adForm = SharIt::request()->post('delete')){
	SharQuerySupervisor::deleteAdvertisement();
	SharQuerySupervisor::deletePictureDisplay();
	SharIt::app()->flashMsg()->add('s', "Delete Succeed!");  
}


$_LAYOUT['left'] =  SharIt::app()->loadView("supervisor/include/ele_sideMenu.php");
$_LAYOUT['right'] =  SharIt::app()->loadView("supervisor/include/ele_advertisement.php",array('adForm'=>$adForm,'adFormErrors'=>$adFormErrors));
}
else{
	 SharIt::exception()->unAuth();
}
}else{
	SharIt::exception()->notAValidUser();
}
SharIt::app()->layout($_LAYOUT,2);
?>