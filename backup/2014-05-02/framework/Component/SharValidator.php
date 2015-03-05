<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharValidator {
	// shared validator starts
	public function shar_email($name,$template="{{input}} is NOT a valid e-mail address"){
		$validator = Respect\Validation\Validator::create();
		return $validator->email()->setName($name)->setTemplate($template);
	}

	public function shar_required($name,$template="{{name}} must not be empty"){
		$validator = Respect\Validation\Validator::create();
		return $validator->notEmpty()->setName($name)->setTemplate($template);
	}

	// public function shar_category($name,$template="{{name}} must be chosen from the dropdown list"){
	// 	$validator = Respect\Validation\Validator::create();
	// 	return $validator->int()->positive()->max(50)->setName($name)->setTemplate($template);
	// }

	public function shar_description($name,$template="{{name}} exceeds the maximun word length"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,20000)->setName($name)->setTemplate($template);
	}
	// shared validator ends

	// publish product starts
	public function shar_productName($name,$template="{{input}} is NOT a valid Item Name"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(10,50,true)->setName($name)->setTemplate($template);
	}
	
	// public function shar_productCondition($name,$template="{{name}} must be chosen from the dropdown list"){
	// 	$validator = Respect\Validation\Validator::create();
	// 	return $validator->int()->positive()->setName($name)->setTemplate($template);
	// }

	public function shar_productPrice($name,$template="{{name}} should be a positive number"){
		// echo $template;
		$validator = Respect\Validation\Validator::create();
		return $validator->float()->positive()->setName($name)->setTemplate($template);
	}
	public function shar_productBidDate($name,$template="{{name}} should at least start from tomorrow"){
		$validator = Respect\Validation\Validator::create();
		return $validator->date('Y-m-d')->min(SharUtil::dateToday())->setName($name)->setTemplate($template);
	}
	// publish product ends

	// request starts
	public function shar_requestTopic($name,$template="{{input}} is NOT a valid topic"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,100,true)->setName($name)->setTemplate($template);
	}
	// request ends

	// register start
    public function shar_displayname($name,$template="{{input}} is NOT a valid display name"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,20,true)->setName($name)->setTemplate($template);
	}

	public function shar_password($name,$template="{{name}} is NOT a valid password"){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->length(8,100,true)->setName($name)->setTemplate($template);
	}
	public function shar_realname($name,$template="{{input}} is NOT a valid name"){
		$validator = Respect\Validation\Validator::create();
		return $validator->alpha()->length(1,50)->setName($name)->setTemplate($template);
	}
    public function shar_phonenumber($name,$template="{{input}} is NOT a valid phone number"){
		$validator = Respect\Validation\Validator::create();
		return $validator->phone()->setName($name)->setTemplate($template);
	}
	public function shar_postcode($name,$template="{{input}} is NOT a valid postcode"){
		$validator = Respect\Validation\Validator::create();
		return $validator->alnum()->length(5,10)->setName($name)->setTemplate($template);
	}
    public function shar_address($name,$template="{{input}} is NOT a valid address"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,50)->setName($name)->setTemplate($template);
	}
	public function shar_review($name,$template="{{name}} should be a number between 0-5"){
		$validator = Respect\Validation\Validator::create();
		return $validator->numeric()->between(0, 5, true)->setName($name)->setTemplate($template);
	}

	public function shar_card($name,$template="{{name}} should be a vaild card number"){
		$validator = Respect\Validation\Validator::create();
		return $validator->digit()->creditCard()->setName($name)->setTemplate($template);
	}

	public function shar_ischosen($name,$template="{{name}} should be checked before next step"){
		$validator = Respect\Validation\Validator::create();
		return $validator->equals('on')->setName($name)->setTemplate($template);
	}

	public function shar_ischosenbid($name,$template="{{name}} should be read before bid"){
		$validator = Respect\Validation\Validator::create();
		return $validator->equals('on')->setName($name)->setTemplate($template);
	}

	public function shar_cardtype($name,$template="{{name}} should be chosen before payment"){
		$validator = Respect\Validation\Validator::create();
		return $validator->equals(1)->setName($name)->setTemplate($template);
	}

	public function shar_cardchosen($name,$template="{{name}} choose more than one type of card."){
		$validator = Respect\Validation\Validator::create();
		return $validator->equals(1)->setName($name)->setTemplate($template);
	}
	//register end

	//advertisement start
	public function shar_adName($name,$template="{{input}} is NOT a valid Title Name"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,50)->setName($name)->setTemplate($template);
	}
	public function shar_adDescription($name,$template="{{name}} is NOT valid description"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,20000)->setName($name)->setTemplate($template);
	}
	//advertisement end

	// request reply start
	public function shar_replyId($name,$template="{{name}} is not a valid ID"){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->positive()->setName($name)->setTemplate($template);
	}
	// request reply end
	
	// contact us start
	public function shar_contactSubject($name,$template="{{name}} must be chosen from the dropdown list"){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->notEmpty()->between(1, 3, true)->setName($name)->setTemplate($template);
	}
	public function shar_contactContent($name,$template="{{name}} is NOT valid content"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,2000)->setName($name)->setTemplate($template);
	}
	public function shar_contactName($name,$template="{{input}} is NOT a valid name"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->alnum()->length(1,20,true)->setName($name)->setTemplate($template);
	}
	// contact us end


	public function shar_notEmptyList($name,$template="{{name}} must be chosen from the dropdown list"){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->positive()->setName($name)->setTemplate($template);
	}


	public function shar_qa($name,$template="{{name}} the maximun word length should be 255 characters"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,255)->setName($name)->setTemplate($template);
	}


	
	public static function __callStatic($ruleName, $arguments)
    {
		return Respect\Validation\Validator::__callStatic($ruleName, $arguments);
    }
}