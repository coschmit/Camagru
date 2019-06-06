
<?php
session_start();
//require_once("config/setup.php");
if($_SESSION[login]){
    header('location: main.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
</head>
<body>
    <h1>SkuSku Camagru</h1>
    
</body>
</html>