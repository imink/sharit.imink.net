<?php
//$updateForm
//updateErrors

?>
<?php if ($editErrors){
    SharHTML::alert('danger',$editErrors);
  }
?>
<div id="update" class="col-md-12">
    <h4>Update</h4>
    <hr>

    <div class="">
        <div class="form">
        <p><b>NOTE: </b>Fields with <span class="color">*</span> can not be empty</p><br>
          <form class="form-horizontal" method="POST">
            <!-- Mandatory Fields Starts -->
            <div class="form-group">
              <label class="control-label col-md-3" for="displayname">
                  <span class="color">* </span>Display Name
              </label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[display_name]" value="<?php echo $user[display_name]?>"id="displayname">
                <p>The display name must not more than 20 characters.</p>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="email">
                <span class="color">* </span>UoL Username
              </label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[email]" value="<?php echo $user[email]?>" id="email">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="password">
                Password
                </label>
                <h5> If you wants to change your password,please 
                <span class="color"><a href="<?php echo SharIt::app()->createUrl('user/changePassword.php')?>">click</a></span> here.</h5>
            
            </div>
            <!-- Mandatory Fields Ends -->

            <!-- Optional Fields Starts -->
            <div class="form-group">
              <label class="control-label col-md-3">Gender</label>
              <div class="col-md-9">                               
                <select class="form-control">
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
                <input type="text" name="edit[first_name]" class="form-control" value="<?php echo $usermeta[first_name]?>" id="firstName">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="middleName">Middle Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[middle_name]" value="<?php echo $usermeta[middle_name]?>" id="middleName">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="lastName">Last Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[last_name]" value="<?php echo $usermeta[last_name]?>"id="lastName">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="phone">Phone Number</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[phone_no]" value="<?php echo $usermeta[phone_no]?>"id="phone">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="postcode">Postcode</label>
              <div class="col-md-9">
                <input type="text" class="form-control"name="edit[postcode]" value="<?php echo $usermeta[postcode]?>" id="postcode">
              </div>
            </div>
            
             <div class="form-group">
              <label class="control-label col-md-3" for="address1">Address Line 1</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[address_1]" value="<?php echo $usermeta[address_1]?>"id="address1">
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-md-3" for="address2">Address Line 2</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="edit[address_2]" value="<?php echo $usermeta[address_2]?>"id="address2">
              </div>
            </div>

            <!-- Optional Fields Ends -->

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <div class="checkbox inline">
                  <label>
                  <input type="checkbox" id="inlineCheckbox2" name="edit[agree]" value="on"> Agree with Terms and Conditions
                  <span class="color"> *</span>
                  </label>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-danger">Update</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>

</div>