<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryManageProduct
{
	/**
	 * Insert information of a new product 
	 * @param  [integer] $id          [user id]
	 * @param  [string] $name        [product name]
	 * @param  [integer] $category    [category id]
	 * @param  [integer] $condition   [product condition]
	 * @param  [string] $description [product description]
	 * @return [array]              [product id ]
	 */
	public static function insertProduct($id, $name, $category, $condition, $description){
	
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('product'))
			->values(array(
				'user_id' => $id, 'category_id' => $category, 'name' => $name, 'description' => $description,
				'product_condition' => $condition, 'upload_time' => new FluentLiteral('NOW()'), 'on_bid' => SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],
				'view_number' => 0, 'status' => SharQuery::$STATUSCODE['product_status']['ONSELL'], 
				'ts' => new FluentLiteral('NOW()')));
			$number=$query->execute();
        return $number;
    }

	/**
	 * [insert a bid info in product table]
	 * @param  [integer] $id       [This id is product's id]
	 * @param  [datetime] $due_date [the dead line of a bid]
	 * @return [boolean]           [insert success or not]
	 */
    public static function onBid($id,$due_date){
    	
    	$status=array('on_bid'=>SharQuery::$STATUSCODE['product_onbid']['ONBID'], 'due_date'=> $due_date);
    	
    	$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->execute();
    	return true;
    }
    

    /**
     * [delectProduct delete a product]
     * @param  [integer] $id [product id]
     * @return [boolean]     [update success or not]
     */
	public static function deleteProduct($id){
		$query = SharIt::db()->createCommand()-> from(SharDB::tableName('product'))
				->where('id = :id ', array(':id' => $id))
				->select('status');
		if($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['ONSELL']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']);
		}
		elseif($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['SOLDOUT']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']);
		}
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->limit(1)->execute();
        return true;
	}

	/**
	 * [updateProduct update a product info]
	 * @param  [integer] $category_id       [category id]
	 * @param  [string] $name              [product name]
	 * @param  [stirng] $description       [product description]
	 * @param  [integer] $product_condition [product condition]
	 * @return [boolean]                    [update success or not]
	 */
	public static function updateProduct($id,$category_id, $name, $description, $product_condition){
		$array=array('category_id' => $category_id, 'name' => $name, 'description' => $description,
			'product_condition' => $product_condition, 'ts' => new FluentLiteral('NOW()'));
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$array, $id)->limit(1)->execute();
        return true;
	}

	/**
	 * [closeBid close bid if the product hasn't sold out when out of date]
	 * @param  [integer] $id [product id]
	 * @return [boolean]     [update success or not]
	 */
	public static function closeBid($id){
		$status = array('on_bid' => SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],'due_date'=>null);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->limit(1)->execute();
        return true;
	}	

	/**
	 * [activateProduct make the product visible for user]
	 * @param  [integer] $id [product id]
	 * @return [boolean]     [update success or not]
	 */
	public static function activateProduct($id){
		$query = SharIt::db()->createCommand()-> from(SharDB::tableName('product'))
				->where('id = :id ', array(':id' => $id))
				->select('status');
		if($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['ONSELL']);
		}
		elseif($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['SOLDOUT']);
		}
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->limit(1)->execute();
        return true;
	}

	/**
	 * [insertQuestion insert a question for a product]
	 * @param  [int] $pro_id   [product id]
	 * @param  [int] $u_id     [user id who ask question]
	 * @param  [string] $question [question]
	 * @return [int]           [id in qanda table]
	 */
	public static function insertQuestion($pro_id, $u_id,$question){
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('qanda'))
				->values(array(
				'product_id' => $pro_id, 'user_id' => $u_id, 'question' => $question, 
				'question_time' => new FluentLiteral('NOW()')));
				
		$question_id=$query->execute();
        return $question_id;
	}

	/**
	 * [insertAnswer insert a answer for a question]
	 * @param  [int] $question_id [question id]
	 * @param  [string] $answer      [answer]
	 * @return [boolean]              [update success or not]
	 */
	public static function insertAnswer($question_id,$answer){
		$status = array('answer' => $answer, 'answer_time' => new FluentLiteral('NOW()'));
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('qanda'),
			$status, $question_id)->limit(1)->execute();
        return true;
	}

		/**
	 * [deleteBid delete a bid when the product sold out when out of due date]
	 * @param  [int] $id [product id]
	 * @return [boolean]     [update success or not]
	 */
	public static function deleteBid($id){
		$status = array('status' => SharQuery::$STATUSCODE['bid_status']['HIDDEN']);
		$array= array('product_id'=>$id);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('bid'))
			->set($status)
			->where($array) ;
		
			$query->execute();
        return true;
	}

	/**
	 * [activateBid make a bid visible for user]
	 * @param  [int] $id [product id]
	 * @return [boolean]     [update success or not]
	 */
	public static function activateBid($id){
		$status = array('status' => SharQuery::$STATUSCODE['bid_status']['SHOW']);
		$array= array('product_id'=>$id);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('bid'))
			->set($status)
			->where($array) ;
		
			$query->execute();
        return true;
	}
}
?>