<?php
date_default_timezone_set("UTC");

define('SHARIT_NAME', 'SharIt');
define('SHARIT_PATH_ROOT', dirname(dirname(__FILE__)));
define('SHARIT_PATH_FRAMEWORK', dirname(__FILE__));
define('SHARIT_PATH_APP', dirname(dirname(__FILE__)));
define('SHARIT_PATH_TEMPLATE', "template");
define('SHARIT_PATH_ERRORVIEW', "include/ele_error");
define('SHARIT_PATH_IMG', "image/products/");

define('SHARIT_EMAIL_SUFIX', "@liv.ac.uk");

define('SHARIT_BID_HOUR', "23");

define('SHARIT_HOST', "http://sharit.imink.net");
define('SHARIT_PATH', "/");
define('SHARIT_URL_APP', SHARIT_HOST.SHARIT_PATH);

// category number for official bid platform
define('SHARIT_OFFICIAL_CATE', "53");

define('SHARIT_DB_USERNAME', 'root');
define('SHARIT_DB_PASSWORD', 'wy123123');
define('SHARIT_DB_NAME', 'sharit');
define('SHARIT_DB_HOST', 'imink.net');
define('SHARIT_DB_PREFIX', 'sharit_');

define('SHARIT_MAIL_ADDRESS', 'SharIt@ileodo.com');
define('SHARIT_MAILER_SERVER', 'localhost');
define('SHARIT_MAILER_PORT', '25');
define('SHARIT_MAILER_USERNAME', 'sharit');
define('SHARIT_MAILER_PASSWORD', 'sharit');