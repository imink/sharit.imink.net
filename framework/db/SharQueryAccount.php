<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * All the functions are only used in view account
 */
class SharQueryAccount
{

	/**
	 * Get a specific user's data
	 * @param  [integer] $id [user_id]
	 * @return [array]     [All the user's data]
	 */
	public static function getUser($id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
			->where('id = :id',array(':id' => $id))
			->select(null)
			->select(array('id','display_name','email','gid','review_com','review_ship','review_describe','review_attitude','review_speed','register_date','status'));
		$array = $query->fetch();
		$array['review_com'] = $array['review_com'] / 10;
		$array['review_ship'] = $array['review_ship'] / 10;
		$array['review_describe'] = $array['review_describe'] / 10;
		$array['review_attitude'] = $array['review_attitude'] / 10;
		$array['review_speed'] = $array['review_speed'] / 10;
        return $array;
	}

	/**
	 * Get a specific user's meta data
	 * @param  [integer] $id [user_id]
	 * @return [array]     [All the user's meta data. In the array ,key is meta_key, value is meta_value.]
	 */
	public static function getUsermeta($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('meta'))
			->where('user_id = :user_id',array(':user_id' => $id));
		$array=$query->fetchAll();
		foreach ($array as $key => $value) {
			$array1[$value['meta_key']]=$value['meta_value'];
		}
        return $array1;
	}

	/**
	 * update user's info
	 * @param  [string] $display_name [user's new display name]
	 * @param  [integer] $id           [user's id]
	 * @return [boolean]               [whether update correctly]
	 */
	public static function updateUser($display_name, $id){
		$array=array('display_name' => $display_name);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'),
			$array, $id)->limit(1)->execute();
        return true;
	}

	/**
	 * update user's meta info
	 * @param  [array] $array [key value pair that user need to update]
	 * @param  [integer] $id    [user's id]
	 * @return [boolean]        [whether update correctly]
	 */
	public static function updateUsermeta($array, $id){
		foreach ($array as $key => $value){
			$query = SharIt::db()->createCommand()-> from(SharDB::tableName('meta'))
				->where('user_id = :user_id AND meta_key = :meta_key', array(':user_id' => $id, ':meta_key' => $key));
			$num=count($query->fetchAll());
			if($num==1){
				$array1=array('user_id = ?' => $id, 'meta_key = ?' => $key);
				$query1 = SharIt::db()->createCommand()->update(SharDB::tableName('meta'))
					->set('meta_value',$value)
					->where($array1)
					->execute();
			}else{
				$values=array('user_id'=>$id, 'meta_key'=>$key, 'meta_value'=>$value);
				$query2 = SharIt::db()->createCommand()->insertInto(SharDB::tableName('meta'))
					->values($values)
					->execute();
			}		
		}
		return true;
	}

	public static function updateUserPassword($password, $id){
        $salt=self::getSalt($id);
        $password = MD5($password);
		$password.=$salt;
		$password=MD5($password);

		$array=array('password' => $password);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'),
			$array, $id)->limit(1)->execute();
        return true;
	}

	public static function getSalt($uid){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))->select(null)->select(array('salt'))
			->where('id = :id',array(':id' => $uid ))
            ->limit(1);
        return $query->fetch('salt');
	}

	public static function updateSalt($uid){
		$change = SharUtil::randomSeed(6);
		$array=array('salt' => $change);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'),
			$array, $uid)->limit(1)->execute();
        return $change;
	}

}
?>