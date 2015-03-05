<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
date_default_timezone_set("UTC");

define('SHARIT_NAME', 'SharIt');
define('SHARIT_PATH_ROOT', dirname(dirname(__FILE__)));
define('SHARIT_PATH_FRAMEWORK', dirname(__FILE__));
define('SHARIT_PATH_APP', dirname(dirname(__FILE__)));
define('SHARIT_PATH_TEMPLATE', "template");
define('SHARIT_PATH_ERRORVIEW', "include/ele_error");
define('SHARIT_PATH_IMG', "image/products/");


define('SHARIT_EMAIL_SUFIX', "@liv.ac.uk");

define('SHARIT_BID_HOUR', "17");

if($_SERVER['HTTP_HOST']=="localhost"){
	define('SHARIT_HOST', "http://localhost");
	define('SHARIT_PATH', "/sharit/");
}elseif($_SERVER['HTTP_HOST']=="sharit.ileodo.com"){
	define('SHARIT_HOST', "http://sharit.ileodo.com");
	define('SHARIT_PATH', "/");
}
// category number for official bid platform
define('SHARIT_OFFICIAL_CATE', "53");

define('SHARIT_URL_APP', SHARIT_HOST.SHARIT_PATH);

define('SHARIT_DB_USERNAME', 'sharit');
define('SHARIT_DB_PASSWORD', 'sharit12345');
define('SHARIT_DB_NAME', 'sharIt');
define('SHARIT_DB_HOST', 'ileodo.com');
define('SHARIT_DB_PREFIX', 'sharit_');

define('SHARIT_MAIL_ADDRESS', 'SharIt@ileodo.com');
define('SHARIT_MAILER_SERVER', 'localhost');
define('SHARIT_MAILER_PORT', '25');
define('SHARIT_MAILER_USERNAME', 'sharit');
define('SHARIT_MAILER_PASSWORD', 'sharit');