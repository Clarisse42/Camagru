<?php
session_start();
require 'connexion.php';
require_once 'create_account.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="icon" href="../favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/csscreateaccount.css"/>
		<title>Camagru</title>
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
  			top: 200px;
  			right: -10px;
		}
		</style>
	</head>
	<body>
		<h1><a href="../index.php"><img class="camagru" src="../img2/RkplT3NrQlFRbENJZG02TnM4UzNydz09LS1Wa20wZmpSWE1SMXNCNXZIa0Y5L3FnPT0=--3a9b38ca77d0aa03277f7f9a43b29972bf82f524.png"/></a></h1>
		<form method="post" action="create_account.php">
		<table>
		<tr>
		<td>
			Entrez votre Identifiant
			</br>
			<input type="text" name="login" value="" required/>
		</td>
		</tr>
		<tr>
		<td>
			Entrez votre adresse mail
			</br>
			<input type="email" name="mail" value="" required/>
		</td>
		</tr>
		<tr>
		<td>
			Entrez votre mot de passe
			</br>
			<input type="password" name="passwd" value="" required/>
		</td>
		</tr>
		<tr>
		<td>
			Confirmation de votre mot de passe
			</br>
			<input type="password" name="passwd2" value="" required/>
		</td>
		</tr>
		<tr>
		<td>
			<input type="submit" name="submit" value="OK" class="button"/>
		</td>
		</tr>
		<tr>
		<td>
			Déjà inscrit?
			</br>
			<a href="login2.php"><input type="button" value="login"/></a>
		</td>
		</tr>
		</table>
		</form>
		<footer>
		<?php if(isset($_SESSION['login'])) { ?>
		<a href="logout.php" class="logout">Logout</a>
		<?php } ?>
		</footer>
	</body>
</html>

