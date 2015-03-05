<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryBid
{
	/**
	 * insert a bid info
	 * @param  [integer] $price [insert new price]
	 * @param  [integer] $p_id  [product id]
	 * @param  [integer] $u_id  [user id]
	 * @return [boolean]        [whether insert a valiad bid info]
	 */
   	public static function insertBid($price, $p_id, $u_id){
	    $status=self::getStatus($p_id);
	   
	    $latest_price=self::getHighPrice($p_id);
	    
	    $on_bid=self::getStatusBid($p_id);
	   
	    if($price>$latest_price&&$on_bid==1&&$status==0){
			$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('bid'))
				->values(array(
					'price' => $price, 'product_id' => $p_id, 'user_id' => $u_id,
					'ts' => new FluentLiteral('NOW()'),'status'=>SharQuery::$STATUSCODE['bid_status']['SHOW']))
				->execute();
        	return true;
    	}else {
    		return false;
    	}
	} 

    /**
     * get the highest price for a bid
     * @param  [integer] $p_id [product id]
     * @return [integer]       [the highest price]
     */
      	public static function getHighPrice($p_id){
		
		$query1 = SharIt::db()->createCommand()->from(SharDB::tableName('bid'))
		    ->where('product_id = :product_id', array(':product_id' => $p_id));
       	$array= $query1->fetchAll();
        $num=count($array);
         if($num==0){
         	$query = SharIt::db()->createCommand()->from(SharDB::tableName('price'))
		    ->where('product_id = :product_id', array(':product_id' => $p_id))
            ->orderBy('ts DESC')
            ->limit(1);
            $price=$query->fetch('price');
         }else{
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('bid'))
		    ->where('product_id = :product_id', array(':product_id' => $p_id))
            ->orderBy('price DESC')
            ->limit(1);
            $price=$query->fetch('price');
        }
        return $price;
	} 

	/**
	 * get the final bid info
	 * @param  [integer] $p_id [product id]
	 * @return [array]       [all the bid info in bid table]
	 */
	public static function getFinalBid($p_id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('bid'))
		    ->where('product_id = :product_id', array(':product_id' => $p_id))
            ->orderBy('ts DESC')
            ->limit(1);
        return $query->fetch();
	} 

    /**
     * get the dead line of a bid
     * @param  [integer] $p_id [product id]
     * @return [array]       [get the dead line]
     */
    public static function getDeadline($p_id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product'))
		    ->where('id = :id', array(':id' => $p_id));
           
        return $query->fetch('due_date');
	} 
    
    /**
     * [get the onbid status of a product]
     * @param  [integer] $p_id [product id]
     * @return [array]       [the product's onbid status, 'ORIGINALSELL' => 0,'ONBID' => 1]
     */
    public static function getStatusBid($p_id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product'))
		    ->where('id = :id', array(':id' => $p_id));
           
        return $query->fetch('on_bid');
	} 

	/**
	 * [get the status of a product]
	 * @param  [integer] $p_id [product id]
	 * @return [array]       [the product's status, 'ONSELL' => 0,'SOLDOUT' => 1,'DELETE_SOLDOUT' => 2,'DELETE_ONSELL' => 3]
	 */
	public static function getStatus($p_id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product'))
		    ->where('id = :id', array(':id' => $p_id));
           
        return $query->fetch('status');
	}

	
}
?>