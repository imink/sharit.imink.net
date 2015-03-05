<?php
//single item edit page
require_once(dirname(dirname(__FILE__))."/framework/import.php");

// SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
SharIt::page()->setTitle("Edit Picture");


if(SharIt::request()->post('submitN')){
	$pid=SharIt::request()->post('pid');
}
if(SharIt::request()->post('submitM')){
	$pid=SharIt::request()->post('pid');
}
	if(SharIt::request()->get('pid')){
		$pid =SharIt::request()->get('pid');
	}
 

$uid = SharIt::auth()->uid;
$product=SharQueryProduct::getProduct($pid);

if($uid==$product[user_id]){
	if(SharIt::request()->get('delete')){
		$pic_id=SharIt::request()->get('pic_id');
		if(SharQueryPicture::deletePicture($pic_id)){
			SharIt::app()->flashMsg()->add('s',"Delete Success!");
		}
	}

	if(SharIt::request()->post('submitM')){
	$pictureM = SharIt::request()->files('picM');

	if($pictureM[name]==null){
		SharIt::app()->flashMsg()->add('e', "You did not upload a picture.");  
	}else{
		$return = SharFiles::uploadFile($pictureM,SHARIT_PATH_IMG,"productPic");

		SharQueryPicture::insertPictureMain(array('id'=>$pid,'picture_name'=>$return[0]));
		SharIt::app()->flashMsg()->add('s', "Upload main picture Succeed!");  
	}
    }

    if(SharIt::request()->post('submitN')){
	$pictureN = SharIt::request()->files('picN');
	if($pictureN[name]==null){
		SharIt::app()->flashMsg()->add('e', "You did not upload a picture.");  
	}else{
		$return = SharFiles::uploadFile($pictureN,SHARIT_PATH_IMG,"productPic");
		print_r($return);

		
		SharQueryPicture::insertPictureNormal(array('id'=>$pid,'picture_name'=>$return[0]));
		SharIt::app()->flashMsg()->add('s', "Upload normal picture Succeed!");  
	}
    }

	$check=array();
	$check[num]=0;
	$check[main]='false';
	$check[normal]='false';
	if($mainPic=SharQueryPicture::getPictureMain($pid)){
		$check[main]='true';
	}
	
	if($normalPic=SharQueryPicture::listPictureNormal($pid)){
		$num=count($normal);
		$check[num]+=$num;
		$check[normal]='true';

	}

}else{
	SharIt::exception()->notAValidUser();
}
$_LAYOUT['mid'] =  SharIt::app()->loadView("user/include/ele_editPicture.php",array('mainPic'=>$mainPic,'normalPic'=>$normalPic,'check'=>$check));

SharIt::app()->layout($_LAYOUT,1);
?>