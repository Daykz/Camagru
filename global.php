<?php
session_start();

	try
	{
		$dbh = new PDO('mysql:host=localhost;dbname=camagruDB;charset=utf8', 'root', 'root');
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}

	$siteurl = "http://localhost:8080/Camagru";
?>