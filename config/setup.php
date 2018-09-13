<?php

try
{
	$db = new PDO('mysql:host=localhost', 'root', 'tinatina',
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	//Creation de ma base de donnée
	$request = $db->prepare("CREATE DATABASE IF NOT EXISTS `camagru`;");
	$request->execute();

	//Creation de ma table user
	$tb_users = $db->prepare("CREATE TABLE IF NOT EXISTS   `camagru`.`users` (`id` int(255) UNSIGNED
		AUTO_INCREMENT PRIMARY KEY, `mail` varchar(255) NOT NULL, `login`
		varchar(255) NOT NULL, `passwd` varchar(255) NOT NULL, logged BOOL NOT NULL DEFAULT 0, active BOOL NOT NULL DEFAULT 0 );");
	$tb_users->execute();


	//Creation de ma table miniature
	$tb_mini = $db->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`miniature` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` VARCHAR(255) NOT NULL, `path` text NOT NULL);");
	$tb_mini->execute();

	//Creation de ma table des photos
	$tb_montage = $db->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`montage` (`id` int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `user` varchar(255) NOT NULL, `like` int NOT NUlL DEFAULT 0, `image` LONGTEXT NOT NULL, `path` varchar(255) NOT NULL, `date_creation` DATETIME);");
	$tb_montage->execute();


		//Creation de ma table comments
	$tb_com = $db->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`commentaire` (`id` int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `id_photo` int NOT NULL, `nom_user` varchar(255) NOT NULL, `commentaire` LONGTEXT);");
	$tb_com->execute();

		//Creation de ma table likes
	$tb_like = $db->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`like` (`id` int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `id_photo` int NOT NULL, `nom_user` varchar(255) NOT NULL);");
	$tb_like->execute();

	//insertion de mes miniatures dans ma db
	$req = $db->prepare("INSERT INTO `camagru`.`miniature` (`name`, `path`) VALUES(?, ?)");
	if (!$req->execute(array("coeur", "../img-montage/coeur.png")) ||
		!$req->execute(array("soleil", "../img-montage/soleil.png")) ||
		!$req->execute(array("crown", "../img-montage/crown.png")))
	{
	   echo "\nPDO::errorInfo():\n";
	   print_r($db->errorInfo());
	}

}
catch(PDOexception $e)
{
	print("Error:".$e->getMessage()."\n");
	die();
}

echo '<script type="text/javascript">alert("DATABASE CREATED BANGBANG")</script>';
echo '<script type="text/javascript"> window.location.replace("../index.php") </script>';

?>
