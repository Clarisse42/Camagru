<?php
session_start();
require 'connexion.php';
require_once 'login.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="icon" href="../favicon.ico" />
		<title>Camagru-Login</title>
		<link rel="stylesheet" type="text/css" href="../css/csscreateaccount.css"/>
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
		<h1><a href="../index.php"><img class="camagru" src="../img2/RkplT3NrQlFRbENJZG02TnM4UzNydz09LS1Wa20wZmpSWE1SMXNCNXZIa0Y5L3FnPT0=--3a9b38ca77d0aa03277f7f9a43b29972bf82f524.png"/></a></h1>
		<form method="post" action="login.php">
		<table>
		<tr>
		<td>
			Identifiant
			</br>
			<input type="text" name="login" value="" required/>
		</td>
		</tr>
		<tr>
		<td>
			Mot de passe
			</br>
			<input type="password" name="passwd" value="" required/>
		</td>
		</tr>
		<tr>
		<td>
			<input type="submit" name="submit" value="OK"/>
		</td>
		</tr>
		<tr>
		<td>
			<a href="forgot_pass2.php"><input type="button" name="mdp" value="Mot de passe oublié?"/></a>
		</td>
		</tr>
		</table>
		</form>
		<?php if (isset($_SESSION['login'])) { ?>
		<a href="logout.php" class="logout">Logout</a>
		<?php } ?>
	</body>

</html>
