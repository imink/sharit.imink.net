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
$errorMessage = "";
$confirmMessage = "";
$id = $_POST ["confirmid"];
$password = $_POST ["password"];

if (User::createNewPassword($password, $id)) {
	$confirmMessage="Password reset succesfully ";    
} else {
	$errorMessage="Could not reset password, please try with new reset email";
}

?>

<body>
<div class="header1"></div>
<div class="error" id="errorMessage"><?php echo $errorMessage; ?></div>
<div class="normal" id="welcome"><?php echo $confirmMessage; ?></div>

	<?php
	
	if (strlen ( $confirmMessage ) > 0) {
		echo "<div class='navigationLink'><a href='login.php'>Login</a></div>";
	}
	if (strlen ( $errorMessage ) > 0) {
		echo "<div class='navigationLink'><a href='resetPass.php'>Back</a></div>";
	}
	
	
	?>
</body>
</html>