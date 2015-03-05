<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryAuth
{
	
	public static function getUserForUsername($username){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
			->where('email = :email AND status = :status',array(':email' => $username,':status' => 1 ))
            ->limit(1);
        return $query->fetch();
	}

	public static function getPasswordForUsername($username){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))->select(null)->select('password')
			->where('email = :email AND status = :status',array(':email' => $username,':status' => 1 ))
            ->limit(1);
        return $query->fetch('password');
	}
}
?>