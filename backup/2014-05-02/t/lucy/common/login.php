<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

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
	<form action="dologin.php" method="post">
		<div class="field">
			<div class="fieldCaption">E-mail</div>
			<div class="fieldInput">
				<input type="text" name="email">
			</div>
		</div>
		<br>		
		<div class="field">
			<div class="fieldCaption">Password</div>
			<div class="fieldInput">
				<input type="password" name="password">
			</div>
		</div>
		<br>	
		<div class="field">
			<input class="loginButton" type="submit" value="Login">
			<a class="forgotpass" href="resetPass.php">Reset Password</a>
		</div>
		<br>	
		<br>	
		
		
	</form>
	</div>
	<div class="instructionsReg">Please login with your email and password</div>
	
</body>
</html>