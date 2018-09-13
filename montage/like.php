<?php
require '../user/connexion.php';

	if (isset($_POST['like']))
	{
		$id = $_POST['id_photo'];

		$req = $db->prepare("SELECT user FROM montage WHERE id = ?");
		$req->execute(array($id));
		$req = $req->fetch();

		$sql3 = $db->prepare("SELECT * FROM `like` WHERE id_photo = ? AND nom_user = ?");
		$sql3->execute(array($id, $req[user]));
		$sql3 = $sql3->fetch();

		if (!$sql3)
		{
			$sql5 = $db->prepare("INSERT INTO `like` (id_photo, nom_user) VALUES (?,?)");
			$sql5->execute(array($id, $req[user]));
			echo '<script type="text/javascript"> window.location.replace("galery2.php") </script>';
		}
		else
		{
			$sql5 = $db->prepare("DELETE FROM `like` WHERE nom_user = ? AND id_photo = ?");
			$sql5->execute(array($req[user], $id));
			echo '<script type="text/javascript"> window.location.replace("galery2.php") </script>';
		}
					
	}
?>