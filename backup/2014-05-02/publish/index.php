<?php
// publish index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

//validateGroup里面传递参数的时候，可以仿照这个写，切记大括号里的分号不能少
//function(){ //do something;} 其实是一个匿名函数（），anonymous function.
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
if(!$uid = SharIt::auth()->uid){
	$_LAYOUT['mid'] = SharIt::app()->loadView("publish/include/ele_no_authority.php");
}else{
SharIt::page()->setTitle("Publish");

$publishForm;
$publishFormError = array();
$categoryList = SharQueryMain::listCategory();

////////upload picture/////////
// $pictures = SharIt::request()->files();
// $uploadReturn = array();
// foreach ($pictures as $pic) {
// 	if(!$pic['name']){
// 		continue;
// 	}
// 	$return = SharFiles::uploadFile($pic,SHARIT_PATH_IMG,"productPic");
// 	array_push($uploadReturn, $return);
// }
////////upload picture/////////


if($publishForm =SharIt::request()->post('product')){

	if(!$publishForm[category]){
		$publishForm[category]=-1;
	}

	if(!$publishForm[condition]){
		$publishForm[condition]=-1;
	}

	// Create Validator
	$publishValidator = SharValidator::key('name', SharValidator::shar_required('Item Name'))
									->key('category', SharValidator::shar_notEmptyList('Category'))
									->key('condition', SharValidator::shar_notEmptyList('Condition'))
									->key('description', SharValidator::shar_required('Item Description'))
									->key('name', SharValidator::shar_productName('Item Name'))
									->key('description',SharValidator::shar_description('Item Description'));

	
	if($publishForm[on_bid]==0){
		$publishValidator->key('sell_price', SharValidator::shar_required('Price'))
						->key('sell_price', SharValidator::shar_productPrice('Price'));
	}elseif($publishForm[on_bid]==1){
		$publishValidator->key('bid_price', SharValidator::shar_required('Price'))
						->key('bid_price', SharValidator::shar_productPrice('Price'))
						->key('due_date',SharValidator::shar_productBidDate('Bid Expiration Date'));
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
													'Price','Bid Expiration Date',
													'The terms of use','Condition'));
	}

	$pictures = SharIt::request()->files();
	$countPic = 0;
	foreach ($pictures as $pic) {
		if($pic[name]){
			$countPic++;
		}
	}
	if($countPic==0){
		array_push($publishFormError, "You need to upload at least one picture for your product");
	}

	if(!$publishFormError){

		$userid=SharIt::auth()->uid;

		$productid = SharQueryManageProduct::insertProduct($userid, 
												$publishForm[name], 
												$publishForm[category], 
												$publishForm[condition], 
												$publishForm[description]);

		if($publishForm[on_bid]==1){
			SharQueryManageProduct::onBid($productid,$publishForm[due_date]);
			SharQueryMain::insertPrice($publishForm[bid_price],$productid);
		}elseif($publishForm[on_bid]==0){
			SharQueryMain::insertPrice($publishForm[sell_price],$productid);
		}

		$uploadReturn = array();
		foreach ($pictures as $pic) {
			if(!$pic['name']){
				continue;
			}
			$return = SharFiles::uploadFile($pic,SHARIT_PATH_IMG,"productPic");
			array_push($uploadReturn, $return);
		}

		foreach ($uploadReturn as $key => $value) {
			if($key==0){
				SharQueryPicture::insertPictureMain(array('id'=>$productid,'picture_name'=>$value[0]));
			}else{
				foreach($value as $id => $pic){
					SharQueryPicture::insertPictureNormal(array('id'=>$productid,'picture_name'=>$pic));
				}
			}
		}

		SharIt::app()->flashMsg()->add('s',"Publish Succeed!");
		SharIt::app()->redirect("product/single-item.php",array('pid'=>$productid));
	}
	
}
$_LAYOUT['mid'] = SharIt::app()->loadView("publish/include/ele_publish.php",array('formData'=>$publishForm,'publishFormErrors'=>$publishFormError,'categoryList'=>$categoryList));
}



SharIt::app()->layout($_LAYOUT,1);
?>