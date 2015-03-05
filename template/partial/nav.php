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
    <li><a href=<?php echo SharIt::app()->createUrl('index.php')?>><i class="icon-home"></i></a></li>                                   
    <li><a href=<?php echo SharIt::app()->createUrl('product/items.php')?>>Product</a></li>
    <?php if(!SharIt::auth()->isLogin()){ ?>
    <li><a href=<?php echo SharIt::app()->createUrl('request/index.php')?>>Request</a></li>
    <?php }if(SharIt::auth()->gid==1){ ?>
    <li><a href=<?php echo SharIt::app()->createUrl('request/index.php')?>>Request</a></li>
    <li><a href=<?php echo SharIt::app()->createUrl('publish/index.php')?>>Publish</a></li>    
    <li><a href=<?php echo SharIt::app()->createUrl('user/index.php')?>>My Account</a></li>
    <?php }?>
    <?php if($uid = SharIt::auth()->uid){ 
        $user = SharQuerySupervisor::getGid($uid);
        if($user==2){?>
    <li><a href=<?php echo SharIt::app()->createUrl('publish/index.php')?>>Publish</a></li>
    <li><a href=<?php echo SharIt::app()->createUrl('user/index.php')?>>My Account</a></li>
    <li><a href=<?php echo SharIt::app()->createUrl('supervisor/index.php')?>>Supervisor</a></li>
    <?php }}?>
    <li><a href=<?php echo SharIt::app()->createUrl('about/index.php')?>>About Us</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <?php if(!SharIt::auth()->isLogin()):?>
    <li><a href="#login" role="button" data-toggle="modal">Login</a></li>
    <li><a href="#register" role="button" data-toggle="modal">Register</a></li>
    <?php else:?>
    <li><a href="<?php echo SharIt::app()->createUrl('logout.php')?>" role="button">Logout</a></li>
    <?php endif?>
  </ul>
  </nav>
</div>
</div>