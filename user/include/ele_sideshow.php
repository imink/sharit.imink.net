<?php 

$menuTitle = "My Profile";
if($uid==1){
$menuItems = array(
				"Published Record" => SharIt::app()->createUrl('aa.php'),
				"Requested Record" => "my-request",
				"Purchased Record" => "my-purchase",
				"Bid Record" => array(
					"Past" => "my-past",
					"1" => "2"),
				"Q&A Record" =>"my-q&a");
}else{
	$menuItems = array(
				"Published Record" => SharIt::app()->createUrl('aa.php'));
}

SharHTML::sidemenu($menuTitle, $menuItems);
