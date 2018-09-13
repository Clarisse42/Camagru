<?php
session_start();
require 'connexion.php';


if (isset($_GET['mail']) && !empty($_GET['mail']))
{
	$mail = ($_GET['mail']);
	$result = $db->prepare("SELECT * FROM users WHERE mail = ?");
	$result->execute(array($mail));
	$result = $result->fetchAll();

	if (!empty($result))
	{
		$res = $db->prepare("UPDATE users SET active = '1' WHERE mail= ?");
		$_SESSION['message'] = "Congratulation, your account has been activated";
		$res->execute(array($mail));
	}
	if (empty($result))
		$_SESSION['message'] =  "no user";
	$actived = $db->query("SELECT active FROM users WHERE mail = :mail");
	if ($actived)
		$_SESSION['message'] = "Your account is already activated";
	echo '<script type="text/javascript">alert("Votre compte a bien  ete activé")</script>';
	echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';
}
?>