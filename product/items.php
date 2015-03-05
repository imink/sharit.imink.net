<?php
// product item list
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$filter=array();

if(!$filter[name] = SharIt::request()->get('name')){
	$filter[name] = null;
}
if(!$filter[onbid] = SharIt::request()->get('onbid')){
	$filter[onbid] = null;
}else{
	$filter[onbid] = SharQuery::$STATUSCODE['product_onbid']['ONBID'];
}

if(!$filter[sortby] = SharIt::request()->get('sortby')){
	$filter[order]= 'upload_time';
	$filter[sort] = 'DESC';
}else{
	if($filter[sortby]=='1'||$filter[sortby]=='2'){
		$filter[order] = 'upload_time';
	}elseif($filter[sortby]=='3'||$filter[sortby]=='4'){
		$filter[order] = 'price';
	}elseif($filter[sortby]=='5'){
		$filter[order] = 'seller_rating';
	}
	if($filter[sortby]=='1'||$filter[sortby]=='4'||$filter[sortby]=='5'){
		$filter[sort] = 'DESC';
	}elseif($filter[sortby]=='2'||$filter[sortby]=='3'){
		$filter[sort] = 'ASC';
	}
}

if(!$filter[category] = SharIt::request()->get('category')){
	$filter[category] = null;
}
if(!$filter[page]= SharIt::request()->get('page')){
	$filter[page] = 1;
}
$filter[perpage] = 9;
$totalProduct=SharQueryListProduct::countProduct($filter[name],$filter[category],$filter[onbid]);
$totalPageNum=ceil($totalProduct/$filter[perpage]);

$_LAYOUT['left'] =  SharIt::app()->loadView("product/include/ele_sidebar.php",array('filter'=>$filter));

if($totalProduct==0){
	if(SharIt::auth()->uid){
		if(SharQueryAccount::getUser(SharIt::auth()->uid)){
			$checkuser='true';
		}else{
			SharIt::exception()->NotAValidUser();
		}
	}else{
		$checkuser='false';
	}

	$_LAYOUT['right'] =  SharIt::app()->loadView("product/include/ele_no_product.php",array('checkuser'=>$checkuser));
}else{
$productInfo=SharQueryListProduct::listProduct($filter['name'],$filter['category'],$filter['onbid'],$filter['page'],$filter['order'],$filter['sort'],$filter['perpage']);
foreach ($productInfo as $key => $value) {
	$pic=SharQueryPicture::getPictureMain($value[id]);
	$value[picture]=$pic[picture_name];
	$productInfo[$key]=$value;
}
$_LAYOUT['right'] =  SharIt::app()->loadView("product/include/ele_items.php",array('totalPageNum'=>$totalPageNum,'filter'=>$filter,'productInfo'=>$productInfo));
}

SharIt::app()->layout($_LAYOUT,2);
?>