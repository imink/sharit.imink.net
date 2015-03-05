<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * All the functions are only used in view account
 */
class SharQueryShow
{
	public static function getPictureDisplay(){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('picture'))
			->where('status = :status', array(':status' => SharQuery::$STATUSCODE['picture_status']['DISPLAY']));
        return $query->fetchAll();
	}

	public static function getAdvertisementAll(){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('advertisement'))
			->where('status = :status', array(':status' => SharQuery::$STATUSCODE['advertisement_status']['SHOW']));
        return $query->fetchAll();
	}

	private static function helpGetAdvertisement($p_id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('advertisement'))
			->where('product_id = :product_id AND status= :status', array(':product_id' => $p_id, ':status'=>SharQuery::$STATUSCODE['advertisement_status']['SHOW']));
        return $query->fetch();
	}

	public static function getAdvertisement(){
		$array=self::getPictureDisplay();
		foreach ($array as $key=>$value){
			$help1=self::helpGetAdvertisement($value['product_id']);
			$value['name']=$help1['name'];
			$value['description']=$help1['description'];
			$help2=SharQueryMain::getPrice($value['product_id']);
			$value['price']=$help2;
			$array[$key]=$value;
		}
		return $array;
	}

}
?>