<?php 
// $categoryList
// $requestForm

if ($requestFormErrors){
  SharHTML::alert('danger',$requestFormErrors);
}
?>

<!-- Title -->
<h5 class="title">Post a Request</h5>

<div class="form form-small">
    <!-- post request form start-->
    <form class="form-horizontal" method="post">
                           
         <!-- Category start -->
         <div class="form-group">
           <label class="control-label col-md-3">Category</label>
           <div class="col-md-6">                               
               <select class="form-control" name="requestForm[category]">
               <option disabled selected> ----- Please Select ----- </option>
                  <?php
                    foreach($categoryList as $key => $value){
                        $parent = $value;
                        echo '<option disabled>- '.$parent[name].' -</option>';
                        foreach($parent as $key => $value){
                            $child = $value;
                            foreach($child as $key => $value){
                                $categorySelected="";  
                                if($key == $requestForm[category])
                                    $categorySelected = "selected";
                                echo "<option value=\"$key\" $categorySelected>$value</option>";
                            }
                        }
                    }
                  ?>   
               </select>  
           </div>
         </div>
         <!-- Category end -->

         <!-- Title start -->
         <div class="form-group">
           <label class="control-label col-md-3" for="topic">Topic</label>
           <div class="col-md-6">
             <input type="text" class="form-control" id="topic" name="requestForm[topic]" value="<?php echo $requestForm[topic];?>">
           </div>
         </div>
         <!-- Title end -->

         <!-- Description start -->
         <div class="form-group">
           <label class="control-label col-md-3" for="description">Description</label>
           <div class="col-md-6">
             <textarea class="form-control" id="description" rows="3" name="requestForm[message]" value="<?php echo $requestForm[message];?>"></textarea>
           </div>
         </div>
         <!-- Description end -->

         <!-- Checkbox start -->
         <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
               <label class="checkbox inline">
                  <input type="checkbox" id="inlineCheckbox" name="requestForm[agree]" value="on"> Agree with Terms and Conditions
               </label>
            </div>
         </div>
         <!-- Checkbox end -->
         
         <!-- Buttons start -->
         <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <!-- Buttons -->
              <button type="submit" class="btn btn-danger">Submit</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
         <!-- Buttons end -->
    </form>
    <!-- post request form end -->
</div>