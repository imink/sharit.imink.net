<?php
// order checkout
require_once(dirname(dirname(__FILE__))."/framework/import.php");
SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});

if($pid = SharIt::request()->get('pid')){

	if($product = SharQueryProduct::getProduct($pid)){
		if(SharIt::auth()->uid==$product[user_id] ){
			SharIt::exception()->ownProduct();
		}
		if(!$product['status']==SharQuery::$STATUSCODE['product_status']['ONSELL']){
			SharIt::exception()->alreadySoldOut();
		}
		$seller = SharQueryAccount::getUser($product['user_id']);
		$product['seller_email']=$seller['email'];
		$buyer = SharQueryAccount::getUser(SharIt::auth()->uid);
		$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_checkout.php",array('productData'=>$product,'buyerData'=>$buyer));
		SharIt::app()->layout($_LAYOUT,1);
	}else{
		SharIt::exception()->noProduct();

	}
	
}
SharIt::exception()->unAuth();
?>