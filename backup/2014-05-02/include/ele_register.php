<?php
//$registerForm
//registerErrors
//echo "ABC";
// print_r($registerForm);
// print_r($registerErrors);
?>
<?php if ($registerErrors){
    SharHTML::alert('danger',$registerErrors);
  }
?>
<div id="register" class="col-md-12">
    <h4>Register</h4>
    <hr>

    <div class="col-md-10">
        <div class="form">
        <p><b>NOTE: </b>Fields with <span class="color">*</span> can not be empty</p><br>
          <form class="form-horizontal" method="POST">
            <!-- Mandatory Fields Starts -->
            <div class="form-group">
              <label class="control-label col-md-3" for="displayname">
                  <span class="color">* </span>Display Name
              </label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[display_name]" value="<?php echo $registerForm['display_name'] ?>" >
                <p>The display name must not more than 20 characters.</p>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="email">
                <span class="color">* </span>UoL Username
              </label>
              <div class="col-md-9">
                <div class="input-group">
                  <input type="text" class="form-control" name="register[email]" value="<?php echo $registerForm['email'] ?>">
                  <span class="input-group-addon">@liv.ac.uk</span>
                </div>
                <p>Please enter your university username</p>             
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="password">
                <span class="color">* </span>Password
              </label>
              <div class="col-md-9">
                <input type="password" class="form-control" name="register[password]" value="<?php echo $registerForm['password'] ?>">
                <p>The password must not less than 8 characters and must not include any punctuation mark.</p>
              </div>
            </div>
            <!-- Mandatory Fields Ends -->

            <!-- Optional Fields Starts -->
            <div class="form-group">
              <label class="control-label col-md-3">Gender</label>
              <div class="col-md-3">                               
                <select class="form-control" name="register[gender]">
                  <option>&nbsp;</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="firstName">First Name</label>
              <div class="col-md-9">
                <input type="text" name="register[first_name]" class="form-control" value="<?php echo $registerForm['first_name'] ?>" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="middleName">Middle Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[middle_name]" value="<?php echo $registerForm['middle_name'] ?>" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="lastName">Last Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[last_name]" value="<?php echo $registerForm['last_name'] ?>" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="phone">Phone Number</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[phone_no]" value="<?php echo $registerForm['phone_no'] ?>" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="postcode">Postcode</label>
              <div class="col-md-9">
                <input type="text" class="form-control"name="register[postcode]" value="<?php echo $registerForm['postcode'] ?>" >
              </div>
            </div>
            
             <div class="form-group">
              <label class="control-label col-md-3" for="address1">Address Line 1</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[address_1]" value="<?php echo $registerForm['address_1'] ?>" >
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-md-3" for="address2">Address Line 2</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="register[address_2]" value="<?php echo $registerForm['address_2'] ?>" >
              </div>
            </div>

            <!-- Optional Fields Ends -->

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
            <div class="panel-footer+">
                <p>Already have an account? <a href="<?php echo SharIt::app()->createUrl('login.php')?>">Login</a> here.</p>
            </div>
      </div>

</div>