<?php if ($forgetErrors){
    SharHTML::alert('danger',$forgetErrors);
  }
?>

<div class="widget">
  <h3>Password Management</h3>
  
  <h4>Tell Us Your Account, change your password just in few seconds</h4>
  <form class="form-inline" method="post" role="form" >
    <div class="col-md-12 col-md-offset-4">
      <div class="control-group">
        <label class="control-label" for="inputIcon">UoL Username</label>
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
            <input class="input-xlarge" id="inputIcon" type="text" name="forget[email]" value="<?php  echo $forgetForm[email] ?>">
            <span class="add-on">@liv.ac.uk</span>
            <button type="submit" class="btn btn-danger" name="forget[submit]" value="submit">Search</button>
          </div>
        </div>
      </div>   
    </div>
  </form>
</div>