<?php
// view order
require_once(dirname(dirname(__FILE__))."/framework/import.php");

SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});

if($oid = SharIt::request()->get('oid')){

if($productAndOrderData=SharQueryOrder::getOrder($oid)){
	if(SharIt::auth()->uid==$productAndOrderData['user_id']||SharIt::auth()->uid==$productAndOrderData['seller_id']){
		if($productAndOrderData['status']!=SharQuery::$STATUSCODE['order_status']['CANCELED']){
			if($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['WAITPAYMENT']&&SharIt::auth()->uid==$productAndOrderData['user_id']){
				$buyer_id=SharIt::auth()->uid;
				$buyerData=SharQueryAccount::getUser($buyer_id);

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_buyer_pay.php",array('productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['WAITPAYMENT']&&SharIt::auth()->uid==$productAndOrderData['seller_id']) {
				$buyer_id = $productAndOrderData['user_id'];
				$buyerData=SharQueryAccount::getUser($buyer_id);
				$priceForm;
				$formError = array();
				if($priceForm = SharIt::request()->post('order')){
					$priceValidator = SharValidator::key('price', SharValidator::shar_required('Price'))
					->key('price', SharValidator::shar_productPrice('Price'));
					try {
						$priceValidator->assert($priceForm);
					} catch(\InvalidArgumentException $e) {
						$formError = $e->findMessages(array('Price'));
					}
					if(!$formError){
						if(SharQueryMain::insertPrice($priceForm[price], $productAndOrderData[product_id])){
							SharIt::app()->flashMsg()->add('s',"Price Changed Successful!");
							SharIt::app()->redirect("order/view_order.php",array('oid'=>$productAndOrderData[id]));
						}	
					}
				}	
				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_seller_change_price.php",array('priceForm'=>$priceForm,'productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData,'formError'=>$formError));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['WAITSHIPPING']&&SharIt::auth()->uid==$productAndOrderData['user_id']){
				$buyer_id=SharIt::auth()->uid;
				$buyerData=SharQueryAccount::getUser($buyer_id);

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_after.php",array('productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['WAITSHIPPING']&&SharIt::auth()->uid==$productAndOrderData['seller_id']) {
				$buyer_id = $productAndOrderData['user_id'];
				$buyerData=SharQueryAccount::getUser($buyer_id);

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_seller_dispatch.php",array('productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['DISPATCHED']&&SharIt::auth()->uid==$productAndOrderData['user_id']){
				$buyer_id=SharIt::auth()->uid;
				$buyerData=SharQueryAccount::getUser($buyer_id);
				$reviewBuyerForm;
				$formError = array();
				if($reviewBuyerForm = SharIt::request()->post('order')){
					$reviewBuyerValidator = SharValidator::key('review_describe', SharValidator::shar_required('Item as Described'))
					->key('review_describe', SharValidator::shar_review('Item as Described'))
					->key('review_com', SharValidator::shar_required('Communication'))
					->key('review_com', SharValidator::shar_review('Communication'))
					->key('review_ship', SharValidator::shar_required('Shipping Speed'))
					->key('review_ship', SharValidator::shar_review('Shipping Speed'));
					try {
						$reviewBuyerValidator->assert($reviewBuyerForm);
					} catch(\InvalidArgumentException $e) {
						$formError = $e->findMessages(array('Item as Described','Communication','Shipping Speed'));
					}
					if(!$formError){
						if(SharQueryOrder::updateBuyerReview($oid, $reviewBuyerForm[review_describe],$reviewBuyerForm[review_com],$reviewBuyerForm[review_ship])){
							SharIt::app()->flashMsg()->add('s',"Review Successful!");
							SharIt::app()->redirect("order/view_order.php",array('oid'=>$productAndOrderData[id]));
						}	
					}	
				}

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_review_buyer.php",array('reviewBuyerForm'=>$reviewBuyerForm,'productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData,'formError'=>$formError));
			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['DISPATCHED']&&SharIt::auth()->uid==$productAndOrderData['seller_id']) {
				$buyer_id = $productAndOrderData['user_id'];
				$buyerData=SharQueryAccount::getUser($buyer_id);

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_after.php",array('productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['BUYERREVIEWING']&&SharIt::auth()->uid==$productAndOrderData['user_id']){

				$buyer_id=SharIt::auth()->uid;
				$buyerData=SharQueryAccount::getUser($buyer_id);

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_after.php",array('productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['BUYERREVIEWING']&&SharIt::auth()->uid==$productAndOrderData['seller_id']) {
				$buyer_id = $productAndOrderData['user_id'];
				$buyerData=SharQueryAccount::getUser($buyer_id);
				$reviewSellerForm;
				$formError = array();
				if($reviewSellerForm = SharIt::request()->post('order')){
					$reviewSellerValidator = SharValidator::key('review_attitude', SharValidator::shar_required('Attitude'))
					->key('review_attitude', SharValidator::shar_review('Attitude'))
					->key('review_speed', SharValidator::shar_required('Confirmation Speed'))
					->key('review_speed', SharValidator::shar_review('Confirmation Speed'));
					try {
						$reviewSellerValidator->assert($reviewSellerForm);
					} catch(\InvalidArgumentException $e) {
						$formError = $e->findMessages(array('Attitude','Confirmation Speed'));
					}
					if(!$formError){
						if(SharQueryOrder::succeed($oid, $reviewSellerForm[review_attitude],$reviewSellerForm[review_speed])){
							$order_info = SharQueryOrder::getOrder($oid);
							if(SharQueryOrder::updateUserReview($oid,$order_info[review_describe],$order_info[review_com],
								$order_info[review_ship],$order_info[review_attitude],$order_info[review_speed])){
								SharIt::app()->flashMsg()->add('s',"Review Successful!");
							SharIt::app()->redirect("order/view_order.php",array('oid'=>$productAndOrderData[id]));
						}	
					}	
				}	
			}
			$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_review_seller.php",array('reviewSellerForm'=>$reviewSellerForm,'productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData,'formError'=>$formError));

			}elseif($productAndOrderData['status']==SharQuery::$STATUSCODE['order_status']['SUCCEED']){

				if(SharIt::auth()->uid==$productAndOrderData['user_id']){
					$buyer_id=SharIt::auth()->uid;
					$buyerData=SharQueryAccount::getUser($buyer_id);
				}else{
					$buyer_id = $productAndOrderData['user_id'];
					$buyerData=SharQueryAccount::getUser($buyer_id);
				}

				$_LAYOUT['mid'] = SharIt::app()->loadView("order/include/ele_final.php",array('productData'=>$productAndOrderData,'buyerData'=>$buyerData,'orderData'=>$productAndOrderData));
			}
			SharIt::app()->layout($_LAYOUT,1);
		}else{
			SharIt::exception()->cancelOrder();
		}
		
	}else{
		echo "Not seller or buyer";
		SharIt::exception()->notSellerOrBuyer();
	}
}else{
		SharIt::exception()->noOrderId();
}
}else{
	SharIt::exception()->invalidOperation();
}


?>