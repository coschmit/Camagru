<?php
session_start();
$_SESSION['login'] = NULL;
header('location: index.php');
?>