<?php

//Change this for testing.
//----
//Cambia esto para testeo.
error_reporting(E_ALL & ~E_NOTICE);  


	/**
	 * Check if the user is logged in
	 *-----
         * Saber si un usuario está logueado
	 * @return true or false
	 */
	function isLoggedIn()
	{
		if($_SESSION['LoggedIn'])
		{
                     return true;
		}
		else return false;
	}
	
	/**
	 * Check username and password against DB
         *--------
	 * Comprueba el usuario mas contraseña en la B.B.D.D
	 * @return true/false
	 */
function doLogin($username, $password)
	{
                #lo necesario
                #the necessary
                require_once '../funciones/html.php';
                require_once '../aws-sdk/sdk.class.php';
                include 'config.php';
                $time_start = microtime(true);
                $sdb = new AmazonSDB();
                $password = md5($password);


                // check db for an username
                // ----
		// comprueba si hay algun usuario registrado
                $select = $sdb->select("select count(*) from `{$domain}` where usuario = '$username' and password = '$password'");
                $items2 = $select->body->Item();
                $data2 = reorganize_data($items2);

                             
		/* If no user/password combo exists return false
                 * ----
                 * si no existe ese usuario con
                 * esa contraseña devuelve falso 
                 */

		if($data2[rows][0][Count][0] != 1)
		{
			return false;
		}
		else // matching login ok ---- emperajamiento correcto
		{
                        // check db for user and pass here.
                        // ----
                        // comprueba el usuario y la contraseña.
                        $select2 = $sdb->select("SELECT * FROM `{$domain}` WHERE usuario = '$username'");
                        $items = $select2->body->Item();
                        $data = reorganize_data($items);
			// set session vars up
                        // ----
                        // crea las variables de session
			$_SESSION['LoggedIn'] = true;
			$_SESSION['userName'] = $username;
                        /* here comes the item-name
                         * when we register a new user
                         * we give him a uniqid() and it saved
                         * in this session var
                         * ----
                         * aquí se guarda el nombre del item
                         * cuando registramos al nuevo usuario,
                         * le damos una uniqid() y es guardado
                         * en esta variable de sesión
                         */
			$_SESSION['id'] = $data[rows][0][id];

		}

		return true;
	}
        
	
	/**
	 * Destroy session data/Logout.
         * ----
         * Destruye los datos de session
	 */
	function logout()
	{
		unset($_SESSION['LoggedIn']);
		unset($_SESSION['userName']);
		unset($_SESSION['id']);
		session_destroy();
	}
	

        
	/**
	 * Cleans a string for input into a SDB Database.
	 * Gets rid of unwanted characters/SQL injection etc.
	 * This function came with the old functions,
         * feel free of use it
         * -----
         * Limpia el string para la inserccion en la base de datos.
         * Quita los caracterese "peligrosos" de inyeccion SQL.
         * Esta función venia con la versión antigua,
         * puedes usarla si quieres.
	 * @return string
	 */
	function clean($str)
	{
		// Only remove slashes if it's already been slashed by PHP
                //----
                // Solo quita las barras si ya las ha quitado PHP
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		// Let MySQL remove nasty characters.
                //----
                // Que mysql remueva los carácteres "poco deseados"
		$str = mysql_real_escape_string($str);
		
		return $str;
	}
	
	/**
	 * create a random password
         * ----
         * crea una contraseña aleatoria
	 * 
	 * @param	int $length - length of the returned password
         * ----
         * @param       int $length - tamaño de la contraseña
         * 
	 * @return	string - password
	 *
	 */
	function randomPassword($length = 8)
	{
		$pass = "";
		
		// possible password chars.
                //----
                // carácteres posibles para la contraseña
		$chars = array("a","A","b","B","c","C","d","D","e","E","f","F","g","G","h","H","i","I","j","J",
			   "k","K","l","L","m","M","n","N","o","O","p","P","q","Q","r","R","s","S","t","T",
			   "u","U","v","V","w","W","x","X","y","Y","z","Z","1","2","3","4","5","6","7","8","9");
			   
		for($i=0 ; $i < $length ; $i++)
		{
			$pass .= $chars[mt_rand(0, count($chars) -1)];
		}
		
		return $pass;
        }

?>