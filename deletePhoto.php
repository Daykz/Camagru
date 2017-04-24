<?php

	session_start();


	$user = $_SESSION['username'];
	$photo = $_GET['photoId'];

	print_r($photo);
	try
        {
          $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }
        catch (exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }

        $sql = $dbh->prepare("SELECT owner FROM photos WHERE id = $photo");
        $sql->execute();
        $owner = $sql->fetch();

        if ($owner[0] == $user)
        {	
        	$sql = $dbh->prepare("DELETE FROM photos WHERE id = $photo");
        	$sql->execute();

        	$sql = $dbh->prepare("DELETE FROM comments WHERE photo = 'img_database/".$user."/photo".$photo.".png'");
        	$sql->execute();
        }

        //header('Location: gallery.php');
?>
