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
include 'common.php';

$errorMessage = "";
$confirmMessage = "";
$id = $_GET ["confirmid"];
if (User::confirmAccount($id)) {
     $confirmMessage="Thanks for confirming your account, please login";
} else {
    $errorMessage="We would not confirm your account at this time";
}


?>

<br/>
<br/>
<br/>

<div class="header1"></div>

<div class="error" id="errorMessage"><?php echo $errorMessage; ?></div>
<div class="normal" id="welcome"><?php echo $confirmMessage; ?></div>

	<?php
	
	if (strlen ( $errorMessage ) > 0) {
		echo "<div class='navigationLink'><a href='register.php'>Back</a></div>";
	}
	if (strlen ( $confirmMessage ) > 0) {
		echo "<div class='navigationLink'><a href='login.php'>Login</a></div>";
	}
	
	?>
</body>
</html>