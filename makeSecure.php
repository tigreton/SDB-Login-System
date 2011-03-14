<?php
/**
 * makeSecure.php
 * 
 * This file is included at the top of any page you wish to make secure with a login.
 * ----
 * Este archivo se incluye en la parte superior de cualquier página que quieras asegurarla con un login.
 *
 * Access will be granted only if they are logged in, else returned to login page.
 * ----
 * Solo podrán acceder si están logueados, si no lo están, se les envia a la pagina de login.
 * 
 * Usage:	require('makeSecure.php');
 * ----
 * Uso:         require('makeSecure.php');
 * 
 */

session_start();
require('LoginSystem.class_mio.php');

//We save the session vars in a normal var
//----
//Guardamos las variables de session en una variable normal
$usuario = $_SESSION['userName'];
$id = $_SESSION['id'];
/**
 * if not logged in goto login form, otherwise we can view our page
 * ----
 * si no está logueado, lo enviamos al login, si lo está podrá ver la página
 */
if(!isLoggedIn())
{
	header("Location: login_mio.php?msg=3");
	exit;
} 

?>