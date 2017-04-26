<?php
session_start();
  $comment = $_POST['commentaire'];
  $photoPath = $_POST['photoPath'];
  $user = $_SESSION['username'];

try
  {
    $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  }
  catch (exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

	$sql = $dbh->prepare("SELECT path FROM photos ORDER BY id DESC");
    $sql->execute();
    $photos = $sql->fetch();

  if (isset($comment) && !empty($comment))
  {
    $rep = $dbh->prepare("INSERT INTO comments (photo, user, comment) VALUES(?, ?, ?)");
  if (!$rep->execute(array($photoPath, $user, $comment)))
  {
    echo "\nPDO::errorInfo():\n";
    print_r($rep->errorInfo());
    die();
  }
}
unset($_POST['commentaire']);
header("Location: gallery.php");
 ?>