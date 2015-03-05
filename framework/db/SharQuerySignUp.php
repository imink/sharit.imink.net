<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQuerySignUp
{
	/**
	 * A user sign up, insert data into table
	 * @param  [string] $email
	 * @param  [string] $password
	 * @param  [string] $displayname
	 * @return [string] $id
	 */
	public static function insertUser($email, $password, $displayname){
		$salt=SharUtil::randomSeed(6);
		$password.=$salt;
		$password=MD5($password); 
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('user'))
				->values(array(
				'email' => $email, 'password' => $password, 'gid' => 1, 'display_name' => $displayname,
				'salt' => $salt, 'register_date' => new FluentLiteral('NOW()'), 'status' => SharQuery::$STATUSCODE['user_status']['UNACTIVATED']))
				->execute();
		$queryId = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
							   ->where('email', $email);
        return $queryId->fetch('id');
	}

	/**
	 * A user activate their account
	 * @param  [integer] $uid 
	 * @return [boolean] whether activation succeed
	 */
	public static function activateUser($uid){
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'))
		                     ->set(array('status' => SharQuery::$STATUSCODE['user_status']['ACTIVATED']))
		                     ->where('id', $uid)
		                     ->limit(1)
		                     ->execute();
		return true;
	}

	/**
 	 * [insertUsermeta insert optional information input by user]
	 * @param  [array] $array [an array which contains optional data, the key is the name of the optional data, the value of it is the data input by user]
	 * @param  [string] $id    [user_id]
	 * @return [boolean]        [Have the system insert information into usermeta successfully]
	 */
	public static function insertUsermeta($array,$id){
		
		foreach ($array as $key=>$value){
			$values=array('user_id'=>$id, 'meta_key'=>$key, 'meta_value'=>$value);
			$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('meta'))
			->values($values)
			->execute();   
		}
        return true;
	}

	/**
	 * [updatePassword forget or update password]
	 * @param  [string] $password [user password]
	 * @param  [int] $id       [user id]
	 * @return [boolean]           [update success or not]
	 */
	public static function updatePassword($password, $id){
		$array=array('password' => $password);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'),
			$array, $id)->limit(1)->execute();
        return true;
	}
}
?>