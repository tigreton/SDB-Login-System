<?php
#lo necesario
include 'config.php';
$time_start = microtime(true);
$sdb = new AmazonSDB();
$new_domain = $sdb->create_domain($domain);
if ($new_domain->isOK())
	{
            echo "<br><br><br><br><br><div align=\"center\"><h1>registrado correctamente el nuevo dominio<br>";
            echo "correctly registered the new domain</h1><br></div>";
        }
?>
