<div class="content error-page">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-5">  
        <!-- Big CODE text -->
        <div class="big-text"><?php echo $code?></div>
        <hr>
        <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">Report this error to our staff</a>
      </div>
      <div class="col-md-5 col-sm-5 col-sm-offset-1 col-md-offset-1">
        <h2>Oops<span class="color">!!!</span></h2>
        <h4><?php echo $message?></h4>
        <hr>
        <!-- Some site links -->
        <div class="horizontal-links">
          <h5>Take a look around our site</h5>
          <a href="<?php echo SharIt::app()->createUrl('index.php')?>">Home</a>
          <a href="<?php echo SharIt::app()->createUrl('about/about.php')?>">About Us</a>
          <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">Contact Us</a>
          <a href="<?php echo SharIt::app()->createUrl('about/policy.php')?>">Policy</a>
        </div>
        <hr>
        <!-- Search form -->
        <div class="form">
         <form class="form-inline" role="form">
			<div class="form-group">
				<input type="email" class="form-control" id="search" placeholder="Search">
			</div>
			  
			<button type="submit" class="btn btn-default">Search</button>
		 </form>
        </div>
      </div>

    </div>
  </div>
</div>