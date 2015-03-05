<?php
session_start();		// just
session_destroy();		// destroy the session
header("Location: login.php");		// and go back to start
?>
