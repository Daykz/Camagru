<?php
session_start();
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

		$dbh->query("UPDATE users SET active = '1' WHERE email = :email");

		$_SESSION['message'] = "Congratulation, your account has been activated";

		//$dbh->execute();
		//$dbh->prepare("UPDATE users SET active = 1 WHERE email = ?");
		//$dbh->execute(array($email));
		// var_dump($_GET);
		// echo "user OK";
	}
	if (empty($result))
		$_SESSION['message'] =  "no user";
	$actived = $dbh->query("SELECT active FROM users WHERE email = :email");
	if ($actived)
		$_SESSION['message'] = "Your account is already activated";
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
					<a href="index.php">Retour</a>
	</body>
</html>