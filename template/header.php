<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>SharIT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <!-- Stylesheets -->
  <link href="<?php echo SHARIT_URL_APP ?>css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo SHARIT_URL_APP ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
  <!-- Date Picker -->
  <link href="<?php echo SHARIT_URL_APP ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <!-- Pretty Photo -->
  <link href="<?php echo SHARIT_URL_APP ?>css/prettyPhoto.css" rel="stylesheet">
  <!-- Sidebar nav -->
  <link href="<?php echo SHARIT_URL_APP ?>css/sidebar-nav.css" rel="stylesheet">
  <!-- Flex slider -->
  <link href="<?php echo SHARIT_URL_APP ?>css/flexslider.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link href="<?php echo SHARIT_URL_APP ?>css/font-awesome.css" rel="stylesheet"> 
  <!-- Main stylesheet -->
  <link href="<?php echo SHARIT_URL_APP ?>css/style.css" rel="stylesheet">
  <!-- Stylesheet for Color -->
  <link href="<?php echo SHARIT_URL_APP ?>css/red.css" rel="stylesheet">
  <?php SharIt::page()->customCSSFiles();?>
  <?php SharIt::page()->customScript('POS_HEAD');?>
  <?php SharIt::page()->customScriptFiles('POS_HEAD');?>
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo SHARIT_URL_APP ?>image/favicon/favicon.png">

</head>

<body>
  <script src="<?php echo SHARIT_URL_APP ?>js/jquery-1.8.3.min.js"></script> <!-- jQuery -->
  <script src="<?php echo SHARIT_URL_APP ?>js/bootstrap.min.js"></script> <!-- jQuery -->
  <?php SharIt::page()->customCSS();?>
  <?php SharIt::page()->customScriptFiles('POS_BEGIN');?>
  <?php SharIt::page()->customScript('POS_BEGIN');?>
  <!-- Header starts -->
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <!-- Logo. Use class "color" to add color to the text. -->
          <div class="logo">
            <h1><a href="<?php echo SHARIT_URL_APP ?>index.php">Shar<span class="color bold">IT</span></a></h1>
            <p class="meta">Share Items and Information Technology</p>
          </div>
        </div>
        <div class="col-md-5 col-md-offset-3">
          <!-- Search form -->
        </div>
      </div>
    </div>
  </header>
  <!-- Header ends -->
  
  
  <!-- Login and Register form (Modal) -->

  <!-- Login Modal starts -->
  <?php include(dirname(__FILE__)."/partial/float_login.php") ?>
  <!-- Login modal ends -->

  <!-- Register Modal starts -->
  <?php include(dirname(__FILE__)."/partial/float_register.php") ?>
  <!-- Register modal ends -->

  <!-- Navigation -->
  <?php include(dirname(__FILE__)."/partial/nav.php") ?>
  <!-- Navigation ends -->

  <!-- FlashMessage -->
  <?php if (SharIt::app()->flashMsg()->hasMessages()):?>
  <div class="container" id="flashMsg">
  <?php SharIt::app()->flashMsg()->display() ?>
  </div>
  <?php endif ?>
  <!-- FlashMessage end-->
  <!-- Navigation ends -->