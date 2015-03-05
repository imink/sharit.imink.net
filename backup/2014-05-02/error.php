<?php
// 404 index
require_once(dirname(__FILE__)."/framework/import.php");

$code = SharIt::request()->get('code');
$message = SharRequest::errorCodeMessage($code);

$_LAYOUT['mid'] =  SharIt::app()->loadView("include/ele_error.php",array('code'=>$code,'message'=>$message));

SharIt::app()->layout($_LAYOUT,1);
?>