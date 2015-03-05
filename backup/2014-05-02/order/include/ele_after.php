<?php
//$productData
//$buyerData
//
//$orderData
?>
<!-- Confirm Order Starts -->
<?php include(dirname(__FILE__)."/ele_both.php") ?>
<hr>
<div class="row">
    <div class="col-md-6 col-sm-6 hidden-xs">
    	<ul class="breadcrumb">
                <h5>Order ID </h5>
                <p><?php echo $productData[id]?></p> 
        </ul>
        <ul class="breadcrumb"> 
                <h5>Order Time</h5> 
                <p><?php echo $orderData[order_time]?></p>
        </ul>
        
    </div>
    <br><hr><br>
</div>