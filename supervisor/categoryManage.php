<?php
// supervisor categoryMange.php
require_once(dirname(dirname(__FILE__))."/framework/import.php");
if(SharIt::auth()->uid){
	$userid=SharIt::auth()->uid;
//SharIt::auth()->validateGroup(1,null,function(){SharIt::exception()->notAValidUser();});
	$gid=SharQuerySupervisor::getGid($userid);
	if($gid==2){
		$categoryForm = array();
		$categoryFormError = array();
		$categoryList = SharQueryMain::listCategory();



		$gourpCategory = SharQuerySupervisor::insertCategoryGroup($parent, $array);

		if($categoryForm = SharIt::request() -> post('categoryForm')){
			//print_r($categoryForm);
	// Create Validator
			$categoryValidator = SharValidator::key('parent1', SharValidator::shar_required('Category'))
			                                  ->key('single', SharValidator::shar_required('Single Category'));

			try{
				//echo "n";
				$categoryValidator->assert($categoryForm);
				//echo"m";
			} catch(\InvalidArgumentException $e) {
				$categoryFormErrors = $e->findMessages(array('Category','Single Category'));
			}

			if(!$categoryFormErrors){
    //echo $categoryForm[parent1];
    //echo $categoryForm[single];
           if(SharQuerySupervisor::getCategory($categoryForm[parent1])==0){
				$singleCategory =SharQuerySupervisor::insertCategoryGroup($categoryForm[parent1], array('category'=>$categoryForm[single]));
				SharQuerySupervisor::activateCategory($singleCategory);
				SharQuerySupervisor::activateCategory($singleCategory+1);
				SharIt::app()->flashMsg()->add('s', "Insert Succeed!");}else{
					$getId=SharQuerySupervisor::getCategoryId($categoryForm[parent1]);
					//print_r($getId);
					$getID=SharQuerySupervisor::insertCategory($categoryForm[single],$getId);
					SharQuerySupervisor::activateCategory($getID);
					SharIt::app()->flashMsg()->add('s', "Insert Succeed!");
				}
			}


		}


		$_LAYOUT['left'] =  SharIt::app()->loadView("supervisor/include/ele_sideMenu.php");
		$_LAYOUT['right'] =  SharIt::app()->loadView("supervisor/include/ele_category.php", array('categoryList' => $categoryList, 
			'categoryForm' => $categoryForm,
			'categoryFormErrors' => $categoryFormErrors));
	}else{
		SharIt::exception()->unAuth();
	}
}else{
	SharIt::exception()->notAValidUser();
}
SharIt::app()->layout($_LAYOUT,2);
?>