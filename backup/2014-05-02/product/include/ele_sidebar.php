<?php 
//$filter
// items sideMenu

$categoryList = SharQueryMain::listCategory();

$menuTitle = "Category";

$menuItems['All Category'] = SharIt::app()->createUrl('product/items.php');

foreach($categoryList as $key => $value){
    $parent = $value;
    foreach($parent as $key => $value){
        $child = $value;
        $tmp = array();
        foreach($child as $key => $value){
        	$cid_filter = $filter;
        	$cid_filter['category']=$key;
            unset($cid_filter[page]);
            $tmp[$value] = SharIt::app()->createUrl('product/items.php',$cid_filter);
        }
        $menuItems[$parent[name]] = $tmp;
    }
}

SharHTML::sidemenu($menuTitle, $menuItems);

// hottest items

$hottest = SharQueryListProduct::listHottestProduct();

// print_r($hottest);


$showTitle = "Hottest Items";

SharHTML::sideshow($showTitle, $hottest);



?>

