<?php
/**
 * 	logout.php
 * 
 * 	signs the user out, destroying session data etc.
 * 
 */

session_start();
require('LoginSystem.class_mio.php');

logout();
header("Location: login_mio.php");
	exit;

?>