<?php
//$productData
//$buyerData
//
//$orderData
?>
<!-- Confirm Order Starts -->
<?php include(dirname(__FILE__)."/ele_both.php");
  SharIt::page()->registerScriptFile('js/jquery.plugin.min.js',true,'POS_BEGIN');
  SharIt::page()->registerScriptFile('js/jquery.countdown.min.js',true,'POS_BEGIN');
  SharIt::page()->registerCssFile('css/jquery.countdown.css');
  $tmptime = strtotime($orderData[order_time]);

  $duedate = getdate(strtotime('+3 Day',$tmptime));
  SharIt::page()->registerScript("$(function(){var dueDate = new Date($duedate[year],$duedate[mon]-1,$duedate[mday],$duedate[hours],$duedate[minutes],$duedate[seconds]);$('#payCountdown').countdown({until: dueDate});});",'POS_BEGIN');

?>
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



    <div class="col-md-6 col-sm-6">
        <ul class="breadcrumb">
            <h5>Time Left to pay</h5>
            <p><div id="payCountdown"></div></p>
        </ul>
    </div>

    <br><hr><br>
</div>
    
<br>

<!-- Buttons for buyer starts -->
<!-- before payment -->
<div class="rows pull-right">

<form action="<?php echo SharIt::app()->createUrl('order/payment.php') ?>" method="post">
    <input type="hidden" name="order[oid]" value="<?php echo $productData[id]?>" >
    <button class="btn btn-danger" type="submit" name="order[pay]" value="submit" >Pay Now</button>
</form> 

<a href=<?php echo SharIt::app()->createUrl('user/purchase.php')?> class="btn btn-default">Pay Later</a>

    <!-- Buttons for buyer ends -->
    
    <!-- Buttons for both before receipt starts -->
<form action="<?php echo SharIt::app()->createUrl('order/changeStatus.php') ?>" method="post">
    <input type="hidden" name="order[oid]" value="<?php echo $productData[id]?>" >
    <button class="btn btn-danger" type="submit" name="order[cancelb]" value="submit" >Cancel Order</button>
</form>

</div>
<!-- Buttons for both before receipt ends -->