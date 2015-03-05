<?php
//single item edit page
require_once(dirname(dirname(__FILE__))."/framework/import.php");

// SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
SharIt::page()->setTitle("Edit Product");
$publishForm;
$publishFormError = array();
$categoryList = SharQueryMain::listCategory();

$check=0;

if($publishForm =SharIt::request()->post('product')){
	

	$check=1;
	
	if($product= SharQueryProduct::getProduct($publishForm[pid])){
		if($product[user_id]!=SharIt::auth()->uid){
			SharIt::exception()->notOwnProduct();
		}
	}else{
		SharIt::exception()->noProduct();
	}

	if(!$publishForm[category_id]){
		$publishForm[category_id]=-1;
	}

	if(!$publishForm[product_condition]){
		$publishForm[product_condition]=-1;
	}

	// Create Validator
	$publishValidator = SharValidator::key('name', SharValidator::shar_required('Item Name'))
									->key('category_id', SharValidator::shar_notEmptyList('Category'))
									->key('product_condition', SharValidator::shar_notEmptyList('Condition'))
									->key('description', SharValidator::shar_required('Item Description'))
									->key('name', SharValidator::shar_productName('Item Name'))
									->key('description',SharValidator::shar_description('Item Description'));
	
						
	
	if($publishForm[on_bid]==0){
		$publishValidator->key('price', SharValidator::shar_required('Price'))
						->key('price', SharValidator::shar_productPrice('Price'));
	}

	if($publishForm[agree]){
		$publishValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}else{
		$publishForm[agree]='off';
		$publishValidator->key('agree',SharValidator::shar_ischosen('The terms of use'));
	}

	try {

	    $publishValidator->assert($publishForm);

	} catch(\InvalidArgumentException $e) {

		$publishFormError = $e->findMessages(array('Item Name','Category',
													'Condition','Item Description',
													'Price','Bid Expiration Date','The terms of use'));
	}

	if(!$publishFormError){

		$userid=SharIt::auth()->uid;

		if($userid == $product[user_id]){
			$update = SharQueryManageProduct::updateProduct(  
						                            $publishForm[pid],
													$publishForm[category_id], 
													$publishForm[name],
													$publishForm[description], 
													$publishForm[product_condition]);
			// MARK HERE 
			if($publishForm[on_bid]==1){
				SharQueryManageProduct::onBid($publishForm[pid],$publishForm[due_date]);
				SharQueryMain::insertPrice($publishForm[bid_price],$publishForm[pid]);
			}elseif($publishForm[on_bid]==0){
				SharQueryMain::insertPrice($publishForm[price],$publishForm[pid]);
			}
			SharIt::app()->flashMsg()->add('s',"Edit Succeed!");
			SharIt::app()->redirect("product/single-item.php",array('pid'=>$publishForm[pid]));
		}
	}
}else{
	$publishForm = SharQueryProduct::getProduct($pid);
}


if( $product = SharIt::request()->post('edit')){
	if(!$pid=SharIt::request()->post('pid')){
	SharIt::exception()->invalidOperation();
	}
	if($product= SharQueryProduct::getProduct($pid)){
		if($product[user_id]!=SharIt::auth()->uid){
			SharIt::exception()->notOwnProduct();
		}
	}else{
		SharIt::exception()->noProduct();
	}
	$check=1;
	$publishForm = SharQueryProduct::getProduct($pid);
	$publishForm[pid]=$publishForm[id];
}

if($check==0){
	SharIt::exception()->invalidOperation();
}


$_LAYOUT['mid'] =  SharIt::app()->loadView("user/include/ele_editProduct.php",array('formData'=>$publishForm,'publishFormErrors'=>$publishFormError,'categoryList'=>$categoryList));

SharIt::app()->layout($_LAYOUT,1);
?>