<?php
session_start();
require '../user/connexion.php';

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
{
$cut = imagecreatetruecolor($src_w, $src_h);
imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}



function check_format($src)
{
	$extension_upload = strtolower(substr(strrchr($src['upload_photo']['name'], '.'),1));
	if ($extension_upload != "png")
	{
		echo '<script type="text/javascript"> alert("Cette photo est pas du bon format")</script>';
		echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
		exit (0);
	}
	if (!$src['upload_photo']['tmp_name'])
	{
		echo '<script type="text/javascript"> alert("Format non supporte ou erreur lors de lupload de la photo")</script>';
		echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
		exit (0);
	}
	if (!list($witdh, $height) = getimagesize($src['upload_photo']['tmp_name']))
	{
		echo '<script type="text/javascript"> alert("Format non supporte ou erreur lors de lupload de la photo")</script>';
		echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
		exit (0);
	}
	$test = file_get_contents($src['upload_photo']['tmp_name']);
	if ($witdh == 0|| $height == 0)
	{
		echo '<script type="text/javascript"> alert("Format non supporte ou erreur lors de lupload de la photo")</script>';
		echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
		exit (0);
	}
}


function is_post_file($file)
{
if (!empty($file['upload_photo']['tmp_name'] || !empty($file['upload_photo']['name'])))
return (TRUE);
else
return (FALSE);
}

if ($_POST['filter'] == "coeur")
{
	if (is_post_file($_FILES) == FALSE)
	{
		$src = $_POST['image'];
	}
	else
	{
		check_format($_FILES);
		echo $_FILES;
		$src = file_get_contents($_FILES['upload_photo']['tmp_name']);
		$src = 'data:image/png;base64,' . base64_encode($src);
	}
	$src = str_replace('data:image/png;base64,', '', $src);
	$src = str_replace(' ', '+', $src);
	$src = base64_decode($src);
	file_put_contents("photo/tmp.png", $src);
	$src1 = imagecreatefrompng("../img-montage/coeur.png");
	$dest = imagecreatefrompng("photo/tmp.png");
	imagealphablending($src1, false);
	imagesavealpha ($src1, true);
	$largeur_source = imagesx($src1);
	$hauteur_source = imagesy($src1);
	$largeur_destination = imagesx($dest);
	$hauteur_destination = imagesy($dest);
	$destination_x = $largeur_destination - $largeur_source;
	$destination_y =  $hauteur_destination - $hauteur_source;
	imagecopymerge_alpha($dest, $src1, $destination_x, $destination_y, 0, 0, imagesx($src1), imagesy($src1), 90);
	ob_start();
	imagepng($dest);
	$image_data = ob_get_contents();
	ob_end_clean();

	$name = $_SESSION['login'];
	$picture = md5(rand());
	$picture .= ".png";
	if (!file_exists("photo/user/$name"))
	{
		mkdir ("photo/user/$name");
		file_put_contents("photo/user/$name/$picture", $image_data);
	}
	else
		file_put_contents("photo/user/$name/$picture", $image_data);
	$req = $db->prepare("INSERT INTO montage (user, image, path, date_creation) VALUES (?, ?, ?, ?)");
	$req->execute(array($_SESSION['login'], $picture, "photo/user/$name/$picture", date("Y-m-d H:i:s")));
	echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
imagedestroy($dest);
imagedestroy($src1);
}

if ($_POST['filter'] == "crown")
{
	if (is_post_file($_FILES) == FALSE)
	{
		$src = $_POST['image'];
	}
	else
	{
		check_format($_FILES);
		echo $_FILES;
		$src = file_get_contents($_FILES['upload_photo']['tmp_name']);
		$src = 'data:image/png;base64,' . base64_encode($src);
	}
	$src = str_replace('data:image/png;base64,', '', $src);
	$src = str_replace(' ', '+', $src);
	$src = base64_decode($src);
	file_put_contents("photo/tmp.png", $src);
	$src1 = imagecreatefrompng("../img-montage/crown.png");
	$dest = imagecreatefrompng("photo/tmp.png");
	imagealphablending($src1, false);
	imagesavealpha ($src1, true);
	$largeur_source = imagesx($src1);
	$hauteur_source = imagesy($src1);
	$largeur_destination = imagesx($dest);
	$hauteur_destination = imagesy($dest);
	$destination_x = $largeur_destination - $largeur_source;
	$destination_y =  $hauteur_destination - $hauteur_source;
	imagecopymerge_alpha($dest, $src1, $destination_x, $destination_y, 0, 0, imagesx($src1), imagesy($src1), 90);
	ob_start();
	imagepng($dest);
	$image_data = ob_get_contents();
	ob_end_clean();

	$name = $_SESSION['login'];
	$picture = md5(rand());
	$picture .= ".png";
	if (!file_exists("photo/user/$name"))
	{
		mkdir ("photo/user/$name");
		file_put_contents("photo/user/$name/$picture", $image_data);
	}
	else
		file_put_contents("photo/user/$name/$picture", $image_data);
	$req = $db->prepare("INSERT INTO montage (user, image, path) VALUES (?, ?, ?)");
	$req->execute(array($_SESSION['login'], $picture, "photo/user/$name/$picture"));
	echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
imagedestroy($dest);
imagedestroy($src1);
}


if ($_POST['filter'] == "sun")
{
	if (is_post_file($_FILES) == FALSE)
	{
		$src = $_POST['image'];
	}
	else
	{
		check_format($_FILES);
		echo $_FILES;
		$src = file_get_contents($_FILES['upload_photo']['tmp_name']);
		$src = 'data:image/png;base64,' . base64_encode($src);
	}
	$src = str_replace('data:image/png;base64,', '', $src);
	$src = str_replace(' ', '+', $src);
	$src = base64_decode($src);
	file_put_contents("photo/tmp.png", $src);
	$src1 = imagecreatefrompng("../img-montage/soleil.png");
	$dest = imagecreatefrompng("photo/tmp.png");
	imagealphablending($src1, false);
	imagesavealpha ($src1, true);
	$largeur_source = imagesx($src1);
	$hauteur_source = imagesy($src1);
	$largeur_destination = imagesx($dest);
	$hauteur_destination = imagesy($dest);
	$destination_x = $largeur_destination - $largeur_source;
	$destination_y =  $hauteur_destination - $hauteur_source;
	imagecopymerge_alpha($dest, $src1, $destination_x, $destination_y, 0, 0, imagesx($src1), imagesy($src1), 90);
	ob_start();
	imagepng($dest);
	$image_data = ob_get_contents();
	ob_end_clean();

	$name = $_SESSION['login'];
	$picture = md5(rand());
	$picture .= ".png";
	if (!file_exists("photo/user/$name"))
	{
		mkdir ("photo/user/$name");
		file_put_contents("photo/user/$name/$picture", $image_data);
	}
	else
		file_put_contents("photo/user/$name/$picture", $image_data);
	$req = $db->prepare("INSERT INTO montage (user, image, path) VALUES (?, ?, ?)");
	$req->execute(array($_SESSION['login'], $picture, "photo/user/$name/$picture"));
	echo '<script type="text/javascript"> window.location.replace("montage.php") </script>';
imagedestroy($dest);
imagedestroy($src1);
}

?>