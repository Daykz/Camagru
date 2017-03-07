<?php
require 'global.php';
//session_start();

if (isset($_POST['envoyer']))
{
	$email = ($_POST['email']);//email input
	//$check = $dbh->query("SELECT * FROM users WHERE email= '".$email."'");//check database
	
	$check = $dbh->prepare("SELECT * FROM users WHERE email = :email");
	$check->execute(array('email' => $email));
	$check = $check->fetchAll();
	
	if (empty($check))//not find
	{
		echo "This email doesn't exist";
	}
	else//user exists
	{
		//$user = $check->fetchAll();//array with user data
		$email = $check[0]['email'];
		$hash = $check[0]['hash'];
		$name = $check[0]['username'];


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "To: $name <$email>" . "\r\n";
		$headers .= 'From: Yassinofski <Yassinofski@student.43.fr>' . "\r\n";
		$to = $email;
		$subject = "Password Reset Link - Camagru";
		$message_body = "
		<html>
			      <head>
			       <title>Reset Password Camagru</title>
			      </head>
			      <body>
				       Hello $name,
						You have requested password reset!
						Please click this link to reset your password:
						<a href='$siteurl/reset_form.php?email=$email&hash=$hash'>Reset Password</a>
				      </body>
				     </html>
				     ";
		if (mail($to, $subject, $message_body, $headers))
			echo "To complete your password reset, please check your email $email";
	}
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Reset Password</title>
	</head>
		<body>
			<div>
				<h1>Reset Your Password</h1>
				<form action="forgot.php" method="post">
					<div class="field">
						<label>
							<span>Email Adress</span>
						</label>
						<input type="email" autocomplete="off" name="email" required>
					</div>
					<button name="envoyer">Envoyer</button>
				</form>
			</div>
		</body>
</html>