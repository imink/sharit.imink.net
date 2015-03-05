<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryPicture
{
    /**
     * 
     * When editing product and wanting to insert a new normal picture, should set a new array containing the following information.
     * 
     * @param  [array] $array [contains two key value pair: 'id'=>xx, 'picture_name'=>xxxxxx,
     *                         id means product_id, picture_name means the picture's file name]
     * @return [boolean]        [success or not]
     */
	public static function insertPictureNormal($array){
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('picture'))
			->values(array(
				'product_id' => $array['id'],'picture_name' => $array['picture_name'],'status' => SharQuery::$STATUSCODE['picture_status']['SHOW']))
			;
			$query->execute();
        return true;
	}

	/**
	 * Insert the main picture
	 * @param  [array] $array [contains two key value pair: 'id'=>xx, 'picture_name'=>xxxxxx,
     *                         id means product_id, picture_name means the picture's file name]
	 * @return [boolean]        [whether insert successful]
	 */
	public static function insertPictureMain($array){
		
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('picture'))
			->values(array(
				'product_id' => $array['id'],'picture_name' => $array['picture_name'],'status' => SharQuery::$STATUSCODE['picture_status']['MAIN']))
			->execute();
        return true;
	}

	/**
	 * [List all the normal picture of a product]
	 * @param  [integer] $id [product id]
	 * @return [array]     [all the normal picture info]
	 */
	public static function listPictureNormal($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('picture'))
			->where('product_id = :product_id AND status = :status', array(':product_id' => $id,':status' => SharQuery::$STATUSCODE['picture_status']['SHOW']));
        return $query->fetchAll();
	}

	/**
	 * [List the main picture of a product]
	 * @param  [integer] $id [product id]
	 * @return [array]     [the main picture info]
	 */
	public static function getPictureMain($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('picture'))
			->where('product_id = :product_id AND status = :status', array(':product_id' => $id,':status' => SharQuery::$STATUSCODE['picture_status']['MAIN']));
        return $query->fetch();
	}

	


	/**
	 * [Delect the picture of a specific product]
	 * @param  [integer] $id [picture id]
	 * @return [boolean]     [delect success or not]
	 */
	public static function deletePicture($id){
		$status = array('status' => SharQuery::$STATUSCODE['picture_status']['HIDDEN']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('picture'),
			$status, $id)->limit(1)->execute();
        return true;
	}
}
?>