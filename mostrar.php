<?php
#lo necesario
include 'config.php';
$time_start = microtime(true);
$sdb = new AmazonSDB();
//WHERE usuario = 'admin'
$select = $sdb->select("SELECT * FROM `{$domain}` ");
$select2 = $sdb->select("SELECT count(*) from `{$domain}` where usuario = 'admin'");

        $items = $select->body->Item();
        $data = reorganize_data($items);
        $html = generate_html_table($data);

        $items2 = $select2->body->Item();
        $data2 = reorganize_data($items2);
        $html2 = generate_html_table($data2);    
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Show users || Mostrar usuarios</title>
		<style type="text/css" media="screen">
		body {
			margin: 0;
			padding: 0;
			font: 14px/1.5em "Helvetica Neue", "Lucida Grande", Verdana, Arial, sans;
			background-color: #fff;
			color: #333;
		}
		table {
			margin: 50px auto 0 auto;
			padding: 0;
			border-collapse: collapse;
		}
		table th {
			background-color: #eee;
		}
		table td,
		table th {
			padding: 5px 10px;
			border: 1px solid #eee;
		}
		table td {
			border: 1px solid #ccc;
		}
		</style>
	</head>
	<body>

            <br><br><br><br>
               <!-- Display HTML table -->
		<?php
                include "index.php";
                echo "Usuario: ". $data[rows][0][usuario][0];
                echo " con contraseña: ".$data[rows][0][password][0];
                echo $html;
                ?>
                <br><br><br>
                <?php
                /*
                echo "<br><br><br>";
                echo "Cantidad de usuarios con el nombre admin: ". $data2[rows][0][Count][0];
                echo $html2;
                 * 
                 */
                ?>

	</body>
</html>


<?php
#Cuanto tarda la consulta
$time=microtime(true) - $time_start;
echo "<br>".PHP_EOL . PHP_EOL .  $time . PHP_EOL;
?>