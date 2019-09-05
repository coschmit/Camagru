<?php
require('database.php');
try
{
	$DB = new PDO($DB_DSN, $DB_USER, $DB_pass1234WORD);
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
 catch (PDOException $e) {
    echo $e->getMessage();
}
 ?>