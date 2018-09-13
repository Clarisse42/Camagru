<?php
require 'connexion.php';


if (isset($_POST['submit']))
{
	$login = $_POST['login'];
	$passwd = hash(whirlpool, $_POST['passwd']);

	$res = $db->prepare("SELECT * FROM users WHERE login = ?");
	$res->execute(array($login));
	$result = $res->fetchAll();

	if (!empty($result))
	{
		if ($result[0][5] == 1)
		{
			$pass = $result[0][3];
			if ($pass === $passwd)
			{
					$res = $db->prepare("UPDATE users SET logged = 1 WHERE login = ?");
					$res->execute(array($login));
					$_SESSION['login'] = $login;

					/*$res2 = $db->prepare("SELECT logged FROM users WHERE login = ?");
					$res2->execute(array($login));
					$res2 = $res2->fetchAll();
					$_SESSION['logged'] = $res2[0][0];
					echo $_SESSION['logged'];*/

					echo '<script type="text/javascript">alert("Vous vous etes connecté avec succes")</script>';
					echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';		
			}
			else
			{
				echo '<script type="text/javascript">alert("Mot de passe inccorect")</script>';
				echo '<script type="text/javascript"> window.location.replace("login2.php") </script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">alert("Votre compte est pas activé. Pensez à regarder dans vos courrier indesirable")</script>';
			echo '<script type="text/javascript"> window.location.replace("login2.php") </script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">alert("Cette identifiant est pas valide. Veuillez vous inscrire.")</script>';
		echo '<script type="text/javascript"> window.location.replace("login2.php") </script>';
	}
}
?>	
