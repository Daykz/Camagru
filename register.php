<?php
require 'global.php'

$_SESSION['email'] = $_POST['email'];
$_SESSION['username'] = $_POST['username'];

$name = $dbh->escape_string($_POST['username']);
$email = $dbh->escape_string($_POST['email']);
$password = $dbh->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $dbh->escape_string(md5(rand(0,1000)));

/* show password hash
echo $password.'<br />';
echo $hash;
die;
*/

$result = $dbh->query("SELECT * FROM users WHERE email='$email'") or die($dbh->error());
if ($result->num_rows > 0)
{
	$_SESSION['message'] = 'already exists';
	header("location: error.php");
}
else
{
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=camagruDB;charset=utf8', 'root', 'root');
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	$rep = $bdd->prepare("INSERT INTO users(username, email, hash, password) VALUES(?, ?, ?, ?)");
	$rep->execute(array($name, $email, $hash, $password));
	// $sql = "INSERT INTO users (username, email, hash, password) VALUES ('$name', '$email', '$hash', '$password')";
	// if ($rep->execute(array($name, $email, $hash, $password)))
	// {
		$_SESSION['active'] = 0;
		$_SESSION['logged_in'] = true;
		$_SESSION['message'] = "Confirmation link has been sent to $email, please verify 
		your account by clicking on the link in the message.";

		$to = $email;
		echo $to;
		$subject = 'Account Verification (Camagru)';
		$message_body = 'Hello '.name.',
		Thank you for signing up!
		Please click this link to active your account:
		localhost:8080/verify_email.php?email='.$email.'&hash='.$hash;
		mail($to, $subject, $message_body);
		// }

		 echo "Error puta";
}

?>
