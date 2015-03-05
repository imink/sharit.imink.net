<?php
// anna
require_once(dirname(dirname(__FILE__))."/framework/import.php");
SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
$oid = SharIt::request()->get('oid');
if($array=SharQueryOrder::getOrder($oid)){
	if(SharIt::auth()->uid==$array[user_id]){
		if($array[status]==SharQuery::$STATUSCODE['order_status']['WAITSHIPPING']){
			$order=array('id'=>$oid);

			$_LAYOUT['mid'] =  SharIt::app()->loadView("order/include/ele_confirm_payment.php",array('order'=>$order));
		}else{
			SharIt::exception()->noOrderId();
		}
	}else{
		SharIt::exception()->NotAValidUser();
	}
}else{
	SharIt::exception()->noOrderId();
}


SharIt::app()->layout($_LAYOUT,1);
?>