<?php
session_start();
require 'connexion.php';
//require_once 'modif_passwd.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="icon" href="../favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/csscreateaccount.css">
		<title>Camagru modif passwd</title>
		<style>
		 .logout
		{
  			background-color:  #999999;
  			border: none;
  			color: black;
  			text-align: center;
  			text-decoration: none;
  			display: inline-table;
  			font-size: 40px;
  			border-radius: 15px;
  			width: 20%;
  			box-shadow: 0 10px 20px 0 rgba(250, 250, 250, 0.5), 0 6px 20px 0 rgba(156, 156, 156, 0.5);
  			position: relative;
  			top: 600px;
  			right: -10px;
		}
		</style>
	</head>
	<body>
		<h1>Camagru</h1>
		<form method="post" action="<?php echo "modif_passwd.php?mail=".$_GET['mail']."&id=".$_GET['id']."" ?>">
		<table>
			<tr>
			<td>
				Nouveau Mot de passe
				</br>
				<input type="password" name="newpass" value="" required/>
			</td>
			</tr>
			<tr>
			<td>
				Retapez votre nouveau mot de passe
				</br>
				<input type="password" name="newpass2" value="" required/>
			</td>
			</tr>
			<tr>
			<td>
				<input type="text" name="mail" value="<?php echo $_GET['mail'];?>" hidden/>
				<input type="text" name="id" value="<?php echo $_GET['id'];?>" hidden/>
				<input type="submit" name="submit" value="OK" class="button"/>
			</td>
			</tr>
		</table>
		<?php if(isset($_SESSION['login'])) { ?>
			<a href="logout.php" class="logout">Logout</a>
		<?php } ?>
	</body>
</html>
