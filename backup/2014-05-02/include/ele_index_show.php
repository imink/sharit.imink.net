<br>
<!-- search input starts-->
<form action="<?php echo SharIt::app()->createUrl('product/items.php') ?>" method="get">
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="input-group input-group-lg">
    
      <input type="text" class="form-control" name="name" placeholder="Have a try">
      <span class="input-group-btn">
        <button class="btn btn-danger" type="submit" name="search" value="submit">Search</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<!-- search input ends -->
</form>
<br>


<!-- Flex Slider starts -->
<div class="flex-main">
  <div class="row">
    <div class="col-md-12">
            
      <div class="flex-image flexslider">
        <ul class="slides">
            <!-- Each slide should be enclosed inside li tag. -->
            
            
          <?php foreach ($productDisplay as $key => $value) { ?>
          <!-- Slide #1 -->

          <li>
            <!-- Image -->
            <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[product_id]))?>">
            <img src="<?php echo SharHTML::imgUrl("$value[picture_name]");?>" alt=""/>
            </a>
            <!-- Caption -->
            <div class="flex-caption">
               <!-- Title -->
               <h3><?php echo $value[name];?>  <span class="color">Just £<?php echo $value[price];?></span></h3>
               <!-- Para -->
               <p><?php echo $value[description];?></p>
               <div class="button">
                <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[product_id]))?>">Buy Now</a>
               </div>
            </div>
          </li>
          <?php } ?>
          
        </ul>
      </div>

    </div>
  </div>
</div>