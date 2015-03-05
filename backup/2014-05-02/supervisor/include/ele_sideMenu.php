<?php 
// user sidebar
$menuTitle = "Administrator Panel";
$menuItems = array(
				"User Management" => SharIt::app()->createUrl('supervisor/userManage.php'),
				"Product Management" => SharIt::app() -> createUrl('supervisor/productManage.php'),
				"Category Management" => SharIt::app() -> createUrl('supervisor/categoryManage.php'),
				"Advertisement" => SharIt::app() -> createUrl('supervisor/advertisement.php')
				);

SharHTML::sidemenu($menuTitle, $menuItems);
