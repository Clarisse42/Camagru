<?php
require 'connexion.php';

if (isset($_POST['send']))
{
	$mail = $_POST['mail'];
	$id = $db->prepare("SELECT id FROM users WHERE mail = ?");
	$id->execute(array($mail));
	$id = $id->fetchAll();
	$_SESSION['id'] = $id[0][0];
	$idTosend = (string)$_SESSION['id'];
	$check = $db->prepare("SELECT * FROM users WHERE mail = ?");
	$check->execute(array($mail));
	$check = $check->fetchAll();

	if (empty($check))
	{
		echo '<script type="text/javascript">alert("Cette adress mail existe pas !")</script>';
		echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';
	}
	else
	{
		echo '<script type="text/javascript"> alert("Un mail de reinitiaisation vous a ete envoye!")</script>';
		echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $headers .= "To: $login <$mail>" . "\r\n";
		$headers .= 'From: Clarisse <Clarisse@student.43.fr>' . "\r\n";
		$to = $mail;
		$subject = 'Password reinitialisation (Camagru)';
		$message_body = "
				     <html>
				      <head>
				       <title>Lien de reinitalisation passwd  Camagru</title>
				      </head>
				      <body>
				       Hello,
						Please click this link to change your passwd:
						<a href='$url/modif_passwd2.php?mail=$mail&id=$idTosend'>Valider</a>
				      </body>
				     </html>
				     ";
	  	mail($to, $subject, $message_body, $headers);
		}
}
?>
