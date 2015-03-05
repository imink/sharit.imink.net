<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryOrder
{
	/**Insert a new order.
	 * @param  [type] $p_id Product's id
	 * @param  [type] $u_id buyer's id
	 * @return [type] If succeed, return the id of the new order.
	 *                If not succeed, return error message:
	 *                101 means The seller is not frozen but the product is sold out.
	 *                102 means The product is available but the seller is forzen.
	 *                103 means other error condition.
	 */
    public static function insertOrder($p_id, $u_id){
        $p_status=SharQueryBid::getStatus($p_id);
        $u_status=self::getUserStatus($p_id);
        if($p_status==SharQuery::$STATUSCODE['product_status']['ONSELL']&&$u_status==SharQuery::$STATUSCODE['user_status']['ACTIVATED']){
	       $values =array(
				'product_id' => $p_id, 'user_id' => $u_id, 'order_time' => new FluentLiteral('NOW()'), 
				'status_time' => new FluentLiteral('NOW()'), 
				'status' => SharQuery::$STATUSCODE['order_status']['WAITPAYMENT']);
		 $query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('order'))
            ->values($values);
            $number=$query->execute();
            self::updateStatus($p_id);
            return $number;
	    }elseif($p_status!=SharQuery::$STATUSCODE['product_status']['ONSELL']&&$u_status==SharQuery::$STATUSCODE['user_status']['ACTIVATED']){
             return new SharQueryError(101);  
        }elseif($p_status==SharQuery::$STATUSCODE['product_status']['ONSELL']&&$u_status==SharQuery::$STATUSCODE['user_status']['FROZEN']){
             return new SharQueryError(102);
        }else{
            return new SharQueryError(103);
        }
    }

    /**
     * [getUserStatus get the status of the product's pulisher]
     * @param  [int] $p_id [product id]
     * @return [string]       [the status]
     */
    public static function getUserStatus($p_id){
        $query= SharIt::db()->createCommand()->from(SharDB::tableName('product'))
            ->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('product').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('product').'.id = :id', array(':id' => $p_id))
            ->select(null)
            ->select(SharDB::tableName('user').'.status');
        return $query->fetch('status');
    }

    /**
     * [updateStatus update the product status to sold out after make a order]
     * @param  [int] $p_id [product id]
     * @return [boolean]       [update success or not]
     */
    private static function updateStatus($p_id){
        $set=array('status' => SharQuery::$STATUSCODE['product_status']['SOLDOUT']);
        $query = SharIt::db()->createCommand()->update(SharDB::tableName('product'))
            ->set($set)->where('id',$p_id)->execute();
        return true;
    }


    /**
     * [updateAfterPay update product status to wait shipping after pay]
     * @param  [int] $o_id [order id]
     * @return [boolean]       [update success or not]
     */
	public static function updateAfterPay($o_id){
		$set=array('status' => SharQuery::$STATUSCODE['order_status']['WAITSHIPPING'], 'status_time' => new FluentLiteral('NOW()'));
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('order'))
		  ->set($set)->where('id',$o_id)->execute();
        return true;
	}

    /**
     * [updateAfterShip update product status to dispatch after shipping]
     * @param  [int] $o_id [order id]
     * @return [boolean]       [update success or not]
     */
    public static function updateAfterShip($o_id){
		$set=array('status' => SharQuery::$STATUSCODE['order_status']['DISPATCHED'], 'status_time' => new FluentLiteral('NOW()'));
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('order'))
		  ->set($set)->where('id',$o_id)->execute();
        return true;
	}

    /**
     * [updateBuyerReview update product status to buyer review and buyer review data after dispatch]
     * @param  [int] $o_id [order id]
     * @param  [int] $des  [review describe]
     * @param  [int] $com  [review communication]
     * @param  [int] $ship [review shipping]
     * @return [boolean]       [update success or not]
     */
   public static function updateBuyerReview($o_id,$des,$com,$ship){
        $des = $des * 10;
        $com = $com * 10;
        $ship = $ship * 10;
		$set=array('status' => SharQuery::$STATUSCODE['order_status']['BUYERREVIEWING'], 'status_time' => new FluentLiteral('NOW()'),
			'review_describe'=> $des,'review_com'=> $com,'review_ship'=> $ship);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('order'))
		  ->set($set)->where('id',$o_id)->execute();
        return true;
	}

	/**
     * [succeed update product status to succeed and seller review data after buyer review]
     * @param  [int] $o_id  [order id]
     * @param  [int] $att   [review attitude]
     * @param  [int] $speed [review speed]
     * @return [boolean]       [update success or not]
     */
    public static function succeed($o_id,$att,$speed){
        $att = $att * 10;
        $speed = $speed * 10;
		$set=array('status' => SharQuery::$STATUSCODE['order_status']['SUCCEED'], 'status_time' => new FluentLiteral('NOW()'),
			'review_time'=> new FluentLiteral('NOW()'),
			'review_attitude'=> $att,'review_speed'=> $speed);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('order'))
		  ->set($set)->where('id',$o_id)->execute();
        return true;
	}

    /**
     * [updateUserReview update the user review in user table]
     * @param  [int] $o_id  [order id]
     * @param  [int] $des   [review describe]
     * @param  [int] $com   [review communication]
     * @param  [int] $ship  [review shipping]
     * @param  [int] $att   [review attitude]
     * @param  [int] $speed [review speed]
     * @return [boolean]       [update success or not]
     */
    public static function updateUserReview($o_id,$des,$com,$ship,$att,$speed){
        $des = $des * 10;
        $com = $com * 10;
        $ship = $ship * 10;
        $att = $att * 10;
        $speed = $speed * 10;

        $queryBuyer = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
            ->leftJoin(SharDB::tableName('order').' ON '.SharDB::tableName('order').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('order').'.id = :id', array(':id' => $o_id))
            ->select(null)
            ->select(array(SharDB::tableName('user').'.id',SharDB::tableName('user').'.review_attitude', SharDB::tableName('user').'.review_speed'));
        $array1 = $queryBuyer->fetch(); 
        $queryCount = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
            ->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('order').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('order').'.user_id = :id AND '.SharDB::tableName('order').'.review_attitude is NOT NULL AND '.SharDB::tableName('order').'.review_speed is NOT NULL', array(':id'=>$array1['id']));
        $num1=count($queryCount->fetchAll());
        if($num1 > 1){
            $att = (($num1-1)*$array1['review_attitude'] + $att) / $num1;
            $speed = (($num1-1)*$array1['review_speed'] + $speed) / $num1;
        }
        
        $querySeller = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
            ->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.user_id = '.SharDB::tableName('user').'.id')
            ->leftJoin(SharDB::tableName('order').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('order').'.product_id')
            ->where(SharDB::tableName('order').'.id = :id', array(':id' => $o_id))
            ->select(null)
            ->select(array(SharDB::tableName('user').'.id', SharDB::tableName('user').'.review_describe', SharDB::tableName('user').'.review_com', SharDB::tableName('user').'.review_ship'));
        $array2 = $querySeller->fetch(); 
        $queryCount1 = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
            ->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('order').'.product_id')
            ->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('product').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('user').'.id = :id AND '.SharDB::tableName('order').'.review_describe is NOT NULL AND '.SharDB::tableName('order').'.review_com is NOT NULL AND '.SharDB::tableName('order').'.review_ship is NOT NULL', array(':id'=>$array2['id']));
        $num2=count($queryCount1->fetchAll());
        if($num2 > 1){
            $des = (($num2-1)*$array2['review_describe'] + $des) / $num2;
            $com = (($num2-1)*$array2['review_com'] + $com) / $num2;
            $ship = (($num2-1)*$array2['review_ship'] + $ship) / $num2;
        }

        $setBuyer=array('review_attitude'=> $att,'review_speed'=> $speed);
        $query1 = SharIt::db()->createCommand()->update(SharDB::tableName('user'))
            ->set($setBuyer)->where('id',$array1['id'])->execute();

        $setSeller=array('review_describe'=> $des,'review_com'=> $com,'review_ship'=> $ship);
        $query2 = SharIt::db()->createCommand()->update(SharDB::tableName('user'))
            ->set($setSeller)->where('id',$array2['id'])->execute();

        return true;
    }

    /**
     * [cancel cancel the order]
     * @param  [int] $o_id [order id]
     * @return [boolean]       [update success or not]
     */
	public static function cancel($o_id){
		$set=array('status' => SharQuery::$STATUSCODE['order_status']['CANCELED'], 'status_time' => new FluentLiteral('NOW()'));
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('order'))
		    ->set($set)->where('id',$o_id)->execute();

        $queryId=SharIt::db()->createCommand()->from(SharDB::tableName('order'))
            ->where('id',$o_id)
            ->select(null)
            ->select('product_id');
        $p_id=$queryId->fetch('product_id');

        $set1 = array('status' => SharQuery::$STATUSCODE['product_status']['ONSELL'], 'ts' => new FluentLiteral('NOW()'));
        $query1 = SharIt::db()->createCommand()->update(SharDB::tableName('product'))
            ->set($set1)->where('id',$p_id)->execute();
        return true;
	}
     
    /**
     * [getSeller get seller display name and email]
     * @param  [int] $o_id [order id]
     * @return [array]       [key value pair. display_name => , email => ]
     */
    public static function getSeller($o_id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
            ->leftJoin(SharDB::tableName('product').' ON '.SharDB::tableName('product').'.id = '.SharDB::tableName('order').'.product_id')
            ->leftJoin(SharDB::tableName('user').' ON '.SharDB::tableName('product').'.user_id = '.SharDB::tableName('user').'.id')
            ->where(SharDB::tableName('order').'.id = :id', array(':id' => $o_id))
            ->select(null)
            ->select(array(SharDB::tableName('user').'.display_name',SharDB::tableName('user').'.id',SharDB::tableName('user').'.email'));
        return $query->fetch();
    }  

    public static function getOrder($o_id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
            ->leftJoin(SharDB::tableName('product_info').' ON '.SharDB::tableName('product_info').'.id = '.SharDB::tableName('order').'.product_id')
            ->where(SharDB::tableName('order').'.id = :id', array(':id' => $o_id))
            ->select(array(SharDB::tableName('product_info').'.name',SharDB::tableName('product_info').'.product_condition',SharDB::tableName('product_info').'.price',
                            SharDB::tableName('product_info').'.upload_time',SharDB::tableName('product_info').'.category_name'));
        $array=$query->fetch();
        if($array){
            $arraySeller=self::getSeller($o_id);
            $array['seller_name']=$arraySeller['display_name'];
            $array['seller_email']=$arraySeller['email'];
            $array['seller_id']=$arraySeller['id'];
            $array['review_com'] = $array['review_com'] / 10;
            $array['review_ship'] = $array['review_ship'] / 10;
            $array['review_describe'] = $array['review_describe'] / 10;
            $array['review_attitude'] = $array['review_attitude'] / 10;
            $array['review_speed'] = $array['review_speed'] / 10;
        }
        return $array;
    } 

    public static function getOrderId($pid){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
            ->where('product_id = :product_id', array(':product_id' => $pid))
            ->select(null)
            ->select('id')
            ->orderBy('order_time DESC')
            ->limit(1);
        return $query->fetch('id');
    }  
}
?>