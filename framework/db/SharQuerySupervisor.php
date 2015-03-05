<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * All the functions are only used in view account
 */
class SharQuerySupervisor
{
	/**
	 * [frozenUser freaze a user]
	 * @param  [int] $u_id [user id]
	 * @return [boolean]       [update success or not]
	 */
    public static function frozenUser($u_id){
		$set=array('status' => SharQuery::$STATUSCODE['user_status']['FROZEN']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'))
		->set($set)->where('id',$u_id)->execute();
		
        return true;
	}

	/**
	 * [insertCategory insert a new singe category]
	 * @param  [string] $name   [category name]
	 * @param  [int] $parent [parent id]
	 * @return [string]         [id in category table]
	 */
	public static function insertCategory($name,$parent){
		$set=array('parent_id' => $parent, 'name' => $name, 'status' => SharQuery::$STATUSCODE['category_status']['UNUSABLE']);
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('category'))
		->values($set);
		$num=$query->execute();	
        return $num;
	}

	/**
	 * [insertCategoryGroup insert a new category group]
	 * @param  [string] $parent [category group name, parent category's name]
	 * @param  [array] $array  [all the category in the group]
	 * @return [boolean]         [insert success or not]
	 */
	public static function insertCategoryGroup($parent,$array){
		$parent_id=self::insertCategory($parent,0);
		foreach($array as $key=>$value){
			self::insertCategory($value,$parent_id);
		}
		return $parent_id;
	}


	/**
	 * Change the status of category to hide the category
	 * @param  [type] $id category_id
	 * @return boolean
	 */
	public static function deleteCategory($id){
		
		$status = array('status' => SharQuery::$STATUSCODE['category_status']['UNUSABLE']);
		print_r($status);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('category'),
			$status,$id)
			->limit(1);
       		
       		$query->execute();
        return true;
	}

	/**
	 * Activate the category.
	 * @param  [type] $id category id
	 * @return boolean     */
	public static function activateCategory($id){
		$status = array('status' => SharQuery::$STATUSCODE['category_status']['USABLE']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('category'),
			$status,$id)
			->limit(1);
			
			$query->execute();
			 return true;
	}

	public static function insertPictureDisplay($array){
		
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('picture'))
			->values(array(
				'product_id' => $array['id'],'picture_name' => $array['picture_name'],'status' => SharQuery::$STATUSCODE['picture_status']['DISPLAY']))
			->execute();
        return true;
	}

    public static function deletePictureDisplay(){
    	$array=SharQueryShow::getPictureDisplay();
    	foreach ($array as $key=>$value){
    		$status = array('status' => SharQuery::$STATUSCODE['picture_status']['HIDDEN']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('picture'),
			$status, $value['id'])->limit(1)->execute();
    	}
		
        return true;
	}

	public static function insertAdvertisement($id, $name, $description){
	
		$query = SharIt::db()->createCommand()->insertInto(SharDB::tableName('advertisement'))
			->values(array(
				'product_id' => $id, 'name' => $name, 'description' => $description, 
				'status' => SharQuery::$STATUSCODE['advertisement_status']['SHOW']));
			$number=$query->execute();
		
        return $number;
    }

    public static function deleteAdvertisement(){
    	$array=SharQueryShow::getAdvertisementAll();
    	foreach ($array as $key=>$value){
    		$status = array('status' => SharQuery::$STATUSCODE['advertisement_status']['HIDDEN']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('advertisement'),
			$status, $value['id'])->limit(1)->execute();
    	}
		
        return true;
	}

	public static function getGid($id){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
			->where('id = :id ',array(':id' => $id))
			->select(null)
			->select(array('gid'));
		$gid = $query->fetch('gid');
		
        return $gid;
	}
    
    public static function getUserS($email){
		
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('user'))
			->where('email = :email AND gid = :gid',array(':email' => $email, ':gid' => 1))
			->select(null)
			->select(array('display_name', 'id', 'status','email'));
		$array = $query->fetch();
		
        return $array;
	}
public static function listPublishS($id, $page){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
			->where('user_id = :user_id', array(':user_id' => $id))
            ->orderBy('ts,status DESC')
            ->limit(10)
            ->offset(10*($page-1));
        return $query->fetchAll();
	}

	public static function countProductS($id){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
			->where('user_id = :user_id', array(':user_id' => $id));
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }

	public static function actUserS($u_id){
		$set=array('status' => SharQuery::$STATUSCODE['user_status']['ACTIVATED']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('user'))
		->set($set)->where('id',$u_id)->execute();
		
        return true;
	}

	public static function deleteProductS($id){
		$query = SharIt::db()->createCommand()-> from(SharDB::tableName('product'))
				->where('id = :id ', array(':id' => $id))
				->select('status');
		if($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['ONSELL']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']);
		}
		elseif($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['SOLDOUT']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']);
		}
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->limit(1)->execute();
        return true;
	}

    public static function restoreProductS($id){
		$query = SharIt::db()->createCommand()-> from(SharDB::tableName('product'))
				->where('id = :id ', array(':id' => $id))
				->select('status');
		if($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['ONSELL']);
		}
		elseif($query->fetch('status')==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']){
			$status=array('status' => SharQuery::$STATUSCODE['product_status']['SOLDOUT']);
		}
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('product'),
			$status, $id)->limit(1)->execute();
        return true;
	}

	public static function getCategory($name){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('category'))
			->where('name = :name AND parent_id = :parent_id',array(':name'=>$name,':parent_id'=>0));
		$num=count($query->fetchAll());
		return $num;
	}

	public static function getCategoryId($name){
		$query = SharIt::db()->createCommand()->from(SharDB::tableName('category'))
			->where('name = :name',array(':name'=>$name))
			->select(null)
			->select('id');
		return $query->fetch();
	}
   
   public static function activeAdvertisement(){
     
    		$status = array('status' => SharQuery::$STATUSCODE['picture_status']['DISPLAY']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('picture'),
			$status, 111)->limit(1)->execute();
		$status = array('status' => SharQuery::$STATUSCODE['advertisement_status']['SHOW']);
		$query = SharIt::db()->createCommand()->update(SharDB::tableName('advertisement'),
			$status, 1)->limit(1)->execute();
    	
        return true;
   }

}
?>