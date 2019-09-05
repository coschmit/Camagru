<?php
require('database.php');
try
{
	$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
 catch (PDOException $e) {
    echo $e->getMessage();
}
 ?>