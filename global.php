<?php
ob_start("ob_gzhandler");

require("includes/class_core.php");
require("includes/class_database.php");
require("includes/class_security.php");
require("includes/class_template.php");
require("includes/class_user.php");

global $db, $core, $security, $template, $user;

$core 		= new Core();
$db 		= new Database();
$security 	= new Security();
$template 	= new Template();
$user 		= new User();

$core->Init();
$core->openDatabase();
?>