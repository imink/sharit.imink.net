        <?php 
        //$order['id']  value
        ?>
        <div class="row">
        <!-- Title -->
        <div class="row">
        <div class="col-md-6 col-sm-6 hidden-xs">
        <h4 class="title">Confirmation</h4>

        <h5>Thanks for buying with SharIT !</h5>
        <p>Your Order <a href=<?php echo SharIT::app()->createUrl('order/view_order.php',array(oid=>$order['id'])) ?>> #id is <strong><?php echo $order['id']?></strong></a>. Say this id while communicating further.</p>
        <h5>Please remember to contact seller for shipping details!</h5>
        </div>

        <!-- Some links -->
        <div class="col-md-6 col-sm-6">
        <div class="horizontal-links">
          <h5>Take a look around our site</h5>
          <a href=<?php echo SharIT::app()->createUrl('index.php') ?>>Home</a> 
          <a href=<?php echo SharIT::app()->createUrl('about/about.php')?>>About Us</a>
          <a href=<?php echo SharIT::app()->createUrl('about/contact.php')?>>Contact Us</a> 
          <a href=<?php echo SharIT::app()->createUrl('about/policy.php')?>>Policy</a>
        </div>
        
        <!-- Search form -->
        <div class="form">
          <form class="form-inline" role="form">
        <div class="form-group">
        <input type="email" class="form-control" id="search" placeholder="">
        </div>
        
        <button type="submit" class="btn btn-default">Search</button>
      </form>
        </div>
        <hr>
        
            <!-- Social media icons -->
            <div class="social pull-left">
               <h5>Sharing is Sexy! Spread your experience:</h5>
               <a href="#"><i class="icon-facebook facebook"></i></a>
               <a href="#"><i class="icon-twitter twitter"></i></a>
               <a href="#"><i class="icon-linkedin linkedin"></i></a>
               <a href="#"><i class="icon-pinterest pinterest"></i></a>
               <a href="#"><i class="icon-google-plus google-plus"></i></a>
            </div>
                              
        </div>
        </div>
        </div>
                                                                        



    
  