 <div>
  <!-- my published records -->
<!-- title -->
<?php
// $publish
?>
<h3 class="title">Pictures</h3>
   <?php if($check[main]=='true'){ 
    ?>
    <h4>Main Picture</h4>
   <table class="table table-striped tcart table-hover">
      <!-- header of table -->
      <thead>
        <tr>
          <th>Picture</th>
          <th>Edit</th>
        </tr>
      </thead>
      <!-- body of table -->

      <tbody>
        <!-- on sell -->
        <tr>
          
            <td>
              <img class="img-responsive"  src="<?php echo SharHTML::imgUrl("$mainPic[picture_name]");?>" alt="" class="img-responsive">
            </td>
            <td>
            <form action="<?php echo SharIt::app()->createUrl('user/edit_picture.php' ) ?>" method="get">
            <input type="hidden" name="pid" value="<?php echo $mainPic[product_id]?>" >
            <input type="hidden" name="pic_id" value="<?php echo $mainPic[id]?>" >
              <button class="btn btn-danger btn-sm" type="submit" name="delete" value="submit" >Delete</button></form>
            </td>
          
        </tr>                                                                              
       </tbody>
    </table>
  <?php }elseif($check[main]=='false'){ ?>
  <h4>You have not uploaded any main picture. This may cause some PROBLEMS in your selling!</h4>
  <form class="form-horizontal" method="post" enctype="multipart/form-data">
  <input type="hidden" name="pid" value="<?php echo $mainPic[product_id]?>" >
  <div class="form-group">
      <label class="control-label col-md-3" for="picture">Upload A Main Picture</label>
      <div class="col-md-6">
          <input type="file" class="form-control" name="picM" >                         
      </div>
  </div>
  <!-- insert picture end -->
       <!-- Buttons start -->
       <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <!-- Buttons -->
            <button type="submit" class="btn btn-danger" name='submitM' value="submit">Publish</button>

          </div>
      </div>
    </form>
           <br>
 
  <?php } ?> 
  

<br>
<br>


  <?php if($check[normal]=='true'){ ?>
     <h4>Normal Picture</h4>
   <table class="table table-striped tcart table-hover">
      <!-- header of table -->
      <thead>
        <tr>
          <th>Picture</th>
          <th>Edit</th>
        </tr>
      </thead>
      <?php foreach($normalPic as $key=>$value){ ?>
        <tr>
          
            <td>
              <img class="img-responsive"  src="<?php echo SharHTML::imgUrl("$value[picture_name]");?>" alt="" class="img-responsive">
            </td>
            <td>
            <form action="<?php echo SharIt::app()->createUrl('user/edit_picture.php' ) ?>" method="get">
            <input type="hidden" name="pid" value="<?php echo $value[product_id]?>" >
            <input type="hidden" name="pic_id" value="<?php echo $value[id]?>" >
              <button class="btn btn-danger btn-sm" type="submit" name="delete" value="submit" >Delete</button></form>
            </td>
          
        </tr> 
        <?php } ?>                                                                             
       </tbody>
    </table>
 <?php }elseif($check[normal]=='false'){ ?>
 <h3>You have not uploaded any normal picture.</h3>
 <?php } ?> 

<?php if($check[num]<9){ ?>
<h5>You can upload more picture here.</h5><br>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
<input type="hidden" name="pid" value="<?php echo $value[product_id]?>" >
  <div class="form-group">
      <label class="control-label col-md-3" for="picture">Upload A Normal Picture</label>
      <div class="col-md-6">
          <input type="file" class="form-control" name="picN" >                         
      </div>
  </div>
  <!-- insert picture end -->
       <!-- Buttons start -->
       <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <!-- Buttons -->
            <button type="submit" class="btn btn-danger" name='submitN' value="submit">Publish</button>

          </div>
      </div>
    </form>
           <br>
    <?php } ?>  

</div>