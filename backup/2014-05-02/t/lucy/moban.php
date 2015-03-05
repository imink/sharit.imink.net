<?php
// publish index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$publishForm;
$publishFormError = array();

$userid;


if($publishForm = SharIt::request()->post('product')){
	// Create Validator
	$publishValidator = SharValidator::key('name', SharValidator::shar_productName())
									->key('category',SharValidator::shar_productCategory())
									->key('condition',SharValidator::shar_productCondition())
									->key('description',SharValidator::shar_productDescription())
									->key('price', SharValidator::shar_productPrice())
									->key('due_date',SharValidator::shar_productBidDate());

	try {
	    $publishValidator->assert($publishForm);
	} catch(\InvalidArgumentException $e) {
		$publishFormError = $e->findMessages(array('shar_productname'));
	}


	if(!$publishFormError){
		$userid=SharIt::auth()->uid;
		$productid = SharQueryManageProduct::insertProduct($userid, 
												$publishForm[name], 
												$publishForm[category], 
												$publishForm[condition], 
												$publishForm[description]);
		if($publishForm[on_bid]==1){
			SharQueryManageProduct::onBid($id,$due_date)
		}

		if($a = false){
			array_push($publishFormError, "写入失败");
		}elseif(xxx){

		}else{
			SharIt::app()->flashMsg()->add('s',"Publish Succeed!");
			SharIt::app()->redirect("product/item.php",array('id'=>$a));
		}

	}
}


$_LAYOUT['mid'] =  SharIt::app()->loadView("publish/include/ele_publish.php",array('formData'=>$publishForm,'publishFormErrors'=>$publishFormError));

SharIt::app()->layout($_LAYOUT,1);
?>