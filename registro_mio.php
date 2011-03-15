<?php 
#lo necesario
require_once 'config.php';
$time_start = microtime(true);
$sdb = new AmazonSDB();


if(isset($_POST['Submit']))
{

	if((!$_POST['Username']) || (!$_POST['Password']))
	{
		// display error message
                //----
                // muestra el mensaje de error
		header('location: registro_mio.php?msg=1');
		exit;
	} else {

        //The password will saved in md5 at the db
        //--
        //La contraseña se guardará en md5
        $pw = md5($_POST['Password']);
	$username = $_POST['Username'];
        $email = $_POST['email'];

        //Check if username already exists
        //----
        //Comprobamos si existe el usuario
        $select = $sdb->select("select count(*) from `{$domain}` where usuario = '$username'");
        $items2 = $select->body->Item();
        $data2 = reorganize_data($items2);
        
        //If it doesn't exist
        //----
        //Si no existe
        if  ($data2[rows][0][Count][0] == '0') {
        
        $uniqid = uniqid();
        //The item name will be an uniqid
        //----
        //El nombre del item será un uniqid
        $add_attributes = $sdb->batch_put_attributes($domain, array(
			$uniqid => array(
				'usuario'    => $username,
				'password'     => $pw,
                                'e-mail'     => $email
			)));
        //If all went ok
        //----
        //Si todo ha salido bien
        if ($add_attributes->isOK())
	{
	header('location: registro_mio.php?msg=2');
	exit();
        }
        }
        //If other username exists
        //----
        //Si existe otro usuario
        else {
            header('location: registro_mio.php?msg=3');
             }
        
	} 
}

/**
 *	Show error messages etc.
 * ----
 *      Muestra el mensaje de error.
 */
function showMessage()
{
	if(is_numeric($_GET['msg']))
		{
			switch($_GET['msg'])
			{
				case 1: echo "Rellena todos los campos.<br>Fill all inputs.";
                                break;
				
				case 2: echo "Usuario Creado.<br>User added.";
                                break;
				
				case 3: echo "Ya hay un usuario con ese nombre.<br>An user with that name already exists.";
                                break;
				
			}
		}
}

?>
<?php
$id_usuario=$_SESSION['id'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
<?php include "index.php"; ?>
<div align="center"><br><br><br><br>
         <div><?php showMessage();?></div>
             <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="addUserForm">
		<input name="Username" type="text" value="Usuario/user" size="30" maxlength="30" /><br />
                <input name="Password"  value="Password"  type="password" size="30" maxlength="30" /><br />
                <input name="email" type="text" value="E-mail" size="30" maxlength="30" /><br />
		<input name="Submit" type="submit" value="Add" />
	</form>
</div>