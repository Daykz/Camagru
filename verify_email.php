<?php
require 'global.php';


if (isset($_GET['email']) && !empty($_GET['email']) AND
	isset($_GET['hash']) && !empty($_GET['hash']))
{
	$email = ($_GET['email']);
	$hash = ($_GET['hash']);
	$result = $dbh->prepare("SELECT * FROM users WHERE email = ? AND hash = ?"); //" AND active = ?");
	$result->execute(array($email, $hash));
	$result = $result->fetchAll();

	if (!empty($result)) //Activer le compte - active = 1; 
	{
		//$dbh->prepare("UPDATE users SET active = '1' WHERE email='".$email."'");

		$dbh->query("UPDATE users SET active = '1' WHERE email='".$email."'");
		//$dbh->execute();
		//$dbh->prepare("UPDATE users SET active = 1 WHERE email = ?");
		//$dbh->execute(array($email));
		// var_dump($_GET);
		// echo "user OK";
	}
	if (empty($result))
		echo "no user";
}
?>