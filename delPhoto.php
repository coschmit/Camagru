<?php
session_start();
try
 {
  $pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru;', 'root', 'pass');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
  die($e->getMessage());
 }
$path = $_POST['img'];
$reqest = $pdo->query("DELETE FROM photo WHERE photo_path = '$path'");
?>