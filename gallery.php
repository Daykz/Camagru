<?php 
session_start();
   // $user = $_SESSION['username'];

function disp_likes($content, $liked)
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
        
        $sql = $dbh->prepare("SELECT * FROM likes WHERE photo_id = ".$content["id"]." ");
        $sql->execute();
        $likes = $sql->fetchAll();
        foreach ($likes as $value)
        {
          if ($_SESSION[username] == $value[user])
          {
            $liked = '1';
          }
        }
          if ($liked == 1)
          {
            echo "<a href='#like'".$content["id"]." class='dislikePhoto' data-like-id='".$content["id"]."'>
            <img id='like' src='img/dislike.png'></a>";
          }
          else
          {
            echo "<a href='#like'".$content["id"]." class='likePhoto' data-like-id='".$content["id"]."'>
            <img id='like' src='img/like.png'></a>";
          }
        echo "<div id='nbr_like'> ".count($likes)." </div>";
}

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

  $sql = $dbh->prepare("SELECT * FROM comments WHERE photo = '$content[path]' ORDER BY id DESC");
  $sql->execute();
  while ($data = $sql->fetch())
  {

    echo "<div id='comment'>
          <p id='owner'>".$data[user].":</p>
          <div id='data'>".$data[comment]."
          </div>
          <a href='#delete". $data["id"] ."' class='deleteComment' data-comment-id='". $data["id"]. "'>Supprimer le commentaire</a>
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
   <a href="logout.php">
      <img alt="Disconnect" src="img/logout.png" width=40px; height=40px;>
      </a>
    <a href="accueil.php">
    <img alt="Home" src="img/homepage.png" width=40px; height=40px;></a>

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


        $sql = $dbh->prepare("SELECT COUNT(*) AS total FROM photos");
        $sql->execute();
        $content = $sql->fetch();
        $nbrPhoto = $content['total'];


        $imgByPage = 5;
        $nbrPage = ceil($nbrPhoto/$imgByPage);

        if (isset($_GET['page']))
        {
          $currentPage = intval($_GET['page']);
          if ($currentPage > $nbrPage)
            $currentPage = $nbrPage;
        }
        else
          $currentPage = 1;

        $firstStart = ($currentPage - 1) * $imgByPage;

        $sql = $dbh->prepare("SELECT * FROM photos ORDER BY id DESC LIMIT ".$firstStart.", ".$imgByPage." ");
        $sql->execute();

        while ($content = $sql->fetch())
        {
          echo "<div><img id='imggallery' src='".$content[path]."'></div>";
          echo "\r\n".'<a href="#delete'. $content["id"] .'" class="deleteButton" data-photo-id="'. $content["id"]. '">Supprimer la photo</a>';

          disp_likes($content, $liked);




          disp_comment($content);
        }

        echo '<p align="center">Page : ';
        for ($i=1; $i <= $nbrPage; $i++)
        {
          if($i == $currentPage)
          {
            echo ' [ '.$i.' ] ';
          }  
          else
          {
            echo ' <a href="gallery.php?page='.$i.'">'.$i.'</a> ';
          }
        }
        echo '</p>';


        ?>

</div>
  <script type="text/javascript" src="photo.js"></script>
  <script type="text/javascript" src="comment.js"></script>
  <script type="text/javascript" src="like.js"></script>
</body>
</html>