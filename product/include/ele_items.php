<?php

$sort = array('1'=>'Latest',
              '2'=>'Oldest',
              '3'=>'Price (Low - High)',
              '4'=>'Price (High - Low)',
              '5'=>'Ratings');
SharIt::page()->registerCss(".item-list-name{min-height:50px;max-height:50px;overflow-y: auto;}");
?>

<!-- Title -->
<h4 class="pull-left">Product List</h4>
<br><hr>
<!-- Search Form -->
<div class="col-md-12 col-md-offset-12">
  <div class="row">
    <!-- Search form -->
    <form class="form-inline" role="form" method="get">
    <input type="hidden" name="category" value="<?php echo $filter[category]?>" >
    <input type="hidden" name="page" value="<?php echo $filter[page]?>" >
    <div class="form-group">
        <div class="col-md-5 col-sm-4 hidden-xs">
            <input type="text" class="form-control" name="name" placeholder="search">
        </div>
        <div class="col-md-4 col-sm-4">                             
            <select class="form-control" name="sortby">
                <option disabled selected> --- Sort By --- </option>
                <?php
                  foreach($sort as $key => $value){
                      echo "<option value=\"$key\" >$value</option>";
                  }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-4">  
            <div class="checkbox inline">
              <label>
                <input type="checkbox" name="onbid" <?php if($filter[onbid]=="1") echo 'checked'?>> On Bid
              </label>
            </div>
        </div>
        <div class="col-md-1 col-sm-4 pull-right">
            <button type="submit" class="btn btn-danger" name="search" value="submit">Search</button>
        </div>      
    </div>
    </form>
  </div>
</div>

<hr>

<div class="clearfix"></div>
<div class="row">
  <!-- Item #1 -->
  <?php foreach ($productInfo as $key => $value) { ?>
  <div class="col-md-4 col-sm-6">
    <div class="item">
      <!-- Item image -->
      <div class="item-image">
        <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[id]))?>">
        <?php $pictureMain = SharQueryPicture::getPictureMain($value[id]);?>
        <img src="<?php echo SharHTML::imgUrl("$pictureMain[picture_name]");?>" alt="" class="img-responsive"></a>
      </div>
      <!-- Item details -->
      <div class="item-details">
        <!-- Name -->
        <div class="item-list-name">
        <h5><a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[id]))?>"><?php echo $value[name] ?></a></h5>
        </div>
        <!-- Para. Note more than 2 lines. -->
        <hr>
        <!-- Price -->
        <div class="item-price pull-left">£<?php echo $value[price] ?></div>
        <!-- View Details -->
        <div class="button pull-right"><a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[id]))?>">View Details</a></div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<!-- Pagination -->
<?php
$page_filter = $filter;
$page_filter['page']='[:page]';
echo SharHTML::paging($filter[page], $totalPageNum, SharIt::app()->createUrl('product/items.php',$page_filter));
?> 