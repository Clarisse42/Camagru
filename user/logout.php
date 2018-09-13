<?php
session_start();

require 'connexion.php';

$res = $db->prepare("UPDATE users SET logged = 0 WHERE login = ?");
$res->execute(array($_SESSION['login']));

$_SESSION = array();

echo '<script type="text/javascript">alert("Vous vous etes deconnecté avec succes")</script>';
echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';		

session_destroy();
?>
