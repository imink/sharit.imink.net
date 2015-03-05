<? php	
	public function shar_productName($name,$template="{{input}} is NOT a valid Item Name"){
		$validator = Respect\Validation\Validator::create();
		return $validator->string()->length(1,100)->setName($name)->setTemplate($template);
	}
	public function shar_productCategory($name,$template="{{name}} must be chosen from the dropdown list"){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->setName($name)->setTemplate($template);
	}
	public function shar_productCondition($name,$template="{{name}} must be chosen from the dropdown list"){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->setName($name)->setTemplate($template);
	}
	public function shar_productDescription(){
		$validator = Respect\Validation\Validator::create();
		return $validator->int()->length(1,20000)->setName($name)->setTemplate($template);
	}
	public function shar_productPrice($name,$template="{{name}} is NOT a valid price"){
		// echo $template;
		$validator = Respect\Validation\Validator::create();
		return $validator->float()->positive()->setName($name)->setTemplate($template);
	}
	public function shar_productBidDate($name,$template="{{name}} should at least start from tomorrow"){
		$validator = Respect\Validation\Validator::create();
		return $validator->date('Y-m-d')->min(SharUtil::dateToday())->setName($name)->setTemplate($template);
	}
?>