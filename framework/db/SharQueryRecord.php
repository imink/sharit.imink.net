<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryRecord
{
	/**
	 * List all publish record
	 * @param  [string] $id User_id
	 * @param  [integer] $page current page No.
	 * @param  [string] $status status of product. 0: on sell. 1: sold out
	 * @return [array] All the product data. The price data should call the function in SharQueryMain getPrice()
	 */
	public static function listPublish($id, $page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
			->where('user_id = :user_id', array(':user_id' => $id))
            ->orderBy('ts,status DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));
        return $query->fetchAll();
	}

	public static function countPulish($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
			->where('user_id = :user_id', array(':user_id' => $id));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }

	/**
	 * List the user's request. 10 requests on one page.
	 * @param  [string] $id     [user_id]
	 * @param  [integer] $page   [The number of page]
	 * @param  [string] $status [The status of the request, 0 represents HIDDEN, 1 represents SHOW]
	 * @return [array]         [an array which contains selected requests]
	 */
	public static function listRequest($id,$page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->where('user_id = :user_id',array(':user_id' => $id))
            ->orderBy('ts DESC')
            ->offset($perpage*($page-1))
            ->limit($perpage);

        return $query->fetchAll();
	}

	public static function countRequest($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('request'))
			->where('user_id = :user_id',array(':user_id' => $id));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }
	/**
	 * List all purchase record
	 * @param  [integer] $id User_id
	 * @param  [integer] $page current page No.
	 * @return [array] All the purchase data. The price data should call the function in SharQueryMain getPrice()
	 */
	public static function listPurchase($id, $page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
			->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('order').'.product_id')
            ->select(SharDB::tableName('product').'.name')
            ->where(SharDB::tableName('order').'.user_id = :user_id', array(':user_id' => $id))
            ->orderBy(SharDB::tableName('order').'.order_time DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));

        return $query->fetchAll();
	}

	public static function listPurchasePrice($id, $page,$perpage){
		$array=self::listPurchase($id,$page,$perpage);
		
		foreach($array as $key=>$value){
			$price=SharQueryMain::getPrice($value['product_id']);
			$value['price']=$price;
			$array[$key]=$value;
		}
		return $array;
	}

	public static function countPurchase($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
			->where('user_id = :user_id', array(':user_id' => $id));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }


	/**
	 * [listBid list all bid record of a user]
	 * @param  [int] $id   [user id]
	 * @param  [int] $page [recent page number]
	 * @return [array]       [all bid info in bid table and the product name]
	 */
	public static function listBid($id, $page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('bid'))
			->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('bid').'.product_id')
            ->select(SharDB::tableName('product').'.name')
            ->where(SharDB::tableName('bid').'.user_id = :user_id AND '.SharDB::tableName('bid').'.status = :status', array(':user_id' => $id, ':status' => SharQuery::$STATUSCODE['bid_status']['SHOW']))
            ->orderBy(SharDB::tableName('bid').'.ts DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));
        return $query->fetchAll();
	}

	public static function listBidPrice($id, $page,$perpage){
		$array=self::listBid($id,$page,$perpage);
		foreach($array as $key=>$value){
			$price=SharQueryBid::getHighPrice($value['product_id']);
			$value['highprice']=$price;
			$array[$key]=$value;
		}
		return $array;

	}

	public static function countBid($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('bid'))
			->where('user_id = :user_id AND status = :status', array(':user_id' => $id, ':status' => SharQuery::$STATUSCODE['bid_status']['SHOW']));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }

	/**
	 * [listQuestion list all the questions that the user asked]
	 * @param  [int] $id   [user id in qanda table]
	 * @param  [int] $page [recent page number]
	 * @return [array]       [all info of a user's questions in qanda table and the product name]
	 */
	public static function listQuestion($id, $page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('qanda'))
			->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('qanda').'.product_id')
            ->select(SharDB::tableName('product').'.name')
            ->where(SharDB::tableName('qanda').'.user_id = :user_id', array(':user_id' => $id))
            ->orderBy(SharDB::tableName('qanda').'.question_time DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));
        
        return $query->fetchAll();
	}

	public static function countQuestion($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('qanda'))
			->where(SharDB::tableName('qanda').'.user_id = :user_id', array(':user_id' => $id));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }

	/**
	 * [listAnswer list all the answers that the user answered]
	 * @param  [integer] $id   [user id in product table]
	 * @param  [int] $page [recent page number]
	 * @return [array]       [all info of a user's answers in qanda table and the product name]
	 */
	public static function listAnswer($id, $page,$perpage){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('qanda'))
			->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('qanda').'.product_id')
            ->select(SharDB::tableName('product').'.name')
            ->where(SharDB::tableName('product').'.user_id = :user_id AND '.SharDB::tableName('qanda').'.answer IS NOT NULL', array(':user_id' => $id))
            ->orderBy(SharDB::tableName('qanda').'.answer_time DESC')
            ->limit($perpage)
            ->offset($perpage*($page-1));
        return $query->fetchAll();
	}

	public static function countAnswer($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('qanda'))
        	->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('qanda').'.product_id')
			->where(SharDB::tableName('product').'.user_id = :user_id AND '.SharDB::tableName('qanda').'.answer IS NOT NULL', array(':user_id' => $id));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }
}
?>