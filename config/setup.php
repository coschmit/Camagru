<?php
require 'database.php';
try
{
	$DB = new PDO('mysql:host=127.0.0.1;', 'root', 'pass');
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
 catch (PDOException $e) {
    echo $e->getMessage();
}
$reqest = "CREATE DATABASE IF NOT EXISTS camagru;";
$DB->prepare($reqest)->execute();
require('connect.php');
$reqest = "USE camagru;";
$DB->prepare($reqest)->execute();
$reqest = "CREATE TABLE IF NOT EXISTS `users` ( `user_id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `phone` VARCHAR(11) NOT NULL , `password` VARCHAR(255) NOT NULL , `valid` INT NOT NULL DEFAULT 0, PRIMARY KEY (`user_id`)) ENGINE = InnoDB;";
	 $DB->prepare($reqest)->execute();
	 $reqest = "CREATE TABLE IF NOT EXISTS photo (
	id int NOT NULL AUTO_INCREMENT,
	name varchar(40) NOT NULL,
	photo_path varchar(40) NOT NULL,
	photo_date datetime NOT NULL,
	PRIMARY KEY(id))
;";
$DB->prepare($reqest)->execute();
$reqest = "CREATE TABLE IF NOT EXISTS comments (
	id int NOT NULL AUTO_INCREMENT,
	id_photo int NOT NULL,
	author varchar(40) NOT NULL,
	comment text NOT NULL,
	date_com datetime NOT NULL,
	PRIMARY KEY(id))
;";
$DB->prepare($reqest)->execute();
 ?>