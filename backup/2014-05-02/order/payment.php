<?php
// order payment
require_once(dirname(dirname(__FILE__))."/framework/import.php");

SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
$paymentFormError = array();
$check=0;
if($order = SharIt::request()->post('order')){
	$check=1;
	if($order['pay']){
		$oid=$order[oid];
		$orderInfo=SharQueryOrder::getOrder($oid);
		if($orderInfo){
			$buyer=$orderInfo[user_id];
			if(SharIt::auth()->uid==$buyer){

				$buyerInfo=SharQueryAccount::getUsermeta($buyer);

				if($buyerInfo['first_name']){
					$orderInfo[buyer_name]=$buyerInfo['first_name'];
				}
				if($buyerInfo['middle_name']){
					$orderInfo[buyer_name].=' '.$buyerInfo['middle_name'];
				}
				if($buyerInfo['last_name']){
					$orderInfo[buyer_name].=' '.$buyerInfo['last_name'];
				}
				if($buyerInfo['postcode']){
					$orderInfo[postcode]=$buyerInfo['postcode'];
				}
				if($buyerInfo['phone_no']){
					$orderInfo[phone]=$buyerInfo['phone_no'];
				}
				if($buyerInfo['address_1']){
					$orderInfo[address1]=$buyerInfo['address_1'];
				}
				if($buyerInfo['address_2']){
					$orderInfo[address2]=$buyerInfo['address_2'];
				}
				$_LAYOUT['mid'] =  SharIt::app()->loadView("order/include/ele_payment.php", array('orderInfo'=>$orderInfo));
			}else{
				SharIt::exception()->NotAValidUser();
			}
		}else{
			SharIt::exception()->noOrderId();
		}
	}else{
		SharIt::exception()->invalidOperation();
	}
}

if($orderInfo = SharIt::request()->post('payment')){
	$check=1;
	if($orderInfo[submit]){
		if($array=SharQueryOrder::getOrder($orderInfo[oid])){
			if(SharIt::auth()->uid==$array[user_id]){

		$paymentValidator=SharValidator::key('cardnumber', SharValidator::shar_required('Card number'))
										->key('cardnumber', SharValidator::shar_card('Card number'))
										->key('cardholder', SharValidator::shar_required('Card holder'))
										->key('cardholder', SharValidator::shar_realname('Card holder'))
										->key('buyer_name',SharValidator::shar_required('Name'))
										->key('buyer_name',SharValidator::shar_realname('Name'))
										->key('address1', SharValidator::shar_required('Address1'))
										->key('address1', SharValidator::shar_address('Address1'))
										->key('address2', SharValidator::shar_address('Address2'))
										->key('postcode', SharValidator::shar_required('Postcode'))
										->key('postcode', SharValidator::shar_postcode('Postcode'))
										->key('phone',SharValidator::shar_required('Phone'))
										->key('phone',SharValidator::shar_phonenumber('Phone'));
	if($orderInfo[month]){
		$paymentValidator->key('month', SharValidator::shar_required('Month'));
	}else{
		$orderInfo[month]=null;
		$paymentValidator->key('month', SharValidator::shar_required('Month'));
	}

	if($orderInfo[year]){
		$paymentValidator->key('year',SharValidator::shar_required('Year'));
	}else{
		$orderInfo[year]=null;
		$paymentValidator->key('year',SharValidator::shar_required('Year'));
	}

	if($orderInfo[terms]){
		$paymentValidator->key('terms',SharValidator::shar_ischosen('The terms of use'));
	}else{
		$orderInfo[terms]='off';
		$paymentValidator->key('terms',SharValidator::shar_ischosen('The terms of use'));
	}

	if($orderInfo[paypal]=='on'||$orderInfo[visa]=='on'||$orderInfo[master]=='on'){
		$orderInfo[cardtype]=1;
		$paymentValidator->key('cardtype',SharValidator::shar_cardtype('The card type'));
	}else{
		$orderInfo[cardtype]=0;
		$paymentValidator->key('cardtype',SharValidator::shar_cardtype('The card type'));
	}


	if($orderInfo[paypal]=='on'&&$orderInfo[visa]==null&&$orderInfo[master]==null){
		$orderInfo[cardchosen]=1;
		$paymentValidator->key('cardchosen',SharValidator::shar_cardchosen('You cannot'));
	}elseif($orderInfo[paypal]==null&&$orderInfo[visa]=='on'&&$orderInfo[master]==null){
		$orderInfo[cardchosen]=1;
		$paymentValidator->key('cardchosen',SharValidator::shar_cardchosen('You cannot'));
	}elseif($orderInfo[paypal]==null&&$orderInfo[visa]==null&&$orderInfo[master]=='on'){
		$orderInfo[cardchosen]=1;
		$paymentValidator->key('cardchosen',SharValidator::shar_cardchosen('You cannot'));
	}else{
		$orderInfo[cardchosen]=0;
		$paymentValidator->key('cardchosen',SharValidator::shar_cardchosen('You cannot'));
	}


	try {

	    $paymentValidator->assert($orderInfo);
	} catch(\InvalidArgumentException $e) {

		$paymentFormError = $e->findMessages(array('Card number','Month',
													'Year','Card holder',
													'Name','Address1',
													'Address2','Postcode',
													'Phone','The terms of use',
													'The card type','You cannot'));
	}

	if(!$paymentFormError){
		if(SharPayment::paymentCheck($orderInfo)){
			//TODO EMAIL
			SharIt::app()->redirect("order/confirm_payment.php",array('oid'=>$orderInfo[oid]));
		}else{
			SharIt::exception()->invalidPayment();
		}
	}else{
		$orderInfo[id]=$orderInfo[oid];
		$_LAYOUT['mid'] =  SharIt::app()->loadView("order/include/ele_payment.php", array('orderInfo'=>$orderInfo,'paymentFormError'=>$paymentFormError));
	}

}else{
	SharIt::exception()->NotAValidUser();
}

}else{
	SharIt::exception()->noOrderId();
}
}else{
	SharIt::exception()->invalidOperation();
}
}

if($check==0){
	SharIt::exception()->invalidOperation();
}
SharIt::app()->layout($_LAYOUT,1);
?>