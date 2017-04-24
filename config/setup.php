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
				photo text NOT NULL,
				user text NOT NULL,
				comment text NOT NULL)";
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
				name VARCHAR(255) NOT NULL,
				path text NOT NULL)";
	$dbh->query($sql);

	
	$rep = $dbh->prepare("INSERT INTO stickers (name, path) VALUES(?, ?)");
	if (!$rep->execute(array("apple", "img/apple.png")) ||
		!$rep->execute(array("homepage", "img/homepage.png")) ||
		!$rep->execute(array("lidl", "img/lidl.png")) ||
		!$rep->execute(array("logout", "img/logout.png")) ||
		!$rep->execute(array("navire", "img/navire.png")) ||
		!$rep->execute(array("orangina", "img/orangina.png")) ||
		!$rep->execute(array("tete", "img/tete.png")) ||
		!$rep->execute(array("moustache", "img/moustache.png")) ||
		!$rep->execute(array("wow", "img/wow.png")))
	{
	   echo "\nPDO::errorInfo():\n";
	   print_r($dbh->errorInfo());
	}




	echo"DATABASE CREATED\n";

?>