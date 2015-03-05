<?php
//$productData
//$buyerData
?>
<!-- Confirm Order Starts -->
<?php include(dirname(__FILE__)."/ele_both.php") ?>
<form action="<?php echo SharIt::app()->createUrl('order/changeStatus.php') ?>" method="post">
<input type="hidden" name="order[pid]" value="<?php echo $productData[id]?>" >
<div class="row">
    <div class="col-md-12 col-md-offset-12">
    <hr>
        <div class="pull-right">
    		<button class="btn btn-danger" type="submit" name="order[confirm]" value="submit" >Confirm Order</button>
            <a href=<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$productData[id]))?> class="btn btn-primary">Cancel Order</a>
        </div>
    </div>     
</div>
</form>
<!-- Confirm Order Ends -->