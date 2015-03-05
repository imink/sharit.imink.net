<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQueryAuto
{
	/**
     * [makeBidOrder Automatic make the bid order when out of due date]
     * @param  [datetime] $date [recent date]
     * @return [array]       [info message]
     */
    public static function makeBidOrder($date){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('product'))
            ->where('due_date', $date)
            ->select(null)
            ->select('id');
        $array=$query->fetchAll();
        $arrayResult=array();
        foreach ($array as $key => $value) {
            $query1 = SharIt::db()->createCommand()->from(SharDB::tableName('bid'))
                ->where('product_id', $value['id']);
            $count=count($query1->fetchAll());
            if($count!=0){
                $arrayFinal=SharQueryBid::getFinalBid($value['id']);
                $num=SharQueryOrder::insertOrder($value['id'], $arrayFinal['user_id']);
                $arrayResult[$value['id']]=$num;
                SharQueryMain::insertPrice($arrayFinal['price'],$value['id']);
            }else{
                SharQueryManageProduct::closeBid($value['id']);
                SharQueryManageProduct::deleteProduct($value['id']);
            }
        } 
        return  $arrayResult;
    }

    public static function cancelOrder($date){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('order'))
        	->where('status', SharQuery::$STATUSCODE['order_status']['WAITPAYMENT'])
        	->select(null)
        	->select(array('id', 'order_time'));
        $array=$query->fetchAll();
        foreach ($array as $key => $value) {
        	$orderDate=substr($value['order_time'],0,10);
        	$days = (strtotime($date) - strtotime($orderDate)) / (60 * 60 * 24);
     		if($days==2){
     			SharQueryOrder::cancel($value['id']);
     		}
        }
        return true;
    }
}
?>