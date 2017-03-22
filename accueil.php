<?php
session_start();
	if (!isset($_SESSION['username']))
	{
		$_SESSION['message'] = "you must be authentiicated";
		header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="css/modal.css">
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="css/accueil.css">
</head>

<body>
<div class='header'>
    <div class='margin'>
      <a href="logout.php">
      <img alt="Disconnect" src="img/logout.png" width=40px; height=40px;>
      </a>
    </div>
</div>
<div class="content">
  
<div class='main'>
      <div class="list_sticker">
          <div class="imgpng"> 
               <img alt="stickers" src="img/navire.png" width=75px; height=75px;>
                <img alt="stickers" src="img/apple.png" width=75px; height=75px;>
                <img alt="stickers" src="img/lidl.png" width=75px; height=75px;>
                <img alt="stickers" src="img/tete.png" width=75px; height=75px;>
                <img alt="stickers" src="img/orangina.png" width=75px; height=75px;>
                <img alt="stickers" src="img/wow.png" width=75px; height=75px;>
                <img alt="stickers" src="img/moustache.png" width=75px; height=75px;>
           </div>
      </div>
               
      <div class="camera">
        <video id="video"></video>
         <button onclick="window.location.href = '#openModal';" id="startbutton">Take picture</button>
                  <div id="openModal" class="modalDialog">
                      <div class="cadre">
                          <canvas id="canvas"></canvas>
                          <a href="accueil.php" title="Close" class="close">X</a>
                      </div>
                  </div>
          <script type="text/javascript" src="webcam.js"></script>
      </div>
</div>
        <div class="preview">
        <?php
        $owner = $_SESSION['username'];
        try
        {
          $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }
        catch (exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }
        $sql = $dbh->prepare("SELECT path FROM photos WHERE owner = ? ORDER BY id DESC");
        $sql->execute(array($owner));
        while ($content = $sql->fetch())
        {
          echo "<div id='".$content[path]."'><img src='".$content[path]."'></div>";
        }
        ?>
        </div>
</div>
<div class='footer'> 
</div>
</body>
</html>
