<?php
// anna
require_once(dirname(dirname(dirname(__FILE__)))."/framework/import.php");
echo "<h1>This is test for Sharit[anna]</h1>";
//$user=SharQuerySupervisor::actUserS(2);
 //print_r($user);
$_LAYOUT['mid'] =  SharIt::app()->loadView("user/include/ele_forgetp.php");
SharIt::app()->layout($_LAYOUT,1);
echo"<br >";
echo "~~~~~~~~";









?>