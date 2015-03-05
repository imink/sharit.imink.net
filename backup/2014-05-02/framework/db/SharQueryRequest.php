<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryRequest
{
	/**
	 * [listAllRequest list all request]
	 * @param  [int] $page [recent page number]
	 * @return [array]       [all info in request table and the user display name who publish the request]
	 */
	public static function listAllRequest($page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('request').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('request').'.status', SharQuery::$STATUSCODE['request_status']['SHOW'])
            ->select(SharDB::tableName('user').'.display_name')
            ->orderBy(SharDB::tableName('request').'.ts DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));
        return $query->fetchAll();
	}

	public static function countRequest(){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
        	->where(SharDB::tableName('request').'.status', SharQuery::$STATUSCODE['request_status']['SHOW']);
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }

	/**
	 * [listAllRequestCategory list all request according to a specific category]
	 * @param  [integer] $category_id [category id]
	 * @param  [integer] $page        [recent page number]
	 * @return [array]              [all info in request table and the user display name who publish the request]
	 */
	public static function listAllRequestCategory($category_id, $page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('request').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('request').'.category_id = :category_id AND '.SharDB::tableName('request').'.status = :status', 
            			array(':category_id' => $category_id, ':status' => SharQuery::$STATUSCODE['request_status']['SHOW']))
            ->select(SharDB::tableName('user').'.display_name')
            ->orderBy(SharDB::tableName('request').'.ts DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));
        return $query->fetchAll();
	}

	public static function countRequestC($category_id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
        	->where('category_id = :category_id AND status = :status', 
            			array(':category_id' => $category_id, ':status' => SharQuery::$STATUSCODE['request_status']['SHOW']));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }
    
    public static function listAllCategoryFromRequest(){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->leftJoin(SharDB::tableName('category').' ON '.SharDB::tableName('request').'.category_id = '.SharDB::tableName('category').'.id')
            ->where(SharDB::tableName('request').'.status = :status', array(':status' => SharQuery::$STATUSCODE['request_status']['SHOW']))
            ->select(null)
            ->select(array(SharDB::tableName('category').'.id',SharDB::tableName('category').'.name'))
            ->groupBy(SharDB::tableName('request').'.category_id, '.SharDB::tableName('category').'.parent_id');
        $array=$query->fetchAll();
        $array2=array();
        foreach ($array as $key => $value) {
        	$array2[$value['id']]=$value['name'];
        }
        return $array2;
	}

    /**
     * [listAllRequestFromUser list all request for a specific user]
     * @param  [integer] $u_id [user id]
     * @param  [integer] $page        [recent page number]
     * @return [array]       [all info in request table for a specific user]
     */
    public static function listAllRequestFromUser($u_id,$page){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
            ->where('user_id = :user_id', array(':user_id' => $u_id))
            ->select('id')
            ->orderBy('id DESC')
            ->limit(10)
            ->offset(10*($page-1));
        return $query->fetchAll();
	}
    

	public static function getRequest($id){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('request').'.user_id = '.SharDB::tableName('user').'.id')
			->leftJoin(SharDB::tableName('category').' ON '.SharDB::tableName('request').'.category_id = '.SharDB::tableName('category').'.id')
            ->where(SharDB::tableName('request').'.id', $id)
            ->select(array(SharDB::tableName('user').'.display_name', SharDB::tableName('category').'.name'));
        return $query->fetch();
	}

	/**
	 * [listReply list all reply of a request]
	 * @param  [integer] $id   [request id]
	 * @param  [integer] $page        [recent page number]
	 * @return [array]       [list all info in reply table]
	 */
	public static function listReply($id,$page=null){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('reply'))
			->leftJoin(SharDB::tableName('request').' ON '.SharDB::tableName('request').'.id = '.SharDB::tableName('reply').'.request_id')
            ->where(SharDB::tableName('request').'.id', $id)
            ->orderBy(SharDB::tableName('reply').'.ts DESC');
        if($page!=null){
            $query->limit(10)
            ->offset(10*($page-1));
        }
        return $query->fetchAll();
	}

	public static function countReply($id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('reply'))
		 ->where('request_id', $id);

		 $num=count($query->fetchAll());
		 return $num;
	}

	/**
	 * [insertRequest insert a request]
	 * @param  [integer] $category [category id]
	 * @param  [int] $id       [user id]
	 * @param  [string] $topic    [request topic]
	 * @param  [string] $message  [request message]
	 * @return [integer]           [request id]
	 */
	public static function insertRequest($category, $id, $topic, $message){
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('request'))
				->values(array(
				'category_id' => $category, 'user_id' => $id, 'topic' => $topic, 'message' => $message,
				'ts' => new FluentLiteral('NOW()'), 'status' => SharQuery::$STATUSCODE['request_status']['SHOW']));
				
		$request_id=$query->execute();
        return $request_id;
	}

	/**
	 * [insertReply insert a reply for a request]
	 * @param  [int] $request_id [request id]
	 * @param  [int] $product_id [the product id that the user reply]
	 * @return [boolean]             [insert success or not]
	 */
	public static function insertReply($request_id, $product_id){
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('reply'))
				->values(array(
				'request_id' => $request_id, 'product_id' => $product_id, 
				'ts' => new FluentLiteral('NOW()')))
				->execute();
        return true;
	}

	/**
	 * [closeRequest close a request(hide)]
	 * @param  [integer] $id [request id]
	 * @return [boolean]     [update success or not]
	 */
	public static function closeRequest($id){
		$status = array('status' => SharQuery::$STATUSCODE['request_status']['HIDDEN']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('request'),
			$status, $id)->limit(1)->execute();
        return true;
	}

	/**
	 * [deleteRequest delete a request]
	 * @param  [int] $id [request id]
	 * @return [boolean]     [update success or not]
	 */
	public static function deleteRequest($id){
		$status = array('status' => SharQuery::$STATUSCODE['request_status']['DELECT']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('request'),
			$status, $id)->limit(1)->execute();
        return true;
	}

	/**
	 * [activeRequest make a request visible for a user]
	 * @param  [int] $id [request id]
	 * @return [boolean]     [update success or not]
	 */
	public static function activeRequest($id){
		$status = array('status' => SharQuery::$STATUSCODE['request_status']['SHOW']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('request'),
			$status, $id)->limit(1)->execute();
        return true;
	}

	public static function listPublish($u_id){
	
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product'))
			->select(null)
			->select(array('id','name'))
			->where('user_id = :user_id AND status = :status', array(':user_id' => $u_id,':status' => SharQuery::$STATUSCODE['product_status']['ONSELL']))
            ->orderBy('ts DESC');
		 $query->fetchAll();
		 $array=array();
		 foreach($query as $key=>$value){
		 	$array[$value['id']]=$value['name'];
		 }
		 return $array;
	}
}
?>