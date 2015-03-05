<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryProduct
{

	/**
	 * [getProduct get a product info]
	 * @param  [int] $id [product id]
	 * @return [array]     [all the product info and seller's name]
	 */
	public static function getProduct($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
			->where('id = :id ', array(':id' => $id));
        return $query->fetch();
	}

	/**
	 * [listPrice list all history price of a product]
	 * @param  [int] $id [product id]
	 * @return [array]     [all history price in a array]
	 */
	public static function listPrice($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('price'))
			->where('product_id', $id)->orderBy('ts ASC');
        return $query->fetchAll();
	}

	/**
	 * [listQanda list all q and a of a product]
	 * @param  [int] $id   [product id]
	 * @param  [int] $page [recent page number]
	 * @return [type]       [description]
	 */
	public static function listQanda($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('qanda'))
			->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('qanda').'.user_id = '.SharDB::tableName('user').'.id')
			->where(SharDB::tableName('qanda').'.product_id', $id)
			->select(SharDB::tableName('user').'.display_name')
			->orderBy(SharDB::tableName('qanda').'.question_time DESC');
        return $query->fetchAll();
	}

	

	/**
	 * [updateViewNo add the total count number by 1]
	 * @param  [int] $id      [product id]
	 * @param  [int] $view_no [the recent view number in product table]
	 * @return [boolean]          [update success or not]
	 */
	public static function updateViewNo($id,$view_no){
		$status = array('view_number' => $view_no+1);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->limit(1)->execute();
        return true;
	}
}
?>