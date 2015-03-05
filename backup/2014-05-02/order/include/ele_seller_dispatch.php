<?php
//$productData
//$buyerData
//
//$orderData
?>
<!-- Confirm Order Starts -->
<?php include(dirname(__FILE__)."/ele_both.php") ?>
<?php include(dirname(__FILE__)."/ele_order_time.php") ?>
    
<br>

<!-- Buttons for buyer starts -->
<!-- before payment -->
<form action="<?php echo SharIt::app()->createUrl('order/changeStatus.php') ?>" method="post">
<input type="hidden" name="order[oid]" value="<?php echo $productData[id]?>" >
<div class="row">
    <div class="col-md-12 col-md-offset-12">
        <div class="pull-right">    
    <!-- Buttons for both before receipt starts -->
            <button class="btn btn-danger" type="submit" name="order[dispatch]" value="submit" >Dispatch</button>
        </div>
    </div>
</div>
</form>
<!-- Buttons for both before receipt ends -->