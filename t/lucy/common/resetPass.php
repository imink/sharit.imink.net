<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<?php
include 'common.php';
?>
<body>

<?php
include "header.php"
?>
	<br>
	<br>
		<div class="registerForm">
	<form action="doreset.php" method="post">
		<div class="field">
			<div class="fieldCaption">E-mail</div>
			<div class="fieldInput">
				<input type="text" name="email">
			</div>
		</div>
		<br>		
		<div class="field">
			<input class="loginButton" type="submit" value="Reset Password">
		</div>
		<br>	
		<br>	
		
		
	</form>
	</div>
	<div class="instructionsReg">Please enter your email address to reset your password</div>
	
</body>
</html>