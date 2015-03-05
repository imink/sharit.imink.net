<?php
//$formData
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
  SharHTML::alert('danger',$publishFormErrors);
}


?>

<!-- Date Picker -->
<link href="<?php echo SHARIT_URL_APP ?>t/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo SHARIT_URL_APP ?>t/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

<div class="row">

    <!-- Publish page title -->
    <h4 class="title"><i class="icon-edit"></i> Publish an Item</h4>
    <!-- Sub title -->
    <h5 class="title">Item Details</h5>
    
    <!-- item details form -->
    <div class="form form-small">
      <p><b>NOTE: </b>All fields are mandatory fields</p>
        <!-- Register form -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
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
                  <select class="form-control" name="product[category]" required>
                      <option disabled selected> ----- Please Select ----- </option>
                      <?php
                        foreach($categoryList as $key => $value){
                            $parent = $value;
                            echo '<option disabled>- '.$parent[name].' -</option>';
                            foreach($parent as $key => $value){
                                $child = $value;
                                foreach($child as $key => $value){
                                    $categorySelected="";  
                                    if($key == $formData[category])
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
                  <select class="form-control" name="product[condition]" required>
                      <option disabled selected> --- Please Select --- </option>
                      <?php
                        foreach ($condition as $key => $value) {
                          $conditionSelected="";
                          if($key == $formData[condition])
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

            <!-- Picture -->
            <div class="form-group">
                <label class="control-label col-md-3" for="picture">Upload Pictures</label>
                <div class="col-md-6">
                  <ul class="nav nav-tabs">
                      <!-- Navigation tabs (Job titles ). Use unique value in anchor tags. -->
                      <?php
                          if(!$formData[default_picture_id])
                            $selectedPID = 0;
                          else
                            $selectedPID = $formData[default_picture_id];
                          for ($i=0; $i <10 ; $i++):?>
                            <li<?php echo ($i==$selectedPID)?' class="active"':''?>>
                              <a href="#picture<?php echo $i ?>" data-toggle="tab"><?php echo $i+1 ?></a>
                            </li>
                      <?php endfor ?>
                  </ul>
                  <div class="tab-content">
                        <?php for ($i=0; $i <10 ; $i++):?>
                          <div class="tab-pane<?php echo ($i==$selectedPID)?' active':''?>" id="picture<?php echo $i ?>">
                            <input type="file" class="form-control" name="picture<?php echo $i ?>" >                        
                          </div>
                         <?php endfor?>
                  </div>
                  <span class="help-block">The first picture will be set as the main picture for your product</span>
                </div>
            </div> 

            <!-- radios to select whether this item allows bid -->
            <div class="form-group">
                <label class="control-label col-md-3">Put this item on bid?</label>
                <div class="col-md-6">
                    <?php
                      for ($i=0; $i < 2; $i++) { 
                        echo "<input type=\"radio\" name=\"product[on_bid]\" value=\"$i\" ";
                        if($formData[on_bid]==$i)
                          echo "checked ";
                        if($i==0)
                          echo "id=\"bidNo\" > No ";
                        if($i==1)
                          echo "id=\"bidYes\" > Yes ";
                      }
                    ?>
                </div>
            </div>

            <!-- Price -->
            <div id="normalSection" class="form-group">
                <label class="control-label col-md-3" for="product[price]">Price</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">£</span>
                         <input type="text" class="form-control" name="product[sell_price]" value="<?php echo $formData[sell_price]?>">
                    </div>
                </div>
            </div>

            <!-- Bid details section starts -->
            <div id="bidSection" style="display:none">
                <!-- Title -->
                <h5 class="title">Bid Details</h5>
    
                <!-- Starting price -->
                <div class="form-group">
                    <label class="control-label col-md-3" for="price">Starting Price</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">£</span>
                            <input type="text" class="form-control" name="product[bid_price]" value="<?php echo $formData[bid_price]?>">
                        </div>
                    </div>
                </div>

                <!-- Bid expiration date -->
                <div class="form-group">
                    <label class="control-label col-md-3" for="product[due_date]">Expiration Date</label>
                    <div class="col-md-6">
                      <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" name="product[due_date]"  value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                      </div>
                        <br><p>Bids for this item will expire at 23:00 on the date you chose</p>
                      </div>
                </div>
            </div>
            <!--Bid details section ends -->
        
            <hr>
            <!-- checkbox for terms and condition and buttons-->
            <div class="form-group">
                <label class="control-label col-md-4"></label>
                <div class="col-md-6">
                    <input type="checkbox" name="product[agree]" value="on">I have read and accept the terms of use
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



  