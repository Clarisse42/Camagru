<?php
require 'connexion.php';
if (isset($_POST['submit']) == "OK")
{
	$sql = $db->prepare("SELECT id FROM users WHERE mail = ?");
	$sql->execute(array($_GET['mail']));
	$id = $sql->fetch();

	if ($_GET['id'] != NULL && $_GET['id'] == $id[id])
	{
		$newpass = hash(whirlpool, $_POST['newpass']);
		$newpass2 = hash(whirlpool, $_POST['newpass2']);

		if ($newpass == $newpass2)
		{
			if (preg_match('%^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{5,}$%', $_POST['newpass']) === 1)
			{	
				$req1 = $db->prepare('USE camagru');
				$req1->execute();
				$req = $db->prepare('UPDATE users SET passwd = ? WHERE mail = ?');
				$req->execute(array($newpass, $_GET['mail']));
				echo '<script type="text/javascript"> alert("Votre kMot de passe a bien ete reinitialiser") </script>';
				echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';
			}
			else
			{
				echo '<script type="text/javascript"> alert("Votre mdp doit contenir au moins un chiffre, une majuscule et minimum 5 caractere") </script>';
				echo '<script type="text/javascript"> window.location.replace("modif_passwd2.php?mail='.$_GET['mail'].'&id='.$_GET['id'].'") </script>';
			}
		}
		else 
		{	
			echo '<script type="text/javascript"> alert("Mot de passe pas identique") </script>';
			echo '<script type="text/javascript"> window.location.replace("modif_passwd2.php?mail='.$_GET['mail'].'&id='.$_GET['id'].'") </script>';
		}
	}
	else
	{
		echo '<script type="text/javascript"> alert("Un probleme est survenue...") </script>';
		echo '<script type="text/javascript"> window.location.replace("modif_passwd2.php?mail='.$_GET['mail'].'&id='.$_GET['id'].'") </script>';
	}

}
?>
