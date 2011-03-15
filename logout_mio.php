<?php
/**
 * 	logout.php
 * 
 * 	signs the user out, destroying session data etc.
 *      Desloguea al usuario destruyendo toda sus datos de sesion
 * 
 */

session_start();
require('LoginSystem.class_mio.php');

logout();
header("Location: login_mio.php");
	exit;

?>