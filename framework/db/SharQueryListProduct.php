<?php
/**
 * @version 1.0
 * Last modified by MengxueHuang on 8_April
 * 
 */

class SharQueryListProduct
{
	
    /**
     * [listProduct list product according to different condition]
     * @param  [string]  $name     [the searching key words]
     * @param  [integer]  $category [category id]
     * @param  [integer]  $onbid    [pruduct's onbid status]
     * @param  [integer]  $page     [the recent page number]
     * @param  string  $order    [order by which condition]
     * @param  string  $sort     [increasing: ASC, decreasing: DESC]
     * @param  integer $perPage  [the number of product list in every page, defauld 10 ]
     * @return [array]            [all produnct info]
     */
    public static function listProduct($name,$category,$onbid,$page,$order='upload_time',$sort='DESC',$perPage=9){
        
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
            ->where('status = :status', array(':status'=>SharQuery::$STATUSCODE['product_status']['ONSELL']));
        if($category){
            $query->where('category_id = :id',array(':id'=>$category));
        }
        if($onbid){
            $query->where('on_bid = :bid',array(':bid'=>$onbid));
        }
        if($name){
            $key='%'.$name.'%';
            $query->where('name like :name OR description like :des',array(':name'=>$key,':des'=>$key));
        }
        if($page){
            $query->limit($perPage)->offset($perPage*($page-1));
        }
            $query->orderBy($order.' '.$sort);
        $array=$query->fetchAll();
        return $array;
    }

