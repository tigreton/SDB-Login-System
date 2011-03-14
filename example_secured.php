<?php
require('makeSecure.php');
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Secured page with Login</title>
	</head>
	<body>
<?php include "index.php"; ?>
            <br><br><br>
            <div align="center">
                <h2>Si estas viendo esto, es que estás logueado.</h2>
                <h2>If you are looking this, you are logged in.</h2>
                <br><br>
                <h1>Est&aacute;s dentro <?php echo $usuario;?>!! <br>
                Tu id de session es: <?php echo $id;?></h1>
                
                <h1>You are logged in <?php echo $usuario;?>!! <br>
                Your session id is: <?php echo $id;?></h1>
            </div>
	</body>
</html>