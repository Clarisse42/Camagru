<?php
session_start();

try
{
	$db = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'tinatina');
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}
$url = "http://localhost:8080/camagru/user";
?>
