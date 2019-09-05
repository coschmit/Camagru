<?php
session_start();
try
 {
  $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;', 'root', 'pass1234');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
  die($e->getMessage());
 }
$path = $_POST['img'];
$reqest = $pdo->query("DELETE FROM photo WHERE photo_path = '$path'");
?>