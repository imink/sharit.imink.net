<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharException
{
	private static $errorView;

	function __construct(){
		self::$errorView = self::refineErrorHandler(SHARIT_PATH_ERRORVIEW);
	}

	private static function exceptionCodeMessage($code){
		switch ($code) {
			case 'A01':
				$message = "Invalid User Group";
				break;
			case 'A02':
				$message = "Not a valid user";
				break;
			case 'A03':
				$message = "Invalid order";
				break;
			case 'A04':
				$message = "You are not this product's seller or buyer";
				break;
			case 'A05':
				$message = "No this product";
				break;
			case 'A06':
				$message = "This product has already sold out";
				break;
			case 'A07':
				$message = "You can not buy your own product";
				break;
			case 'A08':
				$message = "This order has already been canceled";
				break;
			case 'A09':
				$message = "Invalid operation";
				break;
			case 'A10':
				$message = "Your payment is failed";
				break;
			case 'A11':
				$message = "Your are not the owner of this product";
				break;
			case 'A12':
				$message = "Your are the owner of this product";
				break;
			case 'A13':
				$message = "Wrong activation code";
				break;
			case 'A14':
				$message = "User has already been activated";
				break;
			case 'A15':
				$message = "Wrong change code";
				break;
			default:
				$message = "Unknown Error";
				break;
		}
		return $message;
	}

	private static function refineErrorHandler($errorHandler){
		if (substr($errorHandler, -strlen(".php")) !== ".php") {
			$errorHandler.=".php";
		}
		return $errorHandler;
	}

	public function unAuth(){
		$code ='A01';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function notAValidUser(){
		$code ='A02';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function noOrderId(){
		$code ='A03';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function notSellerOrBuyer(){
		$code ='A04';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function noProduct(){
		$code ='A05';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function alreadySoldOut(){
		$code ='A06';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function ownProduct(){
		$code ='A07';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function cancelOrder(){
		$code ='A08';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function invalidOperation(){
		$code ='A09';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function invalidPayment(){
		$code ='A10';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function notOwnProduct(){
		$code ='A11';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function askOwnProduct(){
		$code ='A12';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function wrongActivationCode(){
		$code ='A13';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

		public function alreadyActivated(){
		$code ='A14';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

	public function wrongChangeCode(){
		$code ='A15';
		$message = self::exceptionCodeMessage($code);
		$layout['mid'] = SharIt::app()->loadView(self::$errorView,array('code'=>$code,'message'=>$message));
		SharIt::app()->layout($layout, 1);
		exit();
	}

}