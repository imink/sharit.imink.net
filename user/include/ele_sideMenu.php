<?php 
// user sidebar
$menuTitle = "My Account";
if(SharIt::auth()->gid==1){
$menuItems = array(
				"My Records" => array(
					"Published Record" => SharIt::app()->createUrl('user/publish.php'),
					"Requested Record" => SharIt::app()->createUrl('user/request.php'),
					"Purchased Record" => SharIt::app()->createUrl('user/purchase.php'),
					"Bid Record" => SharIt::app()->createUrl('user/bid.php'),
					"Q&A Record" => SharIt::app()->createUrl('user/q&a.php')),
				"My Profile" => array(
					"View Profile" => SharIt::app()->createUrl('user/view.php'),
					"Edit Profile" => SharIt::app()->createUrl('user/edit.php'))
				);
}else{
$menuItems = array(
				"My Records" => array(
					"Published Record" => SharIt::app()->createUrl('user/publish.php'),
					"Q&A Record" => SharIt::app()->createUrl('user/q&a.php')),
				"My Profile" => array(
					"View Profile" => SharIt::app()->createUrl('user/view.php'),
					"Edit Profile" => SharIt::app()->createUrl('user/edit.php'))
				);
}

SharHTML::sidemenu($menuTitle, $menuItems);
