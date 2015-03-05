<?php
// request single request
require_once(dirname(dirname(__FILE__))."/framework/import.php");
$check=array();

if(!$uid = SharIt::auth()->uid){
	$check[login]= 'false';
}else{
	$check[login]= 'true';
	$gid=SharQuerySupervisor::getGid($uid);
	if($gid==2){
		SharIt::exception()->unAuth();
	}
}

if(SharIt::request()->get('page')){
	$page = SharIt::request()->get('page');
	$request_id = SharIt::request()->get('id');
}
//temp use
$request_id = SharIt::request()->get('id');

$request_info = array();
$single_Request = array();
$requester = array();

$replyForm = array();
$replyFormError = array();

$request_info = SharQueryRequest::getRequest($request_id);

$single_Request[ts] = $request_info[ts];
$requester = SharQueryAccount::getUser($request_info[user_id]);
$single_Request[username] = $requester[display_name];
$single_Request[category_id] = $request_info[category_id];
$single_Request[category] = SharQueryMain::getCategory($request_info[category_id]);
$single_Request[replyNo] = SharQueryRequest::countReply($request_id);
$single_Request[topic] = $request_info[topic];
$single_Request[message] = $request_info[message];
$single_Request[requester_id] = $request_info[user_id];

$allReply = array();
$reply_info = array();
$single_reply = array();
$replier = array();

$allReply = SharQueryRequest::listReply($request_id);
$reply = array();
foreach($allReply as $key => $value){
    $reply_info = $value;
    $single_Reply = array();
    $product = SharQueryProduct::getProduct($reply_info[product_id]);

    $picture = array();
    $picture = SharQueryPicture::getPictureMain($reply_info[product_id]);
    $single_Reply[picture_name] = $picture[picture_name];

	$single_Reply[item_name] = $product[name];
	$single_Reply[item_id] = $reply_info[product_id];
	$single_Reply[ts] = $reply_info[ts];
	$single_Reply[item_price] = $product[price];

	if($product[status]==SharQuery::$STATUSCODE['product_status']['ONSELL'])
		$single_Reply[item_status] = "On Sell";
	elseif($product[status]==SharQuery::$STATUSCODE['product_status']['SOLDOUT'])
		$single_Reply[item_status] = "Sold Out";
	elseif($product[status]==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT'])
		$single_Reply[item_status] = "Deleted by Seller";
	elseif($product[status]==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL'])
		$single_Reply[item_status] = "Deleted by Seller";

	$current = array($key=>$single_Reply);
	$reply = array_merge($reply, $current);
}

$replier[id] = SharIt::auth()->uid;
$replier[item_list] = SharQueryRequest::listPublish($replier[id]);

if($replyForm =SharIt::request()->post('postReply')){

	$replier_info = array();
	$replier_info = SharQueryAccount::getUser($replier[id]);
	if($replier_info[status]!=SharQuery::$STATUSCODE['user_status']['ACTIVATED']){
		SharIt::exception()->notAValidUser();
	}

	if(!$replyForm[item_id]){
		$replyForm[item_id]=-1;
	}

	if(!$replyForm[agree]){
		$replyForm[agree]='off';
	}

	$replyValidator = SharValidator::key('item_id',SharValidator::shar_notEmptyList('Reply item'))
									->key('agree',SharValidator::shar_ischosen('The terms of use'));

	try {
	    $replyValidator->assert($replyForm);
	} catch(\InvalidArgumentException $e) {
		$replyFormError = $e->findMessages(array('Reply item','The terms of use'));
	}

	if(!$replyFormError){

		$reply_item_id = $replyForm[item_id];

		$product = SharQueryProduct::getProduct($reply_item_id);

		if($product[status]!=SharQuery::$STATUSCODE['product_status']['ONSELL']){
			SharIt::exception()->noProduct();
		}

		if($product[user_id]!=$replier[id]){
			SharIt::exception()->notSellerOrBuyer();
		}
		if(!$replyFormError){		
			SharQueryRequest::insertReply($request_id, $reply_item_id);
			SharIt::app()->redirect('request/single',array('id'=>$request_id));
		}
	}
}


$_LAYOUT['left'] = SharIt::app()->loadView("request/include/ele_sideMenu.php");
$_LAYOUT['right'] = SharIt::app()->loadView("request/include/ele_single.php",array('reply'=>$reply,
																				'single_Request'=>$single_Request,
																				'replier'=>$replier,
																				'replyForm'=>$replyForm,
																				'replyFormError'=>$replyFormError,
																				'check'=>$check));

SharIt::app()->layout($_LAYOUT,2);
?>