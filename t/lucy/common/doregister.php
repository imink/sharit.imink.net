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
$name = $_POST ["name"];
$email = $_POST ["email"];
$password = $_POST ["password"];
$validator = new Validator ();
$validator->validateNewUser ( $name, $email, $password );
if (strlen ( $validator->getErrorMessage () ) > 0) {
	$errorMessage = $validator->getErrorMessage ();
} else {
	// try and insert into dbase
	if (User::userExists ( $email )) { // check if user exists
		$errorMessage = "User already exists with email " . $email;
	} else {
		if (! User::addUser ( $name, $email, $password )) {
			$errorMessage = "Failed to register, please contact system admin";
		} else {
			$welcomeMessage = "Welcome " . $name . " a message has been sent to your email address, open this link to validate your account.";
			User::sendValidationEmail($email);
		}
	}
}
?>

<br/>
<br/>
<br/>
<br/>

<div class="header1"></div>
	<div class="error" id="errorMessage"><?php echo $errorMessage; ?></div>
	<div class="normal" id="welcome"><?php echo $welcomeMessage; ?></div>

	<?php
	
	if (strlen ( $errorMessage ) > 0) {
		echo "<div class='navigationLink'><a href='register.php'>Back</a></div>";
	}
	if (strlen ( $welcomeMessage ) > 0) {
		echo "<div class='navigationLink'><a href='login.php'>Continue</a></div>";
	}
	
	?>
</body>
</html>