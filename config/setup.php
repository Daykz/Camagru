<?php

try
{
	$DB_DSN = 'mysql:host=localhost;';
	$DB_USERNAME = "vjghk";
	$DB_PASSWORD = "vhjk";

	$dbh = new PDO($DB_DSN, $DB_USERNAME, $DB_PASSWORD); //PDO Connection - BDD
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); //mode d'erreur
}
catch (exception $ex)
{
	die('Erreur connection PDO : '.$ex->getMessage());
}

	$sql = "DROP DATABASE IF EXISTS camagruDB";
	$dbh->query($sql);

	$sql = "CREATE DATABASE camagruDB"; //requete
	$dbh->query($sql);
	$sql = "USE camagruDB"; //requete
	$dbh->query($sql);
	


	$sql = "CREATE TABLE camagruDB.comments(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				photo_id INT,
				user_id INT)";
	$dbh->query($sql);

	$sql = "CREATE TABLE camagruDB.likes(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			photo_id INT,
			user_id INT)";
	$dbh->query($sql);

	$sql = "CREATE TABLE camagruDB.photos(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(255) NOT NULL,
				owner VARCHAR(255) NOT NULL,
				likes VARCHAR(255) NOT NULL,
				path text NOT NULL)";
	$dbh->query($sql);

	$sql = "CREATE TABLE camagruDB.users(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(255) NOT NULL,
				email VARCHAR(255) NOT NULL,
				hash VARCHAR(255) NOT NULL,
				password VARCHAR(60) NOT NULL,
				logged DATETIME,
				active BOOL NOT NULL DEFAULT 0)";
	$dbh->query($sql);

	$sql = "CREATE TABLE camagruDB.stickers(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				stick_name VARCHAR(255) NOT NULL)";
	$dbh->query($sql);

	
	$rep = $dbh->prepare("INSERT INTO stickers (stick_name) VALUES(?)");
	if (!$rep->execute(array("img/apple.png")) ||
		!$rep->execute(array("img/homepage.png")) ||
		!$rep->execute(array("img/lidl.png")) ||
		!$rep->execute(array("img/logout.png")) ||
		!$rep->execute(array("img/navire.png")) ||
		!$rep->execute(array("img/orangina.png")) ||
		!$rep->execute(array("img/tete.png")) ||
		!$rep->execute(array("img/moustache.png")) ||
		!$rep->execute(array("img/wow.png")))
	{
	   echo "\nPDO::errorInfo():\n";
	   print_r($dbh->errorInfo());
	}




	echo"DATABASE CREATED\n";

?>