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
$resetInfo = "";
$email = $_POST ["email"];

if (! User::userExists ( $email )) { // check if user exists
	$errorMessage = "Could not find user with this email " . $email;
} else {
	if (User::sendResetPasswordEmail ( $email )) {
		$resetInfoMessage = "A message has been sent to your email address with instructions on how to reset your password";
	} else {
		$errorMessage = "This account does not appear to be valid, have you enabled your account by opening the email sent on registration";
	}
}
?>

<br />
	<br />
	<br />
	<br />

	<div class="header1"></div>
	<div class="error" id="errorMessage"><?php echo $errorMessage; ?></div>
	<div class="normal" id="welcome"><?php echo $resetInfoMessage; ?></div>

	<?php
	
	if (strlen ( $errorMessage ) > 0) {
		echo "<div class='navigationLink'><a href='resetPass.php'>Back</a></div>";
	}
	if (strlen ( $resetInfoMessage ) > 0) {
		echo "<div class='navigationLink'><a href='login.php'>Continue</a></div>";
	}
	
	?>
</body>
</html>