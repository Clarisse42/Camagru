<?php
require ('../user/connexion.php');

 if (!isset($_SESSION['login']))
  {
    echo '<script>
      alert("Vous devez vous connecter");
      window.location.replace("../index.php")
      </script>';
  }
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/galery.css"/>
<link rel="icon" href="../favicon.ico" />

</head>
<body>

	<h1><a href="../index.php"><img class="logo" src="../img2/RkplT3NrQlFRbENJZG02TnM4UzNydz09LS1Wa20wZmpSWE1SMXNCNXZIa0Y5L3FnPT0=--3a9b38ca77d0aa03277f7f9a43b29972bf82f524.png"></a></h1>

	<?php include "display_galery.php";?>

	<?php include "add_commentaire.php";?>

	<?php include "like.php";?>


  <?php if(isset($_SESSION['login'])) { ?>
  <a href="../user/logout.php" class="logout">Logout</a>
  <?php } ?>

</body>
</html>