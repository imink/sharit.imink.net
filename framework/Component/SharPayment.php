<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharPayment {

	public static function paymentCheck($data){

		if(self::paymentValidate($data)){
			$oid=$data[oid];
			SharQueryOrder::updateAfterPay($oid);
			return true;
		}
		return false;
	}
	
	private static function paymentValidate($data){
		//
		return true;
	}
}