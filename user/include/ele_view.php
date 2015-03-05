<?php 


?>

<!-- Main content -->
      <div class="col-md-9 col-sm-9">

          <h5 class="title">My Account</h5>
            <div class="item-review">
              <h5>Display Name: </h5>
              <p><?php echo "$user[display_name]";?></p>
              <br>
              <?php if($usermeta[gender]){ ?>
              <h5>Gender: </h5>
              <p><?php echo "$usermeta[gender]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[first_name]){ ?>
              <h5>First Name: </h5>
              <p><?php echo "$usermeta[first_name]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[middle_name]){ ?>
              <h5>Middle Name: </h5>
              <p><?php echo "$usermeta[middle_name]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[last_name]){ ?>
              <h5>Last Name: </h5>
              <p><?php echo "$usermeta[last_name]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[phone_no]){ ?>
              <h5>Phone Number: </h5>
              <p><?php echo "$usermeta[phone_no]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[postcode]){ ?>
              <h5>Post Code: </h5>
              <p><?php echo "$usermeta[postcode]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[address_1]){ ?>
              <h5>Address Line1: </h5>
              <p><?php echo "$usermeta[address_1]";?></p>
              
              <br><?php }?>
              <?php if($usermeta[address_2]){ ?>
              <h5>Address Line2: </h5>
              <p><?php echo "$usermeta[address_2]";?></p>
              
              <br><?php }?>
              <h5>Total Rating:</h5>
              <p>Item as described: <?php echo "$user[review_describe]";?>/5</p>
              <p>Communication: <?php echo "$user[review_com]";?>/5</p>
              <p>Shipping Speed: <?php echo "$user[review_speed]";?>/5</p>
              <br>
              <h5>Email</h5>
              <p><a href="mailto:someone@example.com?Subject=Query%20on%20__product_name__"><?php echo "$user[email]";?></a></p>
              <br>
              <h5>Register Date</h5>
              <p class="rmeta"><?php echo "$user[register_date]";?></p>
            </div>