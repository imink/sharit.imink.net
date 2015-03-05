<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharIt
{
	private static $_app;
	private static $_page;
	private static $_db;
	private static $_auth;
	private static $_mailer;
	private static $_request;
	private static $_exception;

	/**
	 * Get SharApp instance
	 * @return SharApp instance of SharApp
	 */
	public static function app(){
		if(self::$_app===null){
			self::$_app = new SharApp();
		}
		return self::$_app;
	}

	/**
	 * Get SharPage instance
	 * @return SharPage instance of SharPage
	 */
	public static function page(){
		if(self::$_page===null){
			self::$_page = new SharPage();
		}
		return self::$_page;
	}

	/**
	 * Get SharDB instance
	 * @return SharDB instance of SharDB
	 */
	public static function db(){
		if(self::$_db===null){
			self::$_db = new SharDB();
		}
		return self::$_db;
	}

	/**
	 * Get SharAuth instance
	 * @return SharAuth instance of SharAuth
	 */
	public static function auth(){
		if(self::$_auth===null){
			self::$_auth = new SharAuth();
		}
		return self::$_auth;
	}

	/**
	 * Get SharRequest instance
	 * @return SharRequest instance of SharRequest
	 */
	public static function request(){
		if(self::$_request===null){
			self::$_request = new SharRequest();
		}
		return self::$_request;
	}

	/**
	 * Get SharException instance
	 * @return SharException instance of SharException
	 */
	public static function exception(){
		if(self::$_exception===null){
			self::$_exception = new SharException();
		}
		return self::$_exception;
	}

	/**
	 * Get PHPMailer instance
	 * @return PHPMailer instance of PHPMailer
	 */
	public static function mailer(){
		if(self::$_mailer===null){
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			$mail->Host = SHARIT_MAILER_SERVER;
        	$mail->Port = SHARIT_MAILER_PORT;
			self::$_mailer = $mail;
		}
		$mail->clearAllRecipients();
		return self::$_mailer;
	}
}
