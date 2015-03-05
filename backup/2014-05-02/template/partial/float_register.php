<div id="register" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4>Register</h4>
      </div>
      <div class="modal-body">
        <div class="form">
          <form class="form-horizontal" action="<?php echo SharIt::app()->createUrl('register.php')?>" method="post" role="form">
            <div class="form-group">
              <label class="control-label col-md-3" for="displayname">
                  <span class="color">* </span>Display Name
              </label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[display_name]">
              </div>
            </div>   
            <div class="form-group">
              <label class="control-label col-md-3" for="email">
                <span class="color">* </span>UoL Username
              </label>
              <div class="col-md-9">
                <div class="input-group">
                  <input type="text" class="form-control" name="register[email]">
                  <span class="input-group-addon">@liv.ac.uk</span>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3" for="password">
                <span class="color">* </span>Password
              </label>
              <div class="col-md-9">
                <input type="password" class="form-control" name="register[password]">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <div class="checkbox inline">
                  <label>
                  <input type="checkbox" id="inlineCheckbox2" name="register[agree]" value="on"> Agree with Terms and Conditions
                  <span class="color"> *</span>
                  </label>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-danger">Register</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <p>Already have an account? <a href="<?php echo SharIt::app()->createUrl('login.php')?>">Login</a> here.</p>
      </div>
    </div>
  </div>
</div>