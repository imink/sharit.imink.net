<?php
/**
 * [insertUsermeta insert optional information input by user]
 * @param  [array] $array [an array which contains optional data, the key is the name of the optional data, the value of it is the data input by user]
 * @param  [string] $id    [user_id]
 * @return [boolean]        [Have the system insert information into usermeta successfully]
 */
public static function insertUsermeta($array,$id){
		foreach ($array as $key=>$value){
			$values=array('user_id'=>$id, 'key'=>$key, 'value'=>$value);
			$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('meta'))
			->values($values);
            
		}
		
        return 
	}

/**
 * List the user's request. 10 requests on one page.
 * @param  [string] $id     [user_id]
 * @param  [integer] $page   [The number of page]
 * @param  [string] $status [The status of the request, 0 represents HIDDEN, 1 represents SHOW]
 * @return [array]         [an array which contains selected requests]
 */
public static function listRequest($id,$page,$status){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->where('user_id = :user_id AND status = :status',array(':user_id' => $id,':status' => $status ))
            ->orderBy('ts DESC')
            ->offset(10*($page-1))
            ->limit(10);

        return $query->fetchAll();
	}




?>

SharUtil::randomSeed(integer,prefix)