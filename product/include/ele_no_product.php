<br>
<h2 class="title"><span class="color">Sorry! </span> There is no related product.</h2>

<?php if($checkuser=='false'){ ?>
<p>Why not register an account and post a request here?</p>
<p>You can also publish your own product here!</p>
<br>
<h4><a href="<?php echo SharIt::app()->createUrl('register.php')?>">Register</a> Now!</h4>
<h5>Already have an account? <a href="<?php echo SharIt::app()->createUrl('login.php')?>">Login</a> here.</h5>
<?php }else { ?>

<!-- if user has login start -->
<h5>You can <a href="<?php echo SharIt::app()->createUrl('request/post.php')?>">POST</a> a request; or <a href="<?php echo SharIt::app()->createUrl('publish/index.php')?>">PUBLISH</a> an item here.</h5>
<br>
<?php } ?>


<p>You can also <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">contact</a> our staff for more information.</p>
<hr>
 <!-- Some site links -->
<div class="horizontal-links">
  <h5>Take a look around our site</h5>
  <a href="<?php echo SharIt::app()->createUrl('index.php')?>">Home</a>
  <a href="<?php echo SharIt::app()->createUrl('about/about.php')?>">About Us</a>
  <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">Contact Us</a>
  <a href="<?php echo SharIt::app()->createUrl('about/policy.php')?>">Policy</a>
</div>