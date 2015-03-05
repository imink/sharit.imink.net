<?php
//$productData
//$buyerData
//
//$orderData
?>
<!-- Confirm Order Starts -->
<?php include(dirname(__FILE__)."/ele_both.php") ?>
<?php include(dirname(__FILE__)."/ele_order_time.php") ?>
<!-- Review Details Starts -->

<div class="row">
    <h4 class="title">Review Details</h4>
    <div class="col-md-12 col-md-offset-12">
        <!-- Review show to buyer starts -->
       <form class="form-horizontal" method="post">
        <!-- Review show to seller starts -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Item as Described</label>
                <div class="col-md-6">
                  <p><?php echo $productData[review_describe]?></p>
                </div>
            </div>

            <!-- Communication -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Communication</label>
                <div class="col-md-6">
                  <p><?php echo $productData[review_com]?></p>
                </div>
            </div>

            <!-- Shipping speed -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Shipping Speed</label>
                <div class="col-md-6">
                  <p><?php echo $productData[review_ship]?></p>
                </div>
            </div>
            <!-- Attitude -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Attitude</label>
                <div class="col-md-6">
                  <p><?php echo $productData[review_attitude]?></p>
                </div>
            </div>

            <!-- Confirmation speed -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Confirmation Speed</label>
                <div class="col-md-6">
                  <p><?php echo $productData[review_speed]?></p>
                </div>
            </div>
    <!-- Review show to seller ends -->
    
    <hr>
    </div>
    </form>
</div>