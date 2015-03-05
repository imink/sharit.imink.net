<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharValidator {
	public function shar_username(){
		$validator = Respect\Validation\Validator::create();
		return $validator->email()->setName("shar_username")->setTemplate("{{input}} is NOT a valid e-mail address");
	}
	// publish product starts
	public function shar_productName(){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,100)->setName("shar_productName")->setTemplate("{{input}} is NOT a valid product name");
	}
	public function shar_productCategory(){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->notEmpty()->setName("shar_productCategory")->setTemplate("{{input}} is NOT a valid category id");
	}
	public function shar_productCondition(){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->notEmpty()->setName("shar_productCondition")->setTemplate("{{input}} is NOT a valid condition id");
	}
	public function shar_productDescription(){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->notEmpty()->length(1,20000)->setName("shar_productDescription")->setTemplate("{{input}} is NOT a valid product description");
	}
	public function shar_productPrice(){
		$validator = Respect\Validation\Validator::create();
		return $validator->float()->notEmpty()->positive()->setName("shar_productPrice")->setTemplate("{{input}} is NOT a valid price");
	}
	public function shar_productBidDate(){
		$validator = Respect\Validation\Validator::create();
		return $validator->date('Y-m-d')->notEmpty()->min(SharUtil::dateToday(),true)->setName("shar_productBidDate")->setTemplate("{{input}} is NOT a valid date");
	}
	// publish product ends
	// register start
    public function shar_displayname(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(1,20)->setName("shar_displayname")->setTemplate("{{input}} is NOT a valid display name");
	}
	public function shar_email(){
		$validator = Respect\Validation\Validator::create();
		return $validator->email()->notEmpty()->setName("shar_email")->setTemplate("{{input}} is NOT a valid email address");
	}
	public function shar_password(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(8,20000)->setName("shar_password")->setTemplate("{{input}} is NOT a valid password");
	}
	public function shar_realname(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(1,50)->setName("shar_realname")->setTemplate("{{input}} exceeds the maximum limit of this value");
	}
    public function shar_phonenumber(){
		$validator = Respect\Validation\Validator::create();
		return $validator->digit()->notEmpty()->length(1,50)->setName("shar_telnum")->setTemplate("{{input}} is NOT a valid telephone number");
	}
	public function shar_postcode(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(1,50)->setName("shar_postcode")->setTemplate("{{input}} is NOT a valid postcode");
	}
    public function shar_address(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(1,50)->setName("shar_address")->setTemplate("{{input}} exceeds the maximum limit of this value");
	}
	//register end
	public static function __callStatic($ruleName, $arguments)
    {
		return Respect\Validation\Validator::__callStatic($ruleName, $arguments);

    }
}