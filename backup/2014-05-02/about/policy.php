<?php
// about us policy
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$_LAYOUT['left'] =  SharIt::app()->loadView("about/include/ele_sideMenu.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("about/include/ele_policy.php");


SharIt::app()->layout($_LAYOUT,2);
?>