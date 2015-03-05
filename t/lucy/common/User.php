<?php

include 'common.php';

class User {
	private $id="";
	private $username="";
	private $email="";
	private $emailConfirmed=0;	
	private $error="";
	private $valid;
	private $password;
	private $mobile="";
	
	public function isValid() {
		return($this->valid);
	}
	
	public function get_error() {
		return($this->error);
	}
	
	public function get_name() {
		return($this->username);
	}
	
	public function set_name($name) {
		$this->username=$name;
	}
	
	public function set_mobile($mobile) {
		$this->mobile=$mobile;
	}
	
	public function loadUser($email) {
		$sql="select * from users where email='" . $email . "';";
		$helper=new SQLHelper();
		$results=$helper->doSQL($sql);	// try and create user table
		$this->valid=FALSE;		
		if ($results->num_rows==0)  return;	// could not find account
		if ($row = mysqli_fetch_array($results)) {		// look for row
			$this->id=$row['ID'];
			$this->username=$row['username'];
			$this->email=$row['email'];
			$this->emailConfirmed=$row['emailConfirmed'];
			$this->password=$row['password'];
			$this->mobile=$row['mobile'];
				
		} else {
			//echo "Could not load";
			
		}
		$this->valid=TRUE;		
	}
	
	public function saveUser() {
		$sql="update users set";
		$sql.=" username='".$this->username."',";
		// ADD more fields here, use template above this line
		
		$sql.=" mobile='".$this->mobile."' ";
		
		$sql.=" where id='".$this->id."' ";
		
		$helper=new SQLHelper();
		$helper->doSQL($sql);	// save
	}
	
	public static function userExists($email) {
		$sql="select * from users where email='" . $email . "';";
		$helper=new SQLHelper();
		$results=$helper->doSQL($sql);	// try and create user table
		return($results->num_rows>0);
	}
	
	public static function confirmAccount($id) {
		$sql="select * from users where validationID='" . $id . "';";
		$helper=new SQLHelper();
		$results=$helper->doSQL($sql);	// try and create user table
		if ($results->num_rows==0) return(FALSE);	// could not find account
		// we can now try and validate the account
		$sql="update users set emailConfirmed=1 where validationID='" . $id . "';";
		$helper->doSQL($sql);	// try and confirm the account
		$helper->close();
		return(TRUE);
		
	}
	
	public static function sendValidationEmail($email) {
		$sql="select * from users where email='" . $email . "';";
		$helper=new SQLHelper();
		$results=$helper->doSQL($sql);	// try and create user table
		if ($results->num_rows==0) return(FALSE);	// could not find account
		if ($row = mysqli_fetch_array($results)) {		// look for row
			$validation=$row['validationID'];
			$url = $_SERVER['REQUEST_URI']; //returns the current URL
			$parts = explode('/',$url);
			$dir = $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
			
			for ($i = 0; $i < count($parts) - 1; $i++) {
				$dir .= $parts[$i] . "/";
			}
			$dir .= "confirm.php?confirmid=". $validation;
			$message='Please click on the following link to validate your email address and account <a href="http://' . $dir . '">CLICK HERE</a>';
			Emailer::sendEmail($email,$message,"Welcome to our Website");
		} else {
			//echo 'Could not get row';
			
		}
		return(TRUE);
	}
	
	
	public static function addUser($name,$email,$password) {
		$password=md5($password);
		$validationID=uniqid();
	    $sql="insert into users (ID, username,Email,Password,validationID) values(0,'" . $name . "','" . $email . "','" . $password . "','" .$validationID ."');";
	    $helper=new SQLHelper();
	    $helper->doSQL($sql);	// try and create user table
	    if ($helper->get_Error()) {
	    	return(FALSE);			// failed to insert
	    }
	    return(TRUE);
	}
	
	public static function createNewPassword($password,$id) {
		$sql="select * from users where validationID='" . $id . "';";
		$helper=new SQLHelper();
		$results=$helper->doSQL($sql);	// try and create user table
		if ($results->num_rows==0) return(FALSE);	// could not find account
		// we can now try and update the password on the account, we will also update the validation id
		// we update the validation id to make sure the password reset only works one time only
		$newID=uniqid();
		$password=md5($password);		
		$sql="update users set password='".$password."',validationID='".$newID."' where validationID='" . $id . "';";
		$helper->doSQL($sql);	// try and confirm the account
		$helper->close();
		return(TRUE);
	}
	
	
	public static function sendResetPasswordEmail($email) {
		$sql="select * from users where email='" . $email . "';";
		$helper=new SQLHelper();
		$results=$helper->doSQL($sql);	// try and create user table
		if ($results->num_rows==0) return(FALSE);	// could not find account		
		if ($row = mysqli_fetch_array($results)) {		// look for row			
			$validation=$row['validationID'];
			$emailConfirmed=$row['emailConfirmed'];
			if ($emailConfirmed==0) return(FALSE);	
			$url = $_SERVER['REQUEST_URI']; //returns the current URL
			$parts = explode('/',$url);
			$dir = $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
				
			for ($i = 0; $i < count($parts) - 1; $i++) {
				$dir .= $parts[$i] . "/";
			}
			$dir .= "createNewPassword.php?id=". $validation;
			$message='Please click on the following link to reset the password on your account <a href="http://' . $dir . '">CLICK HERE</a>';
			Emailer::sendEmail($email,$message,"Reset Password");
		} else {
			//echo 'Could not get row';
				
		}
		return(TRUE);
		
	}
	
	
	public static function checkPassword($email,$password) {
		$loadedUser=new User();	// create user
		$loadedUser->loadUser($email);
		$password=md5($password);		
		if (!$loadedUser->valid) {
			$loadedUser->error="Bad username or password";
			return($loadedUser);
		}
		if ($loadedUser->emailConfirmed==0) {
			$loadedUser->error="Account not enabled, please open the link we sent to your email address";
			$loadedUser->valid=FALSE;
			return($loadedUser);
		}		
		if ($loadedUser->password!=$password) {
		      $loadedUser->error="Bad username or password";
		      $loadedUser->valid=FALSE;
		      return($loadedUser);		      
		}
		return($loadedUser);		
	}
}