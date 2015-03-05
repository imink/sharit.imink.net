<?php
include_once("./framework/import.php"); ?>

<?php

SharIt::auth()->logout();
SharIt::app()->flashMsg()->add('s',"Logout Success!");
SharIt::app()->redirect("");
?>
