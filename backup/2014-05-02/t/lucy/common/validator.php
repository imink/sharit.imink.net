<?php

class Validator {

	private $errorMessage="";

	public function getErrorMessage() {
		return($this->errorMessage);
	}

	// Valdation Method for new user, sets error message if user is not valid
	public function validateNewUser($name,$email,$password) {
		$this->errorMessage="";
		if (strlen($name)<4) {
			$this->errorMessage="Error name is missing";
			return;
		}
		if (strlen($password)<8) {
			$this->errorMessage="Error password must be at least 8 characters";
			return;
		}
		if (strlen($email)<4) {
			$this->errorMessage="Error email missing";
			return;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->errorMessage="Error, please enter a valid email address";
			return;
		}
		

	}
}

?>
