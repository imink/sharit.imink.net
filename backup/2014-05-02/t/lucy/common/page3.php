<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body>
<?php
include 'common.php';
include 'headerLoggedIn.php';
?>

<br/>
<br/>
<br/>
<div class="normal" id="page3">Page 3</div>
<br/>
<div class="normal" id="welcome"><?php echo "Welcome ". $loadedUser->get_name(); ?></div>


</body>