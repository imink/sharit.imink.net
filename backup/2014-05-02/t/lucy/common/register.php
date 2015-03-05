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
	<form action="doregister.php" method="post">
		<div class="field">
			<div class="fieldCaption">Name</div>
			<div class="fieldInput">
				<input type="text" name="name">
			</div>
		</div>
		<br>
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
		<div class="button">	
		<input type="submit" value="Register">
		</div>
	</form>
	</div>
	<div class="instructionsReg">Please type in your name, email and password
		to register, your email will be your username</div>
	
</body>
</html>