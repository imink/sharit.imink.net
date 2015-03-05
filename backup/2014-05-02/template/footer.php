<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">

            <div class="row">

              <div class="col-md-4">
                <div class="widget">
                  <h5>Contact</h5>
                  <hr />
                    <div class="social">
                      <a href="#"><i class="icon-facebook facebook"></i></a>
                      <a href="#"><i class="icon-twitter twitter"></i></a>
                      <a href="#"><i class="icon-linkedin linkedin"></i></a>
                      <a href="#"><i class="icon-google-plus google-plus"></i></a> 
                    </div>
                  <hr />
                  <i class="icon-home"></i> &nbsp; Just Do IT, COMP215, University of Liverpool
                  <hr />
                  <i class="icon-phone"></i> &nbsp; +44 07404 019234
                  <hr />
                  <i class="icon-envelope-alt"></i> &nbsp; 
                  <?php
                    echo '<a href="mailto:'.SHARIT_MAIL_ADDRESS.'">'.SHARIT_MAIL_ADDRESS.'</a>';
                  ?>
                  <hr />
                  <div class="payment-icons">
                    <img src="<?php echo SHARIT_URL_APP ?>image/payment/americanexpress.gif" alt="" />
                    <img src="<?php echo SHARIT_URL_APP ?>image/payment/visa.gif" alt="" />
                    <img src="<?php echo SHARIT_URL_APP ?>image/payment/mastercard.gif" alt="" />
                    <img src="<?php echo SHARIT_URL_APP ?>image/payment/discover.gif" alt="" />
                    <img src="<?php echo SHARIT_URL_APP ?>image/payment/paypal.gif" alt="" />
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="widget">
                  <h5>About Us</h5>
                  <hr />
                   <p>
                     SharIT is an university-based, second hand, online trading platform. It aims to provide a better experience for students and staff to trade items. It also contains featured funcitons like request a item, bid a item, and many other fascinating functions waiting for you to discover.
                   </p><br>
                   <h5>Our Team  </h5>
                   <h5>Just Do IT</h5>
                   <div class="col-md-6">
                   <p><i class="icon-star-empty"></i>  Lulu Jiang </p>
                   <p><i class="icon-star-empty"></i>  Yue Wang</p>
                   <p><i class="icon-star-empty"></i>  Mengxue Huang<p>
                   </div>
                   <div class="col-md-6">
                    <p><i class="icon-star-empty"></i>  Xinrui Xu </p>
                   <p><i class="icon-star-empty"></i>  Yang Jiao</p>
                   </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="widget">
                  <h5>Links Goes Here</h5>
                  <hr />
                  <div class="two-col">
                    <div class="col-left">
                      <ul>
                        <li><a href="<?php echo SHARIT_URL_APP ?>product/items.php">Product List</a></li>
                        <li><a href="<?php echo SHARIT_URL_APP ?>request/index.php">Request</a></li>
                        <li><a href="<?php echo SHARIT_URL_APP ?>publish/index.php">Publish</a></li>
                        <li><a href="<?php echo SHARIT_URL_APP ?>user/index.php">My Account</a></li>
                      </ul>
                    </div>
                    <div class="col-right">
                      <ul>
                        <li><a href="<?php echo SHARIT_URL_APP ?>register.php">Sign Up</a></li>
                        <li><a href="<?php echo SHARIT_URL_APP ?>login.php">Login</a></li>
                        <li><a href="<?php echo SHARIT_URL_APP ?>about/index.php">About Us</a></li>
                        <li><a href="<?php echo SHARIT_URL_APP ?>about/contact.php">Contact Us</a></li>
                      </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              
            </div>

            <hr />
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2014 | <a href="<?php echo SHARIT_URL_APP ?>">SharIt</a> - <a href="<?php echo SHARIT_URL_APP ?>">Home</a> | <a href="<?php echo SHARIT_URL_APP ?>about/index.php">About Us</a> | <a href="<?php echo SHARIT_URL_APP ?>about/index.php">Service</a> | <a href="<?php echo SHARIT_URL_APP ?>about/contact.php">Contact Us</a></p>
      </div>
    </div>
  <div class="clearfix"></div>
  </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 

<!-- JS -->
<?php SharIt::page()->customScript('POS_END');?>
<?php SharIt::page()->customScriptFiles('POS_END');?>
<script src="<?php echo SHARIT_URL_APP ?>js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="<?php echo SHARIT_URL_APP ?>js/jquery.prettyPhoto.js"></script> <!-- Pretty Photo -->
<script src="<?php echo SHARIT_URL_APP ?>js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo SHARIT_URL_APP ?>js/nav.js"></script> <!-- Navigation page -->
<script src="<?php echo SHARIT_URL_APP ?>js/jquery.flexslider-min.js"></script> <!-- Flex slider -->
<script src="<?php echo SHARIT_URL_APP ?>js/jquery.carouFredSel-6.1.0-packed.js"></script> <!-- Carousel for recent posts -->
<script src="<?php echo SHARIT_URL_APP ?>js/custom.js"></script> <!-- Custom codes -->
<script src="<?php echo SHARIT_URL_APP ?>js/Chart.js"></script> <!-- Chart for price history  -->
<script src="<?php echo SHARIT_URL_APP ?>js/bootstrap-datetimepicker.min.js"></script> <!-- Chart for price history  -->
</body>
</html>