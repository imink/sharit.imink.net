<div class="navbar bs-docs-nav" role="banner">
 
 <div class="container">
   <div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    
  </div>
  <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
   <ul class="nav navbar-nav">
     <li><a href="index.html"><i class="icon-home"></i></a></li>    
     <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="<?php echo SharIt::app()->createUrl('product/index.php')?>">Items</a></li>
        <li><a href="<?php echo SharIt::app()->createUrl('publish/index.php')?>">Publish</a></li>
        <li><a href="<?php echo SharIt::app()->createUrl('product/index.php')?>">Request</a></li>
        <li><a href="<?php echo SharIt::app()->createUrl('product/index.php')?>">My Account</a></li>
        <li><a href="<?php echo SharIt::app()->createUrl('product/index.php')?>">About Us</a></li>
      </ul>
    </li>                   
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Items <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="general.html">General</a></li>
        <li><a href="login.html">Login</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="blog-single.html">Blog Single</a></li>
        <li><a href="404.html">404</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Publish <b class="caret"></b></a>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Request <b class="caret"></b></a>
    </li>                                      
    <li><a href="support.html">Support</a></li>
    <li><a href="contact.html">Contact</a></li>
  </ul>
</nav>
</div>
</div>