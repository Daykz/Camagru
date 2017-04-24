<?php 
    session_start();

function disp_comment($content)
{
  try
        {
          $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }
        catch (exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }

  $sqlp = $dbh->prepare("SELECT * FROM comments WHERE photo = '$content[path]' ORDER BY id DESC");
  $sqlp->execute();
  while ($data = $sqlp->fetch())
  {

    echo "<div id='comment'>
          <a href='#delete". $data["id"] ."' class='deleteComment' data-comment-id='". $data["id"]. "'>Supprimer le commentaire</a>
          <p id='owner'>".$data[user].":</p>
          <div id='data'>".$data[comment]."
          </div>
          </div>";
  }
  echo "<form method='post' action='comments.php'>
                            <textarea id='commentaire' type='text' name='commentaire'></textarea>
                            <input type=\"hidden\" name=\"photoPath\" value=\"" .$content[path]. "\" />
                            <input id='submit' type='submit' name='submit1' value='Commenter'>
                          </form>";
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <title>Gallery</title>
  <link rel="stylesheet" href="css/gallery.css">
</head>
<body>
  <div class='header'>
  <div class='margin'>
    <a href="accueil.php">
    <img alt="Home" src="img/homepage.png" width=40px; height=40px;></div></a>
  </div>
</div>

<div class="view_gallery">
  <?php
        try
        {
          $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }
        catch (exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }
        $sql = $dbh->prepare("SELECT id, name, path FROM photos ORDER BY id DESC");
        $sql->execute();
        while ($content = $sql->fetch())
        {
          echo "<div><img src='".$content[path]."'></div>";
          echo "\r\n".'<a href="#delete'. $content["id"] .'" class="deleteButton" data-photo-id="'. $content["id"]. '">Supprimer la photo</a>';
          echo "<img id='like' src='img/like.png'>";
          disp_comment($content);
        }
        ?>

</div>
  <script type="text/javascript" src="photo.js"></script>
  <script type="text/javascript" src="comment.js"></script>
</body>
</html>