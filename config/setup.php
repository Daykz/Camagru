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
	$sql = "CREATE TABLE camagruDB.users(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(255) NOT NULL,
				email VARCHAR(255) NOT NULL,
				hash VARCHAR(255) NOT NULL,
				password VARCHAR(60) NOT NULL,
				active BOOL NOT NULL DEFAULT 0)";
	$dbh->query($sql);

?>