<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryError
{
	
	private $eid;

	private static $errorInfo = array(
			'101'=>'The seller is not frozen but the product is sold out',
			'102'=>'The product is available but the seller is forzen',
			'103'=>'other error condition'
		);

	function __construct($eid){
		$this->eid = $eid;
	}

	function getErrorCode(){
		return $this->eid;
	}

	function getErrorInfo(){
		if(array_key_exists($this->eid, $errorInfo))
			return self::$errorInfo[$this->eid];
		else
			return "Unknow Error";
	}

	public static function isError($r){
		return is_a($r,'SharQueryError');
	}
	
}