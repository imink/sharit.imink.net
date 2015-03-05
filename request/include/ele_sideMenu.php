<?php
// about us sideMenu

$categoryList = SharQueryRequest::listAllCategoryFromRequest();

$menuTitle = "Request";
				
$category = array();

$cid = SharIt::request()->get('cid');

$category["All"] = SharIt::app()->createUrl('request/list.php', array('cid'=>'-1'));;

foreach($categoryList as $key => $value){
	$cid_filter = $filter;
    $cid_filter['cid']=$key;
    unset($cid_filter[page]);
    $category[$value] = SharIt::app()->createUrl('request/list.php',$cid_filter);
}


$menuItems = array("Post a Request" => SharIt::app()->createUrl('request/post.php'),
					"View Request List" => $category);

SharHTML::sidemenu($menuTitle, $menuItems);

?>


