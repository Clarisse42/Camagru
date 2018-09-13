<?php
require('connexion.php');

if (isset($_POST['submit']))
{
	$_SESSION['mail'] = $_POST['mail'];
	
	$login = $_POST['login'];
	$mail = $_POST['mail'];
	$passwd = hash("whirlpool", $_POST['passwd']);
	$passwd2 = hash("whirlpool", $_POST['passwd2']);

	if ($_POST['passwd'] !== $_POST['passwd2'])
	{
		echo '<script type="text/javascript">alert("Password confirmation does not match")</script>';
		echo '<script type="text/javascript"> window.location.replace("create_account2.php") </script>';
	}
	else if (preg_match('%^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{5,}$%', $_POST['passwd']) === 0)
	{
		echo '<script type="text/javascript">alert("Votre mot de passe doit contenir au moins un chiffre, une majuscule et minimum 5 charactere")</script>';
		echo '<script type="text/javascript"> window.location.replace("create_account2.php") </script>';
	}
	else
	{
		$res = $db->prepare("SELECT * FROM users WHERE mail = ? OR login = ?");
		$res->execute(array($mail, $login));
		$res = $res->fetchAll();

		if (!empty($res))
		{
			echo '<script type"text/javascript">alert("Account Already exist")</script>';
			echo '<script type="text/javascript"> window.location.replace("create_account2.php") </script>';
		}

		else
		{
			$req = $db->prepare("INSERT INTO users (mail, login, passwd) VALUES(?, ?, ?)");
			header('refresh:1;url=../index.php');

			if (!$req->execute(array($mail, $login, $passwd)))
			{
				echo "\PDO::errorInfo():\n";
				print_r($db->errorInfo());
				die();
			}	
				echo '<script type"text/javascript">alert("Un mail de confirmation vous as ete envoyer")</script>';

				/*$id = $db->prepare("SELECT id FROM users WHERE mail = ?");
				$id->execute(array($mail));
				$id = $id->fetchAll();
				$_SESSION['id'] = $id[0][0];*/


				//header('url=../index.php');
				$headers  = 'MIME-Version: 1.0' . "\r\n";
			    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			    $headers .= "To: $login <$mail>" . "\r\n";
			    $headers .= 'From: Clarisse <Clarisse@student.43.fr>' . "\r\n";
				$to = $mail;
				$subject = 'Account Verification (Camagru)';
				$message_body = "
				     <html>
				      <head>
				       <title>Lien de validation Camagru</title>
				      </head>
				      <body>
				       Hello $login,
						Thank you for signing up!
						Please click this link to active your account:
						<a href='$url/verify_account.php?mail=$mail'>Valider</a>
				      </body>
				     </html>
				     ";
	  			mail($to, $subject, $message_body, $headers);
		}
	}
}
?>
