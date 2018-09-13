<?php
session_start();
?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="icon" href="favicon.ico" />
		<link rel="stylesheet" media="screen" type="text/css" href="css/cssindex.css"/>
		<title>Camagru</title>
	</head>
	<body>
		<h1><img class="camagru" src="img2/RkplT3NrQlFRbENJZG02TnM4UzNydz09LS1Wa20wZmpSWE1SMXNCNXZIa0Y5L3FnPT0=--3a9b38ca77d0aa03277f7f9a43b29972bf82f524.png"/></h1>
		<table cellspacing="15">
			<?php if ($_SESSION['login'] !== NULL) { ?>
			<tr>
				<td>
					<img src="img2/picto-design-gris.png" style="height:100px;"/>
					<a href="montage/montage.php" class="button">Montage</a>
				</td>
			</tr>
			<?php } ?>
			<?php if($_SESSION['login'] === NULL) { ?>
			<tr>
				<td>
					<img src="img2/vendors-sing-up and-join.png" style="height: 150px;"/>
					<a href="user/create_account2.php" class="button"><p>Create Account</p></a>
				</td>
			</tr>
					<tr>
						<td>
							<img src="img2/man-human-person-login-128.png" style="height:100px;"/>
							<a href="user/login2.php" class="button">Login</a>
						</td>
					</tr>
			<?php } else { ?>
					<tr>
						<td>
							<img src="img2/man-human-person-login-128.png" style="height:100px;"/>
							<a href="user/logout.php" class="button">Logout</a>
						</td>
					</tr>
					<?php }?>	
		</table>
	
	</body>
</html>
