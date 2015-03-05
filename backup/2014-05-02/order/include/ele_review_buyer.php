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
            <!-- describe -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Item as Described</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="order[review_describe]" value= "<?php echo $reviewBuyerForm[review_describe]?>">
                </div>
            </div>

            <!-- Communication -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Communication</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="order[review_com]" value= "<?php echo $reviewBuyerForm[review_com]?>">
                </div>
            </div>

            <!-- Shipping speed -->
            <div class="form-group"> 
                <label class="control-label col-md-3">Shipping Speed</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="order[review_ship]" value= "<?php echo $reviewBuyerForm[review_ship]?>">
                </div>
            </div>
        <!-- Review show to buyer ends -->

    <hr>
        <div class="pull-right">
            <input type="submit" class="btn btn-danger" name="order[receipt]" value="Review">
            <input type="reset" class="btn btn-default" id="reset" value="Reset">
        </div>
    </div>
    </form>
</div>
<!-- Review Details Ends -->


