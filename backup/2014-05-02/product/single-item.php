<?php
// product single item
require_once(dirname(dirname(__FILE__))."/framework/import.php");

$questionForm;
$questionErrors = array();

$pid = SharIt::request()->get('pid');

$product = SharQueryProduct::getProduct($pid);

$user = SharQueryAccount::getUser($product[user_id]);
$q_a = SharQueryProduct::listQanda($product[id]);
$user_q = SharQueryAccount::getUser($q_a[user_id]);

$price = array();
$price[price] = SharQueryMain::getPrice($product[id]);   
$price[highest] = SharQueryBid::getHighPrice($product[id]);

$priceHistory = SharQueryProduct::listPrice($product[id]);
$pictureList = SharQueryPicture::listPictureNormal($product[id]);
$pictureMain = SharQueryPicture::getPictureMain($product[id]);


$uid = SharIt::auth()->uid;
if($product[user_id] != $uid){
	SharQueryProduct::updateViewNo($product[id],$product[view_number]);
	$isSeller='false';
}else{
	$isSeller='true';
}
if(SharIt::auth()->uid){
	$isLogin='true';
}else{
	$isLogin='false';
}
$checkUser=array('isSeller'=>$isSeller,'isLogin'=>$isLogin);



if($product[on_bid]==SharQuery::$STATUSCODE['product_onbid']['ONBID']){
	$productInfo=array();
	$productInfo['pid']=$product[id];
	$productInfo['price']=$price[highest];
	$productInfo['due_date']=$product[due_date];
}

$seller_rating=$product[seller_rating]/10;

$_LAYOUT['left'] =  SharIt::app()->loadView("product/include/ele_sidebar.php");

$bidForm;
$bidErrors = array();
if($bidForm = SharIt::request()->post('bid')){
	if(SharIt::auth()->uid){
	if(SharQueryAccount::getUser(SharIt::auth()->uid)){
	if($product[user_id]!=SharIt::auth()->uid){
	$bidValidator = SharValidator::key('price', SharValidator::shar_required('Bid price'))
								  ->key('price', SharValidator::shar_productPrice('Bid price'));
	
	if($bidForm[agree]){
		$bidValidator->key('agree',SharValidator::shar_ischosenbid('The agree of Terms and Conditions'));
	}else{
		$bidForm[agree]='off';
		$bidValidator->key('agree',SharValidator::shar_ischosenbid('The agree of Terms and Conditions'));
	}
	try{
		$bidValidator->assert($bidForm);
	}catch(\InvalidArgumentException $e){
		$bidErrors=$e->findmessages(array('Bid price','The agree of Terms and Conditions'));
	}
	if(!$bidErrors){
		if($bidForm[price]<=$productInfo[price]){
			SharIt::app()->flashMsg()->add('e',"Your price should be higher than current price!");
			
		}else{
			$buyer_id=SharIt::auth()->uid;
			if(SharQueryBid::insertBid($bidForm[price], $productInfo[pid],$buyer_id)){
				SharIt::app()->flashMsg()->add('s',"Bid Successful!");
				$price[highest] = SharQueryBid::getHighPrice($product[id]);
			}
			}
		}
	}else{
		SharIt::exception()->ownProduct();	
	}
	}else{
		SharIt::exception()->NotAValidUser();
	}	
	}else{
		SharIt::exception()->NotAValidUser();
	}
}
// handling the questions
$questionForm;
$questionErrors = array();
if($questionForm = SharIt::request()->post('questionForm')){
	if(SharIt::auth()->uid){
		if(SharQueryAccount::getUser(SharIt::auth()->uid)){
			if($product[user_id]!=SharIt::auth()->uid){
				$questionValidator = SharValidator::key('content', SharValidator::shar_required('Question'))
				->key('content', SharValidator::shar_qa('Question'));

				try{
					$questionValidator->assert($questionForm);
				} catch(\InvalidArgumentException $e){
					$questionErrors = $e->findmessages(array('Question'));
				}
				if(!$questionErrors){
					if(SharQueryManageProduct::insertQuestion($questionForm[pid], $uid, $questionForm[content])){
						SharIt::app()->flashMsg()->add('s',"Ask Successfully!");
						$q_a = SharQueryProduct::listQanda($product[id]);
					}
				}
			}else{
				SharIt::exception()->askOwnProduct();
			}	
		}else{
			SharIt::exception()->NotAValidUser();
		}	
	}else{
		SharIt::exception()->NotAValidUser();
	}
}

$replyForm;
$replyErrors = array();
if($replyForm = SharIt::request()->post('reply')){
	if(SharIt::auth()->uid){
		if(SharQueryAccount::getUser(SharIt::auth()->uid)){
			if($product[user_id]==SharIt::auth()->uid){
				$replyValidator = SharValidator::key('content', SharValidator::shar_required('Answer'))
											   ->key('content', SharValidator::shar_qa('Answer'));

				try{
					$replyValidator->assert($replyForm);
				}catch(\InvalidArgumentException $e){
					$replyErrors=$e->findmessages(array('Answer'));
				}
				if(!$replyErrors){
					if(SharQueryManageProduct::insertAnswer($replyForm[qid],$replyForm[content])){
						SharIt::app()->flashMsg()->add('s',"Reply Successful!");
						$q_a = SharQueryProduct::listQanda($product[id]);
					}
				}
			}else{
				SharIt::exception()->notOwnProduct();	
			}
		}else{
			SharIt::exception()->NotAValidUser();
		}	
	}else{
		SharIt::exception()->NotAValidUser();
	}
}
	$_LAYOUT['right'] =  SharIt::app()->loadView("product/include/ele_single-item.php", 
											array('product' => $product, 
												  'price' => $price, 
												  'user' => $user, 
												  'q_a' => $q_a, 
												  'user_q' => $user_q, 
												  'priceHistory' => $priceHistory,
												  'pictureList' => $pictureList,
												  'pictureMain' => $pictureMain,
												  'seller_rating'=>$seller_rating,
												  'productInfo'=>$productInfo,
												  'bidErrors'=>$bidErrors,
												  'replyErrors'=>$replyErrors,
												  'questionErrors'=>$questionErrors,
												  'checkUser'=>$checkUser));


SharIt::app()->layout($_LAYOUT,2);
?>