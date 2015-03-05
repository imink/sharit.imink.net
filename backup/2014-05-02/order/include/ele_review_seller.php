<?php
//$productData
//$buyerData
//
//$orderData
if ($formError){
  SharHTML::alert('danger',$formError);
}
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
            <!-- Attitude -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Attitude</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="order[review_attitude]" value= "<?php echo $reviewSellerForm[review_attitude]?>">
                </div>
            </div>

            <!-- Confirmation speed -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Confirmation Speed</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="order[review_speed]" value= "<?php echo $reviewSellerForm[review_speed]?>">
                </div>
            </div>
    <!-- Review show to seller ends -->

    <hr>
        <div class="pull-right">
            <input type="submit" class="btn btn-danger" id="submit" value="Review">
            <input type="reset" class="btn btn-default" id="reset" value="Reset">
        </div>
    </div>
    </form>
</div>
<!-- Review Details Ends -->


