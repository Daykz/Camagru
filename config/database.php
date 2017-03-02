<?php

$DB_DSN = 'mysql:host=localhost;';
$DB_USERNAME = "root";
$DB_PASSWORD = "root";

/*
$DB_OPTIONS = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	PDO::ERRMODE_EXCEPTION);


$dbh = new mysqli('localhost', 'root', 'root', 'accounts') or die($dbh->error);
if ($dbh->connect_errno)
{
	printf("La connection a echoue: %s\n", $dbh->error);
}


$dbh = new PDO($DB_DSN, $DB_USERNAME, $DB_PASSWORD, $DB_OPTIONS);
if (!$dbh->query('CREATE DATABASE accounts'))
{
	//printf("Error: %s\n", $dbh->error);
}
*/

/*
$dbh->query('
CREATE TABLE `accounts`.`users`
(`id` INT NOT NULL AUTO_INCREMENT,
`username` VARCHAR(50) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`hash` VARCHAR(32) NOT NULL,
`active` BOOL NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
);') or die($db->error);
*/
?>
