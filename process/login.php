<?php
if (isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = $dbh->prepare("SELECT * FROM users WHERE username = :username");
	$result->execute(array('username' => $username));
	$result = $result->fetchAll();

	if (!empty($result))
	{
		$hash = $result[0]['password'];

		if (password_verify($password, $hash))
		{
			header('Location: http://e2r4p14.42.fr:8080/Camagru/accueil.php');
			$_SESSION['username'] = $username;
  			exit();
		}
		else
		    echo 'Le mot de passe est invalide.';
	}
	else
		echo "Bad username";
}
?>
