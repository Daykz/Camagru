<?php
session_start();
	if (!isset($_SESSION['username']))
	{
		$_SESSION['message'] = "you must be authentiicated";
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="accueil.css">
	<a href="logout.php">Deconnection</a>
</head>
<body>

</body>
</html>