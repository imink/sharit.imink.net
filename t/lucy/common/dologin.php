<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<?php
include 'common.php';
?>
<body>

<?php
include "header.php";

// First validate parameters
$errorMessage = "";
$welcomeMessage = "";
$email = $_POST ["email"];
$password = $_POST ["password"];
$loadedUser=User::checkPassword($email, $password);
if ($loadedUser->isValid()) { // check if user exists
		$welcomeMessage = "Welcome " . $loadedUser->get_Name();
		session_start();
		$_SESSION['currentUser']=$loadedUser;
		header("Location: homeLoggedIn.php");
		die();
} else {
     $errorMessage=$loadedUser->get_error();
     
}
?>
<br/>
<br/>
<br/>

<div class="header1"></div>
	<div class="error" id="errorMessage"><?php echo $errorMessage; ?></div>
	<div class="normal" id="welcome"><?php echo $welcomeMessage; ?></div>

	<?php
	
	if (strlen ( $errorMessage ) > 0) {
		echo "<div class='navigationLink'><a href='login.php'>Back</a></div>";
	}
	
	?>
</body>
</html>