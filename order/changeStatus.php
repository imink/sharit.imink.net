<?php
// order payment
require_once(dirname(dirname(__FILE__))."/framework/import.php");
SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});

if($order = SharIt::request()->post('order')){
	if($order['confirm']){
		if($product = SharQueryProduct::getProduct($order[pid])){
		//$order[pid];
			if(SharIt::auth()->uid==$product[user_id] ){
				echo "Seller could not buy own product";
				SharIt::exception()->ownProduct();
			}
			if(!$product['status']==SharQuery::$STATUSCODE['product_status']['ONSELL']){
				SharIt::exception()->alreadySoldOut();
			}
			$result = SharQueryOrder::insertOrder($order[pid],SharIt::auth()->uid);
			if(SharQueryError::isError($result)){
				echo "cannot insert order";
				SharIt::exception()->unAuth();
			}else{
				SharIt::app()->redirect("order/view_order.php",array('oid'=>$result));
			}
		}else{
			echo "NO this product";
			SharIt::exception()->noProduct();
		}
	}elseif($order['dispatch']){
		$oid=$order[oid];
		if($array=SharQueryOrder::getOrder($oid)){
			if(SharIt::auth()->uid==$array[seller_id]){
				if($array[status]!=SharQuery::$STATUSCODE['order_status']['CANCELED']){
					SharQueryOrder::updateAfterShip($oid);
					//TODO EMAIL
					SharIt::app()->redirect("order/view_order.php",array('oid'=>$oid));
				}else{
					SharIt::exception()->cancelOrder();
				}
			}else{
				SharIt::exception()->NotAValidUser();
			}
		}else{
			SharIt::exception()->noOrderId();
		}

	}elseif($order['cancelb']){
		$oid=$order[oid];
		if($array=SharQueryOrder::getOrder($oid)){
			if(SharIt::auth()->uid==$array[user_id]){
				if($array[status]!=SharQuery::$STATUSCODE['order_status']['CANCELED']){
					if($array[status]==SharQuery::$STATUSCODE['order_status']['WAITPAYMENT']){
						SharQueryOrder::cancel($oid);
						SharIt::app()->redirect("product/single-item.php",array('pid'=>$array[product_id]));
					}else{
						SharIt::exception()->invalidOperation();
					}

				}else{
					SharIt::exception()->cancelOrder();
				}
			}else{
				SharIt::exception()->NotAValidUser();
			}

		}else{
			SharIt::exception()->noOrderId();
		}

	}elseif($order['cancels']){
		$oid=$order[oid];
		if($array=SharQueryOrder::getOrder($oid)){
			if(SharIt::auth()->uid==$array[seller_id]){
				if($array[status]!=SharQuery::$STATUSCODE['order_status']['CANCELED']){
					if($array[status]==SharQuery::$STATUSCODE['order_status']['WAITPAYMENT']){
						SharQueryOrder::cancel($oid);
						SharIt::app()->redirect("product/single-item.php",array('pid'=>$array[product_id]));
					}else{
						SharIt::exception()->invalidOperation();
					}

				}else{
					SharIt::exception()->cancelOrder();
				}
			}else{

				SharIt::exception()->NotAValidUser();
			}

		}else{
			SharIt::exception()->noOrderId();
		}
	}
}
SharIt::exception()->invalidOperation();
?>