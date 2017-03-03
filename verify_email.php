<?php
require 'global.php';


// echo "user ok";
// var_dump($_GET);

if (isset($_GET['email']) && !empty($_GET['email']) AND
	isset($_GET['hash']) && !empty($_GET['hash']))
{
	$email = ($_GET['email']);
	$hash = ($_GET['hash']);
	$result = $dbh->prepare("SELECT * FROM users WHERE email = ? AND hash = ?");
	$result->execute(array($email, $hash));
	$result = $result->fetchAll();

	if (!empty($result))
	{
		//var_dump($result);
		echo "user ok";
	}
	if (empty($result))
		echo "no user";
	
}
?>