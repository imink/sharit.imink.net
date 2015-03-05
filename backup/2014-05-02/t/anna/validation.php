<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharValidator {
	public function shar_displayname(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(1,20)->setName("shar_displayname")->setTemplate("{{input}} is NOT a valid display name");
	}
	public function shar_email(){
		$validator = Respect\Validation\Validator::create();
		return $validator->notEmpty()->email()->setName("shar_email")->setTemplate("{{input}} is NOT a valid email address");
	}
	public function shar_password(){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->notEmpty()->length(8,20000)->setName("shar_prassword")->setTemplate("{{input}} is NOT a valid password");
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
	public function shar_agree(){
		$validator = Respect\Validation\Validator::create();
		return $validator->notEmpty()->setName("shar_agree")->setTemplate("{{input}} can not be recognized");
	}
	public static function __callStatic($ruleName, $arguments)
    {
		return Respect\Validation\Validator::__callStatic($ruleName, $arguments);

    }
}