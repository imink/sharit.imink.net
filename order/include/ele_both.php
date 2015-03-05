<?php
//$productData
//$buyerData
//
?>

<!-- Order Details Starts -->
<div class="row">
    <div class="col-md-12 col-md-offset-12">
    <h4 class="title"><i class="icon-shopping-cart"></i> Order Details</h4>
    <br>
    <div class="row">
        <div class="col-md-6 col-sm-6 hidden-xs">
            <ul class="breadcrumb">
                <h5>Title</h5>
                <p><?php echo $productData[name]?></p>
            </ul>
            <ul class="breadcrumb">
                <h5>Price</h5>
                <p><?php echo $productData[price]?></p>
            </ul>
            <ul class="breadcrumb">
                <h5>Condition</h5>
                <p><?php echo $productData[product_condition]?></p>
            </ul>
            <ul class="breadcrumb">
                <h5>Category</h5>
                <p><?php echo $productData[category_name]?></p> 
            </ul>
            <ul class="breadcrumb">
                <h5>Published Date</h5> 
                <p><?php echo $productData[upload_time]?></p> 
            </ul>
        </div>


        <!-- Buyer and Seller Info Starts -->
        <div class="col-md-6 col-sm-6">
            <ul class="breadcrumb">
                <h5>Seller Info</h5>
                <a href=<?php echo SharIT::app()-> createUrl('order/profile.php',array('uid'=>$productData[seller_id])) ?>><?php echo $productData[seller_name]?></a>
                <p><a href="mailto:'<?php echo $productData[seller_email]?>'"><?php echo $productData[seller_email]?></a></p>
            </ul>
            <ul class="breadcrumb">
                <h5>Buyer Info</h5>
                <a href=<?php echo SharIT::app()-> createUrl('order/profile.php',array('uid'=>$productData[user_id])) ?>><?php echo $buyerData[display_name]?></a>
                <p><a href="mailto:'<?php echo $buyerData[email]?>'"><?php echo $buyerData[email]?></a></p>
            </ul>
        </div>
    <!-- Buyer and Seller Info Ends -->
    </div>
    </div>
</div>