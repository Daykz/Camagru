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
		echo '<script type="text/javascript">alert("This email does not exist")</script>';
	}
	else//user exists
	{
		//$user = $check->fetchAll();//array with user data
		$email = $check[0]['email'];
		$hash = $check[0]['hash'];
		$name = $check[0]['username'];
  		$_SESSION['usermail'] = $email;

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
		{
			echo '<script type="text/javascript">alert("To complete your password reset, please check your email")</script>';
			//phpAlert("To complete your password reset, please check your email $email");
		}
	}
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Reset Password</title>
		<link rel="stylesheet" href="css/default.css">
  		<link rel="stylesheet" href="css/login-register.css">
	</head>
<body>
	<div class='header'>
  		<div class='margin'>
    		<a href="index.php">
    		<img alt="Home" src="img/homepage.png" width=40px; height=40px;></div></a>
  		</div>
	</div>
		<div class="wrapper">
			<div class="login-page">
				<div class="form">
					<form action="forgot.php" form class="login-form" method="post" autocomplete="off">
					<input type="email" autocomplete="off" name="email" placeholder="Email.." required>
					<button name="envoyer">Send</button>
				</form>
			</div>
		</div>
	</div>
<div class="footer"></div>
</body>
</html>