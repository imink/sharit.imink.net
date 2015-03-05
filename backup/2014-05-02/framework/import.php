<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
include_once("config.php");
include_once("SharIt.php");
include_once("lib/ClassAutoLoader/autoloadManager.php");
$_autoloadManager = new AutoloadManager();

//make sure the savefile is writable
$_autoloadManager->setSaveFile('/tmp/PHP-ClassAutoload-SharIt.php');
$_autoloadManager->addFolder(SHARIT_PATH_FRAMEWORK.'/Base');
$_autoloadManager->addFolder(SHARIT_PATH_FRAMEWORK.'/DB');
$_autoloadManager->addFolder(SHARIT_PATH_FRAMEWORK.'/Component');
$_autoloadManager->addFolder(SHARIT_PATH_FRAMEWORK.'/Model');
$_autoloadManager->addFolder(SHARIT_PATH_FRAMEWORK.'/lib');
$_autoloadManager->register();