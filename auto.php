<?php
require_once("./framework/import.php");
if(SharIt::request()->get('code')=="auto"&&SharIt::request()->get('s')=="sharit"){
	$date = SharUtil::dateToday($format='Y-m-d');
	SharQueryAuto::makeBidOrder($date);
	SharQueryAuto::cancelOrder($date);
}
?>