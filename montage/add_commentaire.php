<?php
require '../user/connexion.php';

	if (isset($_POST['submit']))
	{
		$com = $_POST['com'];
		$id = $_POST['id_photo'];

		$sql2 = $db->prepare("INSERT INTO commentaire (id_photo, nom_user, commentaire) VALUES (?, ?, ?)");
		$sql2->execute(array( $_POST['id_photo'], $_SESSION['login'], $com));

		$sql = $db->prepare("SELECT user FROM montage WHERE id = ?");
		$sql->execute(array($id));
		$sql = $sql->fetch();
		$user = $sql[user];

		$sql1 = $db->prepare("SELECT mail FROM users WHERE login = ?");
		$sql1->execute(array($user));
		$sql1 = $sql1->fetch();
		$mail = $sql1[mail];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "To: $user <$mail>" . "\r\n";
		$headers .= 'From: Clarisse <Clarisse@student.43.fr>' . "\r\n";
		$to = $mail;
		$subject = 'Nouveau commentaire sur votre photo (Camagru)';
		$message_body = "
				     <html>
				      <head>
				       <title>Un nouveau commentaire sur votre photo</title>
				      </head>
				      <body>
				       Bonjour $user,
				       Tu as un nouveau commentaire sur une de tes photo. Pour plus d'informations :
				       <a href='$url/../index.php'>Clique ici</a>
				      </body>
				     </html>
				     ";
	  	var_dump(mail($to, $subject, $message_body, $headers));

	  	echo '<script type="text/javascript"> window.location.replace("galery2.php") </script>';

	}
?>