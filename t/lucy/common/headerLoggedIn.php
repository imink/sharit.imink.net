<div id="header"> 
<?php

require_once  'loaduser.php';

// identify the current page, so we can control the tabs
$currentPage=basename($_SERVER['PHP_SELF'], ".php");
?>
<ul>
	<li <?php if ($currentPage=="homeLoggedIn") echo 'id="selected"'; ?>><a href="homeLoggedIn.php">Home</a></li>
	<li <?php if ($currentPage=="page1") echo 'id="selected"'; ?>><a href="page1.php">Page1</a></li>
	<li <?php if ($currentPage=="page2") echo 'id="selected"'; ?>><a href="page2.php">Page2</a></li>
	<li <?php if ($currentPage=="page3") echo 'id="selected"'; ?>><a href="page3.php">Page3</a></li>
</ul>

</div>
<div class="logout"><a href="logout.php">Logout</a></li></div>

