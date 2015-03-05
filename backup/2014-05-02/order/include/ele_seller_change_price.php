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

<div class="row">
    <!-- Change Price starts -->
    <!-- Seller only before payment -->
    <div class="col-md-4 col-sm-4">
    <h5>Change Price</h5>
        <form class="form-inline" role="form" method="post">
            <div class="form-group">   
                <div class="input-group">
                    <span class="input-group-addon">£</span>
                    <input type="text" class="form-control" name="order[price]" value="<?php echo $priceForm[price]?>">
                </div>  
            </div>
            <input type="submit" class="btn btn-danger" name="order[change]" value="Change">
        </form>
    </div>
    <!-- Change Price ends -->
</div>
<br>

<!-- Buttons for buyer starts -->
<!-- before payment -->
<form action="<?php echo SharIt::app()->createUrl('order/changeStatus.php') ?>" method="post">
<input type="hidden" name="order[oid]" value="<?php echo $productData[id]?>" >
<div class="row">
    <div class="col-md-12 col-md-offset-12">
        <div class="pull-right">    
    <!-- Buttons for both before receipt starts -->
            <button class="btn btn-danger" type="submit" name="order[cancels]" value="submit" >Cancel Order</button>
        </div>
    </div>
</div>
</form>
<!-- Buttons for both before receipt ends -->
