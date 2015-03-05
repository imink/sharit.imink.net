<?php

require_once("./framework/import.php");

SharIt::page()->setTitle("Homepage");

$productDisplay = SharQueryShow::getAdvertisement();

// print_r($productDisplay);

$_LAYOUT['mid'] =  SharIt::app()->loadView("include/ele_index_show.php", array('productDisplay' => $productDisplay));

SharIt::app()->layout($_LAYOUT,1);
?>