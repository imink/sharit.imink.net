<?php

//$categoryList
//$publishFormErrors
//=======
$condition = array('10'=>'New In Box',
                    '9'=>'Unused',
                    '8'=>'Mint In Box',
                    '7'=>'Mint',
                    '6'=>'Like New',
                    '5'=>'Excellent',
                    '4'=>'Good',
                    '3'=>'Fair',
                    '2'=>'Bargain Grade',
                    '1'=>'Poor');

if ($publishFormErrors){
  $publishFormErrors;
  SharHTML::alert('danger',$publishFormErrors);
}

?>

<div class="row">

    <!-- Publish page title -->
    <h4 class="title"><i class="icon-edit"></i> Edit an Item</h4>
    <!-- Sub title -->
    <h5 class="title">Item Details</h5>
    
    <!-- item details form -->
    <div class="form form-small">
      <p><b>NOTE: </b>All fields are mandatory fields</p>
        <!-- Register form -->
        <form class="form-horizontal" action="<?php echo SharIt::app()->createUrl('user/edit_product.php') ?>"method="post">
        <input type="hidden" name="product[pid]" value="<?php echo $formData[pid]?>" >
        <input type="hidden" name="product[on_bid]" value="<?php echo $formData[on_bid]?>" >
            <!-- Name -->
            <div class="form-group"> 
              <label class="control-label col-md-3" for="name">Item Name</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="product[name]" value= "<?php echo $formData[name]?>">
                <span class="help-block">Item name should be between 10 to 50 characters</span>
              </div>
            </div>

            <!-- Category -->
            <div class="form-group">
              <label class="control-label col-md-3" for="category">Category</label>
              <div class="col-md-4"> 
              <!-- Use two loops to print these options -->                              
                  <select class="form-control" name="product[category_id]" required>
                      <option disabled selected> ----- Please Select ----- </option>
                      <?php
                        foreach($categoryList as $key => $value){
                            $parent = $value;
                            echo '<option disabled>- '.$parent[name].' -</option>';
                            foreach($parent as $key => $value){
                                $child = $value;
                                foreach($child as $key => $value){
                                    $categorySelected="";  
                                    if($key == $formData[category_id])
                                        $categorySelected = "selected";
                                    echo "<option value=\"$key\" $categorySelected>$value</option>";
                                }
                            }
                        }
                      ?>   
                  </select>
              </div>
            </div>

            <!-- Condition -->
            <div class="form-group">
              <label class="control-label col-md-3" for="condition">Condition</label>
              <div class="col-md-4">                               
                  <select class="form-control" name="product[product_condition]" required>
                      <option disabled selected> --- Please Select --- </option>
                      <?php
                        foreach ($condition as $key => $value) {
                          $conditionSelected="";
                          if($key == $formData[product_condition])
                            $conditionSelected = "selected";
                          echo "<option value=\"$key\" $conditionSelected>$key - $value</option>";
                        }
                      ?>
                  </select>  
              </div>
            </div>

            <!-- Description -->
            <div class="form-group">
              <label class="control-label col-md-3" for="description">Description</label>
              <div class="col-md-6">
                <textarea class="form-control" name="product[description]" rows="12"><?php echo $formData[description];?></textarea>
                <span class="help-block">Description should be no more than 2,000 words in total</span>
              </div>
            </div>  
            
             <div class="form-group">
                <label class="control-label col-md-3" for="picture">Pictures</label>
                
                <h5>If you want to manage your pictures, Please <span class="color"><a href="<?php echo SharIt::app()->createUrl('user/edit_picture.php', array('pid' => $formData[id]))?>">click</a></span> here.</h5>
              </div>
            <!-- Picture -->
            
            <!-- radios to select whether this item allows bid -->
          
            <!-- Price -->
            <?php if($formData[on_bid]==0) { ?>
            <div id="normalSection" class="form-group">
                <label class="control-label col-md-3" for="product[price]">Price</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">£</span>
                         <input type="text" class="form-control" name="product[price]" value="<?php echo $formData[price]?>">

                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Bid details section starts -->
            

                <!-- Bid expiration date -->


                 <!-- Bid expiration date -->
              

            <!--Bid details section ends -->

        
            <hr>
            <!-- checkbox for terms and condition and buttons-->
            <div class="form-group">
                <label class="control-label col-md-4"></label>
                <div class="col-md-6">
                    <input type="checkbox" name="product[agree]" value='on'>I have read and accept the terms of use
                    <input type="submit" class="btn btn-danger" id="submit" value="Publish">
                    <input type="reset" class="btn btn-default" id="reset">
                </div>
            </div>
        

        </form>
    </div>
</div>
<script  src="<?php echo SHARIT_URL_APP?>t/patrick/jquery/jquery-1.8.3.min.js" ></script>
<script  src="<?php echo SHARIT_URL_APP?>t/js/bootstrap-datetimepicker.js" ></script> <!-- Date picker -->
<script  src="<?php echo SHARIT_URL_APP?>t/patrick/bootstrap/js/bootstrap.min.js" ></script>

<script>
    // datetimepicker
    $('.form_date').datetimepicker({
        // language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
        });

    // bid hide and show
    $(document).ready(function(){
      $("#bidNo").click(function(){
      $("#bidSection").slideUp();
      $("#normalSection").slideDown();
      });
      $("#bidYes").click(function(){
      $("#bidSection").slideDown();
      $("#normalSection").slideUp();
      });
    });
</script>