<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharFiles {
	public static $allowedExts = array(
				'productPic'=>array("gif", "jpeg", "jpg", "png")
			);
	public static $allowedTypes = array(
				'productPic'=>array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg","image/png")
			);
	public static $allowedMaxSize = array(
				'productPic'=>1000000
			);

	public static function uploadFile($file,$path,$cat=null){

		$temp = explode(".", $file["name"]);
		$extension = end($temp);

		$file["name"] = SharUtil::generateImgName().'.'.$extension;
		$path  = SHARIT_PATH_APP ."/". $path . $file["name"];

		if($cat!=null){
			if (!in_array($file["type"], self::$allowedTypes[$cat]) || !in_array($extension, self::$allowedExts[$cat])){
				return array('-1'=>"Only ".implode(", ", self::$allowedExts[$cat])." types allowed.");
			}elseif($file["size"] > self::$allowedMaxSize[$cat]){
				return array('-2'=>"Maximum size is ".self::$allowedMaxSize[$cat]);
			}
		}

		if ($file["error"] > 0) {
			return array('-3'=>"Error: " . $file["error"] . "<br>");
		} else {
			if (file_exists($path)) {
				return array('-4'=> $file["name"] . " already exists. ");
			} else {
				move_uploaded_file($file["tmp_name"],$path);
				return array('0'=> $file["name"]);
			}
		}
	}

	public static function dateToday($format='Y-m-d'){
		return date($format);
	}

	
}