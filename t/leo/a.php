<?php
//Leo
require_once(dirname(dirname(dirname(__FILE__)))."/framework/import.php");

$return = SharFiles::uploadFile(SharIt::request()->files('aaa'),SHARIT_PATH_IMG,"productPic");
print_r($return);
echo "OK";

?>

