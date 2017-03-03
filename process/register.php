<?php
if (isset($_POST['signup']))
{
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['username'] = $_POST['username'];

	$name = $_POST['username'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$password2 = password_hash($_POST['password2'], PASSWORD_BCRYPT);
	$hash = md5(rand(0,1000));

	
	// var_dump($_POST);

	if ($_POST['password'] !== $_POST['password2'])
	{
		echo 'Password confirmation does not match';
	}
	elseif (!preg_match('/^(?=.*\\d)(?=.*[a-z]).{8,}$/', $_POST['password']))
	{
		echo "Le mot de passe doit contenir au moins une minuscule, un chiffre, et doit faire au moins 8 caractères";
	}
	else
	{
		$result = $dbh->prepare("SELECT * FROM users WHERE email = ?");
		$result->execute(array($email));
		$result = $result->fetchAll();

		if (!empty($result))
		{
			$return = 'already exists';
		}
		else
		{


			$rep = $dbh->prepare("INSERT INTO users (username, email, hash, password) VALUES(?, ?, ?, ?)");
			if (!$rep->execute(array($name, $email, $hash, $password))) {
			   echo "\nPDO::errorInfo():\n";
			   print_r($dbh->errorInfo());
			   die();
			}
				$return = "Confirmation link has been sent to $email, please verify 
				your account by clicking on the link in the message.";



				$headers  = 'MIME-Version: 1.0' . "\r\n";
			    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			    $headers .= "To: $name <$email>" . "\r\n";
			    $headers .= 'From: David <david@camagru.staff43.fr>' . "\r\n";
				$to = $email;
				$subject = 'Account Verification (Camagru)';

				$message_body = "
				     <html>
				      <head>
				       <title>Calendrier des anniversaires pour Août</title>
				      </head>
				      <body>
				       Hello $name,
						Thank you for signing up!
						Please click this link to active your account:
						<a href='$siteurl/verify_email.php?email=$email&hash=$hash'>Valider</a>
				      </body>
				     </html>
				     ";
				mail($to, $subject, $message_body, $headers);
			}
		}
	}
?>