<?php 
// $categoryList
// $categoryForm
 
if ($categoryFormErrors){
  SharHTML::alert('danger',$categoryFormErrors);
}
?>

<!-- Title -->
<h5 class="title">Insert a single category</h5>
<div class="form form-small">
    <!-- post request form start-->
    <form class="form-horizontal" method="post">
  <!-- Category start -->
 
  <!-- Category end -->
  <!-- category group start-->
  <div class="form-group">
   <label class="control-label col-md-3" for="single">Parent Category</label>
   <div class="col-md-6">
     <input type="text" class="form-control" id="parent" name="categoryForm[parent1]" value="<?php echo $categoryForm[parent1];?>">
     <span class="help-block"> Fill with a parent category </span>
   </div>
  </div>
  <!--category group end-->
  <!-- Single category start -->
  <div class="form-group">
   <label class="control-label col-md-3" for="single">Sub Category</label>
   <div class="col-md-6">
     <input type="text" class="form-control" id="single" name="categoryForm[single]" value="<?php echo $categoryForm[single];?>">
     <span class="help-block"> Fill with a single category </span>
   </div>
  </div>
  <!-- Single category end -->

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