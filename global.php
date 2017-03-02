<?php
session_start();

	try
	{
		$bdh = new PDO('mysql:host=localhost;dbname=camagruDB;charset=utf8', 'root', 'root');
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
?>