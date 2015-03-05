<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryAuth
{
	
	/**
	 * Get the information of user according to the it's email.
	 * @param  [type] $username  The email of user
	 * @return [type] an array which contains all information of this user.
	 */
	public static function getUserForUsername($username){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
				->where('email = :email',array(':email' => $username))
            	->limit(1);
        return $query->fetch();
	}

	/**
	 * Get the password of a user according to it's email.
	 * @param  [type] $username    The email of the user
	 * @return [type]   The password of this user.
	 */
	public static function getPasswordForUsername($username){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))->select(null)->select(array('password','salt'))
			->where('email = :email AND status = :status',array(':email' => $username,':status' => 1 ))
            ->limit(1);
        return $query->fetch();
	}
}
?>