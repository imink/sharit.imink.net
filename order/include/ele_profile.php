<h5>User Info</h5>
  <div class="item-review">
    <h5>Name: <?php echo "$user[display_name]";?></h5>
    <br>
    <h5>Rating</h5>
    <p>Item as Described: <?php echo "$user[review_describe]";?>/5</p>
    <p>Communication: <?php echo "$user[review_com]";?>/5</p>
    <p>Shipping Speed: <?php echo "$user[review_ship]";?>/5</p>
    <p>Attitude: <?php echo "$user[review_attitude]";?>/5</p>
    <p>Confirmation Speed: <?php echo "$user[review_speed]";?>/5</p>
    <br>
    <h5>Email</h5>
    <p><a href="mailto:someone@example.com?Subject=Query%20on%20__product_name__"><?php echo "$user[email]";?></a></p>
    <br>
    <h5>Register Date</h5>
    <p class="rmeta"><?php echo "$user[register_date]";?></p>
  </div>