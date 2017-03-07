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
		if ($result[0]['active'] == 1)
		{
			$hash = $result[0]['password'];

			if (password_verify($password, $hash))
			{
				$sql = "UPDATE users SET logged = :variableA WHERE username = :username";
				$PDOStatement = $dbh->prepare($sql);	
				$PDOStatement->execute(array(":variableA" => date('Y-m-d H:i:s'), ":username" => $username));

				header('Location: accueil.php');
				$_SESSION['username'] = $username;
	  			exit();
			}
			else
			    echo 'Le mot de passe est invalide.';
		}
		else
			echo "Your account is NOT ACTIVED, please check your email";

	}
	else
		echo "Bad username";
}
?>
