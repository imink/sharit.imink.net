<div id="header"> 
<?php
// identify the current page, so we can control the tabs
$currentPage=basename($_SERVER['PHP_SELF'], ".php");
?>
<ul>
	<li <?php if ($currentPage=="home") echo 'id="selected"'; ?>><a href="home.php">Home</a></li>
	<li <?php if ($currentPage=="register") echo 'id="selected"'; ?>><a href="register.php">Register</a></li>
	<li <?php if ($currentPage=="login") echo 'id="selected"'; ?>><a href="login.php">Login</a></li>
		
</ul>

</div>
