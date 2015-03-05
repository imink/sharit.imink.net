<?php
session_start();
if (isset($_SESSION['currentUser']))
{
	$loadedUser=$_SESSION['currentUser'];
} else {
	header("Location: login.php");
}
?>