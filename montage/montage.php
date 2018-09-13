<?php
  require '../user/connexion.php';

  if (!isset($_SESSION['login']))
  {
    echo '<script>
      alert("Vous devez vous connecter");
      window.location.replace("../index.php")
      </script>';
  }

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <link rel="icon" href="../favicon.ico" />
  <title>Camagru</title>
  <link rel="stylesheet" type="text/css" href="../css/montage.css"/>
  <script type="text/javascript">
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
  </script>

</head>

<body>
<!-- Mon header -->
  <div class="head">
  <a href="../index.php"><img class="logo" src="../img2/RkplT3NrQlFRbENJZG02TnM4UzNydz09LS1Wa20wZmpSWE1SMXNCNXZIa0Y5L3FnPT0=--3a9b38ca77d0aa03277f7f9a43b29972bf82f524.png"/><a>

  </div>
  
  <!-- Zone principal -->
  <div class="main"> 

    <!-- photo montage -->
    <div class="right">
      <?php
        $user = $_SESSION['login'];
        
        $sql = $db->prepare("SELECT path FROM montage WHERE user = ? ORDER BY id DESC");
        $sql->execute(array($user));
        while ($content = $sql->fetch())
        {
          echo "<div><img class='".photo."'' src='".$content[path]."'></div>";
        }
        $sql->closeCursor();
      ?>
    </div>

    <!-- Webcam -->
    <div class="webcam">  
      <input type="image" id="coeur" src="../img-montage/coeur.png" style="display:none"/>
      <input type="image" id="crown" src="../img-montage/crown.png" style="display:none"/>
      <input type="image" id="sun" src="../img-montage/soleil.png" style="display:none"/>

      <div id="background">
      <video id="video"></video>
      </div>
      <button id="startbutton" disabled="disabled">Prendre une photo</button>
      <canvas id="canvas" hidden></canvas>
      <img src="http://placekitten.com/g/320/261" id="photo" alt="photo" style="display:none" hidden/>
      <script type="text/javascript" src="webcam.js"></script>

      <!-- Formulaire -->
      <form  class="form" method="post" action="upload.php" name="uploadphoto" enctype="multipart/form-data">
        <input name="image" id="tata" hidden/>
        <input type="hidden" name="MAX_LEN_SIZE" value="524288"/>

        <div id="wrapper">

        <input type="file" name="upload_photo" id="upload_photo" value="upload_photo" onclick="document.getElementById('video').style='display:none;background-color:white;'; document.getElementById('wrapper').style='text-align:center;position:relative;left: 200px;top:-0px;width:200px;'; document.getElementById('tap').style='position: relative;bottom: 280px;left: 300px;'" onchange="preview_image(event)" accept="image/*"/>

        <img id="output_image"/>
        <label id="text" for="upload_photo">only .PNG (Max size 0.5Mo)</label>
        </div>

      <!-- miniature-->
      <div class="down">

      <p>Heart</p>
        <input class="img" id="tap" type="radio" name="filter" value="coeur" onclick="document.getElementById('startbutton').disabled=false;document.getElementById('coeur').style='display:absolute;position:absolute;margin-top:150px;margin-left:230px; width:30%';document.getElementById('crown').style='display:none';document.getElementById('sun').style='display:none'"/> 

        <p>Crown</p>
        <input class="img" id="tap" type="radio" name="filter" value="crown" onclick="document.getElementById('startbutton').disabled=false;document.getElementById('crown').style='display:absolute;position:absolute;margin-top:150px;margin-left:220px; width: 100px;';document.getElementById('sun').style='display:none';document.getElementById('coeur').style='display:none'"/> </br>
          
          <p>Sun</p>
          <input class="img" id="tap" type="radio" name="filter" value="sun" onclick="document.getElementById('startbutton').disabled=false;document.getElementById('sun').style='display:absolute;position:absolute;margin-top:140px;margin-left:220px; height:100px;widht:70px; font-size: 3,5 em;';document.getElementById('coeur').style='display:none';document.getElementById('crown').style='display:none'"/><br><br>
        </div>
        </form>
      </div>
    </div>

<div class='footer'>
  <a href="galery2.php" class="logout">Gallery</a>
  <?php if(isset($_SESSION['login'])) { ?>
  <a href="../user/logout.php" class="logout">Logout</a>
  <?php } ?>
</div>
</body>
</html>