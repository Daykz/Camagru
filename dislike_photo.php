<?php

session_start();

$user = $_SESSION['username'];
$like = $_GET['likeId'];


	try
	{
	$dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	}
	catch (exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}


	$sql = $dbh->prepare("SELECT * FROM likes WHERE photo_id = '$like' AND user = '$user'");
	$sql->execute();
	$if_like = $sql->fetchAll();
	$result = count($if_like);

	if ($result == 1)
	{	
		$sql = $dbh->prepare("DELETE FROM likes WHERE photo_id = '$like' AND user = '$user' ");
		if (!$sql->execute())
		{
			echo "\nPDO::errorInfo():\n";
			print_r($sql->errorInfo());
			die();
		}
	}


	header('Location: gallery.php');
?>