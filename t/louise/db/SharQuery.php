<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharQuery
{
	
	public static $STATUSCODE = array(
		'user_status' => array(
				'UNACTIVATED' => 0,
				'ACTIVATED' => 1,
				'FROZEN' => -1),
		'product_status' => array(
				'ONSELL' => 0,
				'SOLDOUT' => 1,
				'DELETE_SOLDOUT' => 2,
				'DELETE_ONSELL' => 3),
		'product_onbid' => array(
				'ORIGINALSELL' => 0,
				'ONBID' => 1),
		'order_status' => array(
				'WAITPAYMENT' => 0,
				'WAITSHIPPING' => 1,
				'DISPATCHED' => 2,
				'BUYERREVIEWING' => 3,
				'SUCCEED' => 4,
				'CANCELED' => 5),
		'bid_status' => array(
				'HIDDEN' => 0,
				'SHOW' => 1),
		'category_status' => array(
				'UNUSABLE' => 0,
				'USABLE' => 1),
		'picture_status' => array(
				'HIDDEN' => 0,
				'MAIN' => 1,
				'SHOW' => 2),
		'request_status' => array(
				'HIDDEN' => 0,
				'SHOW' => 1,
				'DELECT' => -1,),
		);
}
?>