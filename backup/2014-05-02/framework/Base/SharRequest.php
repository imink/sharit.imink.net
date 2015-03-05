<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharRequest
{

	private $autoSession = true;

	/**
	 * Construct an SharRequest
	 * start the session if $autoSession is true;
	 */
	function __construct()
	{
		if ($this->autoSession) {
			@session_start();
		}
	}

	/**
	 * Accesser of $_SESSION
	 * @param  string $para 
	 * @return mixed       if $para, return $_SESION[$para], if not, return $_SESSION
	 */
	public function session($para=null){
		if($para!=null){
			return $_SESSION[$para];
		}else
			return $_SESSION;
	}

	/**	
	 * Set Session
	 * @param $string $para  the name of session to be set
	 * @param $mixed $value the value of session to be set
	 */
	public function setSession($para,$value){
		$_SESSION[$para]=$value;
	}

	/**
	 * Unset Session
	 * @param  string $name name of session to be unset
	 * @return void
	 */
	public function unsetSession($para){
		@session_unset($para);
	}

	/**
	 * Destroy Session
	 * @return void
	 */
	public function destroySession(){
		@session_destroy();
	}

	/**
	 * Accesser of $_COOKIE
	 * @param  string $para 
	 * @return mixed       if $para, return $_COOKIE[$para], if not, return $_COOKIE
	 */
	public function cookie($para=null){
		if($para!=null){
			return $_COOKIE[$para];
		}else
			return $_COOKIE;
	}

	/**
	 * Set Cookie
	 * @param string $name   the name of cookie to be set
	 * @param mixed $value  the value of cookie to be set
	 * @param  $expire the time which the cookie expire(in second)
	 */
	public function setCookie($name,$value,$expire){
		setcookie($name,$value,$expire);
	}

	/**
	 * Unset Cookie
	 * @param  string $name name of cookie to be unset
	 * @return void
	 */
	public function unsetCookie($name){
		setcookie($name, "", time()-3600);
	}

	/**
	 * Accesser of $_GET
	 * @param  string $para 
	 * @return mixed       if $para, return $_GET[$para], if not, return $_GET
	 */
	public function get($arg=null){
		if ($arg===null) {
			return $_GET;
		}else{
			if (!isset($_GET[$arg])) {
				return null;
			}else 
				return $_GET[$arg];
		}
		
	}

	/**
	 * Accesser of $_POST
	 * @param  string $para 
	 * @return mixed       if $para, return $_POST[$para], if not, return $_POST
	 */
	public function post($arg=null){
		if ($arg===null) {
			return $_POST;
		}else{
			if (!isset($_POST[$arg])) {
				return null;
			}else 
				return $_POST[$arg];
		}
		
	}

	public function files($arg=null){
		if ($arg===null) {
			return $_FILES;
		}else{
			if (!isset($_FILES[$arg])) {
				return null;
			}else 
				return $_FILES[$arg];
		}
		
	}



	public static function errorCodeMessage($code){
		switch ($code) {
			case '404':
				$message = "Not Found";
				break;
			case '500':
				$message = "Internal Server Error";
				break;
			default:
				$message = "Unknown Error";
				break;
		}
		return $message;
		
	}


}