<?php if ($changeErrors){
    SharHTML::alert('danger',$changeErrors);
    //SharHTML::alert('danger',"Two inputs are not equal to each other.");
  }

?>

<div class="widget">
    <h3>Password Management</h3>
    <h4>Enter yout new password</h4>
    <div class="col-md-8 col-md-offset-4">
    <form class="form-inline" method="post" role="form" >
        <div class="control-group">
  <label class="control-label" for="inputIcon">New password</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class=" icon-ok-sign"></i></span>
      <input class="input-xlarge" type="password" id="inputIcon"  name="change[password1]" value="<?php echo $change[password1]?>">
       
    </div>
  </div>
</div>
 <div class="control-group">
  <label class="control-label" for="inputIcon">Confirm password</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class=" icon-ok-sign"></i></span>
      <input class="input-xlarge" type="password" id="inputIcon"  name="change[password2]" value="<?php echo $change[password2]?>">
       
    </div>
  </div>
</div>
    </div>
    <br>
   <br>
    <br>
     <input class="input-xlarge" type="hidden" id="inputIcon"  name="change[uid]" value="<?php echo $change[uid]?>">
     <input class="input-xlarge" type="hidden" id="inputIcon"  name="change[code]" value="<?php echo $change[code]?>">
       
  <div class="col-md-2 col-md-offset-4">
   <button type="submit" class="btn btn-block btn-danger" name="change[submit]" value="submit">Change</button>
  </div>
  </form>    
</div>