<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryMain
{
	/**
	 * Get latest price
	 * @param  [integer] $id product_id
	 * @return [string] product price
	 */
	public static function getPrice($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('price'))
			->where('product_id', $id)
			->orderBy('id DESC')
            ->limit(1);
        return $query->fetch('price');
	}

	/**
	 * Insert a new price into Table Price
	 * @param  [type] $price New Price
	 * @param  [type] $id    Product id
	 * @return boolean        [description]
	 */
	public static function insertPrice($price,$id){
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('price'))
			->values(array(
				'product_id' => $id,'price' => $price,'ts' => new FluentLiteral('NOW()')));
			$query->execute();
        return true;
	}

	/**
	 * Get the email of a given user
	 * @param  [type] $id  user id
	 * @return [type]  the email
	 */
	public static function getMail($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
			->where('id', $id);
        return $query->fetch('email');
	}

	/**
	 * This is a private to help to list category
	 * @param  [type] $parent_id [description]
	 * @return [type] return an array which key is id and value is name of the category
	 */
	private static function helperListCategory($parent_id){
	
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('category'))
			->select(null)
			->select(array('id','name'))
			->where('parent_id = :parent_id AND status= :status',array(':parent_id'=>$parent_id,':status'=> SharQuery::$STATUSCODE['category_status']['USABLE']));
		$result =  $query->fetchAll();
		$list=array();
		foreach($result as $item)
			$list[$item['id']] = $item['name'];
		return $list;
	}

	/**
	 * This function is used to list categories.
	 * @return [type] an array which contains all information of categories.
	 */
	public static function listCategory(){
		$result = self::helperListCategory(0);
		foreach ($result as $key => $value) {
			$result[$key] = array('name'=>$value,'sub'=>self::helperListCategory($key));
		}
		return $result;
	}

	
	/**
	 * get the category's name of a given product
	 * @param  [] $id [category's id]
	 * @return [type]     [the name of the category]
	 */
	public static function getCategory($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('category'))
			->select(null)
			->select('name')
			->where('id = :id',array(':id'=>$id));
	
		return $query->fetch('name');
	}
}