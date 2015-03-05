<?php
// about us index
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$left = SharIt::app()->loadView("user/ele_sidebar.php");
$left .= SharIt::app()->loadView("user/ele_sidebshow.php");
$_LAYOUT['left'] =  $left;

$_LAYOUT['right'] =  SharIt::app()->loadView("user/my-bid.php");

SharIt::app()->layout($_LAYOUT,2);
?>