<?php
// about us about
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$_LAYOUT['left'] =  SharIt::app()->loadView("about/include/ele_sideMenu.php");

$_LAYOUT['right'] =  SharIt::app()->loadView("about/include/ele_about.php");

SharIt::app()->layout($_LAYOUT,2);
?>