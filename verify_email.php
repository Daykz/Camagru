<?php
require 'config/database.php';
session_start();

if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
	$email = $dbh->escape_string($_GET['email']);
	$hash = $dbh->escape_string($_GET['hash']);

	echo "user ok";
}
?>