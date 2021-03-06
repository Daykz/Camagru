<?php
  require 'global.php';

  $user = $_SESSION['username'];
  
  if (!isset($user))
  {
    $_SESSION['message'] = "you must be authentiicated";
    header("Location: index.php");
  }
  try
  {
    $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  }
  catch (exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

  $sql = $dbh->prepare("SELECT id, name, path FROM stickers ORDER BY id DESC");
  $sql->execute();
  $stickers = $sql->fetchAll();

      $sql = $dbh->prepare("SELECT path FROM photos ORDER BY id DESC");
      $sql->execute();
      $photos = $sql->fetch();

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="css/modal.css">
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="css/accueil.css">
  <link rel="stylesheet" href="css/gallery.css">
</head>

<body>
<div class='header'>
    <div class='margin'>
      <a href="logout.php">
      <img alt="Disconnect" src="img/logout.png" width=40px; height=40px;>
      </a>
    </div>
</div>
      <button id="gallery"> <a href="gallery.php">View gallery</a></button>
<div class="content">

<div class='main'>
      <div class="list_sticker">
      <div class="imgpng">
        
       <?php
        foreach ($stickers as $sticker) {
          echo '
            <div class="stick">
              <img class="sticker" data-sticker-id="'.$sticker["id"].'" src="'.$sticker["path"].'">
            </div>
          ';
        }
      ?>  
      </div>            
      </div>
      <div class="camera">
        <video id="video"></video>
         <button id="startbutton"><img id="button_cam" src="img/camera.png"></button>

            <input id="uploadfile" type="file" accept="image/png" name="upload_file" onchange="uploadFile(event)">

                  <div id="openModal" class="modalDialog">
                      <div class="cadre">
                      <canvas id="canvas"></canvas>
                          <a href="accueil.php" title="Close" class="close">X</a>
                          <img id="imgmodal" width="480px" src="<?php echo $photos[0] ?>">


                          <form method="post" action="comments.php">
                            <textarea id="commentaire" type="text" name="commentaire"></textarea>
                            <?php echo "<input type=\"hidden\" name=\"photoPath\" value=\"" .$photos[path]. "\" />";?>
                            <input id="submit" type="submit" name="submit1" value="Commenter">
                          </form>



                      </div>
                  </div>
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
          echo "<div><img src='".$content[path]."'></div>";
        }
        ?>
        </div>
          <script type="text/javascript" src="webcam.js"></script>
          <script type="text/javascript" src="upload.js"></script>
          <script type="text/javascript" src="like.js"></script>

</div>
<div class='footer'> 
</div>
</body>
</html>
