<?php 
// about us sideMenu
$menuTitle = "About Us";
$menuItems = array(
				"About Us" => SharIt::app()->createUrl('about/about.php'),
				"Contact Us" => SharIt::app()->createUrl('about/contact.php'),
				"Policy" => SharIt::app()->createUrl('about/policy.php')
			 );

SharHTML::sidemenu($menuTitle, $menuItems);
