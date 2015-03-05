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
	<form action="setNewPassword.php" method="post">
		<div class="field">
			<div class="fieldCaption">Password</div>
			<div class="fieldInput">
				<input type="password" name="password">
			</div>
			
		</div>
		<br>		
		<div class="field">
			<input class="loginButton" type="submit" value="Set New Password">
		</div>
		<br>	
		<br>	
		
		<input style="display:none;" name="confirmid" type=""hidden" value="<?php echo $_GET ["id"];?>"></input>
		
	</form>
	</div>
	<div class="instructionsReg">Please enter your new password</div>
	
</body>
</html>