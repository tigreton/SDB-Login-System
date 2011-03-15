<?php
session_start();
#lo necesario
include 'config.php';
$time_start = microtime(true);
$sdb = new AmazonSDB();
require_once('LoginSystem.class_mio.php');

	

if(isset($_POST['Username']))
{
		if((!$_POST['Username']) || (!$_POST['Password']))
		{
			// display error message
                        //----
                        // muestra el mensaje de error
			header('location: login_mio.php?msg=1');
			exit;
		}
		
		
		if(doLogin($_POST['Username'],$_POST['Password']))
		{
			/**
			 * Redirect here to your secure page
                         * ----
                         * Redirecciona hacia tu pagina segura
			 */
			header('location: example_secured.php');
		}
		else
		{
			header('location: login_mio.php?msg=2');
			exit;
		}
	}
	
	/**
	 * show Error messages
         * ----
         * Muestra mensajes de error
	 */
	function showMessage()
	{
		if(is_numeric($_GET['msg']))
		{
			switch($_GET['msg'])
			{
				case 1: echo "Rellene los dos campos.<br>Fill the 2 inputs.";
				break;
				
				case 2: echo "Datos de acceso incorrectos.<br>Incorrect Login Details";
				break;
                                
                                case 3: echo "Debes hacer login.<br>You need to Login.";
				break;
			}
		}
	} 
        
        
?>


<?php include "index.php"; ?>
<div align="center"><br><br><br><br>
    <div><?php showMessage();?></div>
 <form action="login_mio.php" method="post">
	    <input value="Usuario/user" name="Username" title="Usuario" type="text"/><br /><br />
            <input value="password" name="Password" title="Password" type="password"/><br>
            <input name="Submit" type="submit" value="Login" />
            </form>
</div>

        