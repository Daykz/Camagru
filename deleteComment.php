<?php 

session_start();

$user = $_SESSION['username'];
$comment = $_GET['commentId'];

try
        {
          $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }
        catch (exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }

        $sql = $dbh->prepare("SELECT user FROM comments WHERE id = $comment");
        $sql->execute();
        $owner = $sql->fetch();

        if ($owner[0] == $user)
        {	
        	$sql = $dbh->prepare("DELETE FROM comments WHERE id = $comment");
        	$sql->execute();
        }

        header('Location: gallery.php');
?>