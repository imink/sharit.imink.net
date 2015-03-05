<?php
// product index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$_LAYOUT['left'] =  SharIt::app()->loadView("product/include/ele_sidebar.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("product/include/ele_items.php");

SharIt::app()->layout($_LAYOUT,2);
?>