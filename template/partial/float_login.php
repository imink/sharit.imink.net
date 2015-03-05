<div id="login" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4>Login</h4>
      </div>
      <div class="modal-body">
        <div class="form">
          <form class="form-horizontal" action="<?php echo SharIt::app()->createUrl('login.php')?>" method="post" role="form">
            <div class="form-group">
              <label class="control-label col-md-3" for="email">UoL Username</label>
              <div class="col-md-9">
                <div class="input-group">
                  <input type="text" class="form-control" name="login[email]" value="<?php echo $loginForm[email]?>" placeholder="Enter UoL username">
                  <span class="input-group-addon">@liv.ac.uk</span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="password">Password</label>
              <div class="col-md-9">
                <input type="password" class="form-control" name="login[password]" value="<?php echo $loginForm[password]?>" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
               <div class="checkbox inline">
                  <label>
                    <input type="checkbox" name="login[remember]" <?php if($loginForm[remember]) echo 'checked'; ?> > Remember Password
                  </label>
               </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-danger">Login</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </div>

          </form>
        </div> 
      </div>
      <div class="modal-footer">
        <p>Forget Password? <a href="<?php echo SharIt::app()->createUrl('user/forgete.php')?>">Click here</a> to send an reset password email to your registered email account</p>
        <p>Dont have an account? <a href="<?php echo SharIt::app()->createUrl('register.php')?>">Register</a> here.</p>
      </div>
    </div>
  </div>
</div>
