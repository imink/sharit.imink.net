<?php

if ($paymentFormError){
  SharHTML::alert('danger',$paymentFormError);
}

?>
<div class="row">
    <div class="col-md-12">

        <!-- Publish page title -->
        <h4 class="title"><i class="icon-credit-card"></i> Payment</h4>
        <br>
        <h5 class="title">Total Price You Need to Pay: £<?php echo $orderInfo[price] ?></h5>
        <br>
        <!-- Payment Method -->
        <h5 class="title">Payment Method Details</h5>
       
        <!-- item details form -->
        <div class="form form-small">
            <!-- Register form (not working)-->
            <form class="form-horizontal"  method="post">
            <input type="hidden" name="payment[price]" value="<?php echo  $orderInfo[price]?>" >
            <input type="hidden" name="payment[oid]" value="<?php echo  $orderInfo[id]?>" >
                <!-- radio to select card type -->
                <div class="form-group">
                    <label class="control-label col-md-3">Card Type</label>
                    <div class="col-md-6">
                        <input type="radio" name="payment[method]" value="paypal" id="paypal">
                            <img src="http://sharit.imink.net/image/payment/paypal.gif" alt="">
                        <input type="radio" name="payment[method]" value="visa" id="visa">
                            <img src="http://sharit.imink.net/image/payment/visa.gif" alt="">
                        <input type="radio" name="payment[method]" value="master" id="master">
                            <img src="http://sharit.imink.net/image/payment/mastercard.gif" alt="">
                    </div>
                </div>

                <!-- Card Number -->
                <div class="form-group">
                  <label class="control-label col-md-3" for="number">Card Number</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="payment[cardnumber]" id="number">
                  </div>
                </div>

                <!-- Expire Date -->
                <div class="form-group">
                  <label class="control-label col-md-3" for="expireDate">Expire Date</label>
                  <div class="col-md-4" id="expireDate">                             
                      <select class="form-control" name="payment[month]" required>
                          <option disabled selected> --- Month --- </option>
                          <?php 
                            for($i=1;$i<=12;$i++){
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          ?>   
                      </select>
                      <br>
                      <select class="form-control" name="payment[year]" required>
                          <option disabled selected> --- Year --- </option>
                          <?php 
                            for($i=2014;$i<=2034;$i++){
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          ?>   
                      </select>
                  </div>
                </div>
                        
                <!-- Cardholder Name -->
                <div class="form-group">
                  <label class="control-label col-md-3" for="cardholder">Cardholder Name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="payment[cardholder]" id="cardholder">
                  </div>
                </div>
                <br>

                <!-- Invoice details section -->
                <div>
                    <!-- Title -->
                    <h5 class="title">Invoice Details</h5>

                   
                    <!-- Receiver Name -->
                    <div class="form-group">
                      <label class="control-label col-md-3" for="name">Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="payment[buyer_name]" id="name" value="<?php echo  $orderInfo[buyer_name]?>">
                      </div>
                    </div>

                    <!-- Receiver Address -->
                    <div class="form-group">
                      <label class="control-label col-md-3" for="address1">Address1</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="payment[address1]" id="address1" value="<?php echo  $orderInfo[address1]?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="address2">Address2</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="payment[address2]" id="address2" value="<?php echo  $orderInfo[address2]?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="postcode">Postcode</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="payment[postcode]" id="postcode" value="<?php echo  $orderInfo[postcode]?>">
                      </div>
                    </div>

                    <!-- Receiver Phone Number -->
                    <div class="form-group">
                      <label class="control-label col-md-3" for="phone">Phone Number</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="payment[phone]" id="phone" value="<?php echo  $orderInfo[phone]?>">
                      </div>
                    </div>
        
                </div>
            
                <hr>

                <!-- checkbox for terms and condition -->
                <div class="form-group">
                    <label class="ontrol-label col-md-3"></label>
                    <div class="col-md-6">
                        <input type="checkbox" name="payment[terms]" id="terms">
                        I have read and accept the terms of use
                    </div>
                </div>            
            
                <!-- Buttons -->
                <div class="row">
                  <div class="col-md-3 col-md-offset-6">
                    <div class="form-group">
                      <input type="submit" class="btn btn-danger" name="payment[submit]" value="Pay">
                      <input type="reset" class="btn btn-default" id="reset">
                      <a href=<?php echo SharIt::app()->createUrl('order/view_order.php',array('oid'=>$orderInfo[id]))?> class="btn btn-primary">Cancel</a>
                    </div>
                  </div>
                </div>

            </form>
        </div>
    </div>
</div>