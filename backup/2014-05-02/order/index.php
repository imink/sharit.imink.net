<?php
// order index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$_LAYOUT['mid'] =  SharIt::app()->loadView("order/checkout.php");

SharIt::app()->layout($_LAYOUT,1);
?>