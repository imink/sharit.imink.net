<?php
//$adForm
//$adFormErrors
?>

<?php if ($adFormErrors){
    SharHTML::alert('danger',$adFormErrors);
  }
?>


<div class="form form-small">
<h5 class="title">Publish an advertisement</h5>
    <!-- post request form start-->
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
   <!-- id-->
   <div class="form-group">
   <label class="control-label col-md-3" for="Id">Product ID</label>
   <div class="col-md-6">
     <input type="text" class="form-control" id="id" name="adForm[product_id]" value="<?php echo $adForm[product_id];?>">
   </div>
  </div>
   <!--id end--> 
  
  <!-- title start -->
  <div class="form-group">
   <label class="control-label col-md-3" for="title">Title</label>
   <div class="col-md-6">
     <input type="text" class="form-control" id="title" name="adForm[title]" value="<?php echo $adForm[title];?>">
   </div>
  </div>
  <!-- title end -->
  
  <!-- description start -->
  <div class="form-group">
   <label class="control-label col-md-3" for="description">Description</label>
   <div class="col-md-6">
     <textarea class="form-control" id="description" rows="3" name="adForm[description]" value="<?php echo $adForm[description];?>"></textarea>
   </div>
  </div>
  <!-- description end -->

  <!-- insert picture start -->
  <!-- Picture -->
  <div class="form-group">
      <label class="control-label col-md-3" for="picture">Upload A Picture</label>
      <div class="col-md-6">
          <input type="file" class="form-control" name="adpic" >                         
      </div>
  </div>
  <!-- insert picture end -->
       <!-- Buttons start -->
       <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <!-- Buttons -->
            <button type="submit" class="btn btn-danger">Publish</button>
          </div>
      </div>
    </form>
    <hr>
    <h5 class="title">Delete an advertisement</h5>
    <form class="form-horizontal" method="POST">
      <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-danger" name="delete[click]">Delete Last Week's Advertisement Pictures</button>
          </div>
      </div>
     </form>

    <!-- post request form end -->
</div>
