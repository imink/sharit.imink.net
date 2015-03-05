<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharUtil {


	public static function randomSeed($number,$prefix=""){
		$rand = $prefix;
		for ($i = 0; $i < $number; $i++)  
		{  
			$rand .= chr(mt_rand(97, 122));  
		}
		return $rand;  
	}

	public static function generateImgName(){
		return self::randomSeed(5,time());
	}

	public static function dateToday($format='Y-m-d'){
		return date($format);
	}

	
}