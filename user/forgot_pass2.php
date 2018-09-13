<?php
session_start();
require 'connexion.php';
require_once 'forgot_pass.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="icon" href="../favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/csscreateaccount.css"/>
		<title>Camagru forgot passwd</title>
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
		<form method="post" action="forgot_pass.php">
		<table>
			<tr>
			<td>
				Entrez votre adress mail
				</br>
				<input type="email" name="mail" value="" required/>
			</td>
			</tr>
			<tr>
			<td>
				<input type="submit" name="send" value="Envoyez mail"/>
			</td>
			</tr>
 		</table>
		</form>
		<? if(isset($_SESSION['login'])) { ?>
		<a href="logout.php" class="logout">Logout</a>
		<?php } ?>
	</body>
</html>