    public static function countProduct($name,$category,$onbid){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('product_info'))
            ->where('status = :status', array(':status'=>SharQuery::$STATUSCODE['product_status']['ONSELL']));
        if($category){
           $query->where('category_id = :id',array(':id'=>$category));
        }
        if($onbid){
             $query->where('on_bid = :bid',array(':bid'=>$onbid));
        }
        if($name){
            $key='%'.$name.'%';
            $query->where('name like :name OR description like :des',array(':name'=>$key,':des'=>$key));
        }
        $array=$query->fetchAll();
        $num=count($array);
        return $num;
    }

    /**
     * [List all products in decrease order of given base.
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $page  [the recent page number]
     * @param  [string] $order [ordered by what, price or upload_time]
     * @return [array]        [Sorted items containing all information in view_product_info]
     */
    public static function listProductDecrease($name,$page,$order){
        $array=self::listProduct($name,null,null,$page,$order,'DESC');
        return $array;
    }


    /**
     * [List all products in increase order of given base.]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $page  [the recent page number]
     * @param  [string] $order [ordered by what, price or upload_time]
     * @return [array]        [Sorted items containing all information in view_product_info]
     */
    public static function listProductIncrease($name,$page,$order){
        $array=self::listProduct($name,null,null,$page,$order,'ASC');
        return $array;
    }

    /**
     * [List all products in decrease order of seller's rating.]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $page [the recent page number]
     * @return [array]       [Sorted items containing all information in view_product_info and seller's ratings]
     */
    public static function listProductRate($name,$page){
        $array=self::listProduct($name,null,null,$page,'seller_rating','DESC');
        return $array;
    }
    
    /**
     * [List all product's user rating in decrease order of given base of a specific category]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $category_id [selected category id]
     * @param  [integer] $page        [the recent page number]
     * @return [array]              [sorted items contatining all product info and seller's ratings]
     */
    public static function listProductRateCategory($name,$category_id,$page){
        $array=self::listProduct($name,$category_id,null,$page,'seller_rating','DESC');
        return $array;
    }

    /**
     * [List all products in decrease order of given base of a specific category]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $category_id [selected category id]
     * @param  [integer] $page        [the recent page number]
     * @param  [string] $order [ordered by what, price or upload_time]
     * @return [array]              [Sorted items containing all information in view_product_info]
     */
    public static function listProductCategoryDecrease($name,$category_id, $page, $order){
         $array=self::listProduct($name,$category_id,null,$page,$order,'DESC');
        return $array;
    }

    /**
     * [List all products in increase order of given base of a specific category]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $category_id [selected category id]
     * @param  [integer] $page        [the recent page number]
     * @param  [string] $order [ordered by what, price or upload_time]
     * @return [array]              [Sorted items containing all information in view_product_info]
     */
    public static function listProductCategoryIncrease($name,$category_id, $page, $order){
        $array=self::listProduct($name,$category_id,null,$page,$order,'ASC');
        return $array;
    }

    /**
     * [List all products which are not onbid in decrease order]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $page        [the recent page number]
     * @param  [string] $order [ordered by what, price or upload_time]
     * @return [array]              [Sorted items containing all information in view_product_info]
     */
    public static function listProductNoBidDecrease($name,$page, $order){
        $array=self::listProduct($name,null,SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],$page,$order,'DESC');
        return $array;
    }

    /**
     * [List all products which are not onbid in increase order]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $page        [the recent page number]
     * @param  [string] $order [ordered by what, price or upload_time]
     * @return    [array]              [Sorted items containing all information in view_product_info]
     */
    public static function listProductNoBidIncrease($name,$page, $order){
       $array=self::listProduct($name,null,SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],$page,$order,'ASC');
        return $array;
    }

    /**
     * [List all products which are not onbid in decrease order of seller's rating]
     * @param  [string] $name  [the searching key words]
     * @param  [integer] $page        [the recent page number]
     * @return [array]       [sorted items contatining all product info and seller's ratings]
     */
    public static function listProductRateNoBid($name,$page){
        $array=self::listProduct($name,null,SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],$page,'seller_rating','DESC');
        return $array;
    }

    /**
     * List all products of a given category which are not onbid in decrease order of given order.
     * @param  [type] $name        The searching key words.
     * @param  [type] $category_id The id of given category
     * @param  [type] $page        the recent page number
     * @param  [type] $order       ordered by what, price or upload_time
     * @return [type]  An array     sorted items contatining all information of view_product_info
     */
    public static function listProductNoBidCategoryDecrease($name,$category_id,$page, $order){
        $array=self::listProduct($name,$category_id,SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],$page,$order,'DESC');
        return $array();
    }

    /**
     *List all products of a given category which are not onbid in increase order of given order.
     * @param  [type] $name        The searching key words.
     * @param  [type] $category_id The id of given category
     * @param  [type] $page        the recent page number
     * @param  [type] $order       ordered by what, price or upload_time
     * @return [type] An array      sorted items contatining all information of view_product_info
     */
    public static function listProductNoBidCategoryIncrease($name,$category_id,$page, $order){
        $array=self::listProduct($name,$category_id,SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],$page,$order,'ASC');
        return $array;
    }

     /**
      * List all products of a given category which are not on bid ordered by the rating of sellers
      * @param  [type] $name        The searching key words.
      * @param  [type] $category_id The id of given category
      * @param  [type] $page        the recent page number
      * @return [type] An array     sorted items containing all information of view_product_info
      */
     public static function listProductRateNoBidCategory($name,$category_id,$page){
       $array=self::listProduct($name,$category_id,SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL'],$page,'seller_rating','DESC');
        return $array;
    }


    /**
     * List all products which are on bid ordered by their due_dates
     * @param  [type] $name     The searching key words.
     * @param  [type] $page     the recent page number
     * @return [type] An array  sorted items containing all information of view_product_info.  
     */
    public static function listProductOnBid($name,$page){
        $array=self::listProduct($name,null,SharQuery::$STATUSCODE['product_status']['ONSELL'],$page,'due_date','DESC');
        return $array;
    }


    /**
     * List all products of a given category which are on bid ordered by their due_dates
     * @param  [type] $name        The searching key words.
     * @param  [type] $category_id The id of given category
     * @param  [type] $page        the recent page number
     * @return [type] An array     sorted items containing all information of view_product_info.        
     */
    public static function listProductOnBidCategory($name,$category_id,$page){
        
        $array=self::listProduct($name,$category_id,SharQuery::$STATUSCODE['product_status']['ONSELL'],$page,'due_date','DESC');
        return $array;
    }

    /**
     * [listHottestProduct description]
     * @return [type] [description]
     */
    public static function listHottestProduct(){
        $query = SharIt::db()->createCommand()->from(SharDB::tableName('product'))
            //->leftJoin(SharDB::tableName('picture').' ON '.SharDB::tableName('picture').'.product_id = '.SharDB::tableName('product').'.id')
            ->where(SharDB::tableName('product').'.status = :status', array(':status' => SharQuery::$STATUSCODE['product_status']['ONSELL']))
            //->select(SharDB::tableName('picture').'.picture_name')
            ->orderBy(SharDB::tableName('product').'.view_number DESC')
            ->limit(5);
        $array=$query->fetchAll();
        foreach ($array as $key => $value) {
            $price=SharQueryMain::getPrice($value['id']);
            $picture=SharQueryPicture::getPictureMain($value['id']);
            $value['price']=$price;
            $value['picture_name']=$picture['picture_name'];
            $array[$key]=$value;
        }
        return $array;
    }
}
?>