<?php
require 'global.php';


if (isset($_POST['confirmer']))
{
	$pass1 = password_hash($_POST['pass1'], PASSWORD_BCRYPT);
	$pass2 = password_hash($_POST['pass2'], PASSWORD_BCRYPT);

	if ($_POST['pass1'] !== $_POST['pass2'])
	{
		echo '<script type="text/javascript">alert("Password confirmation does not match")</script>';
		//$messageDerreur = "Password confirmation does not match";
	}
	else if (!preg_match('/^(?=.*\\d)(?=.*[a-z]).{8,}$/', $_POST['pass1']))
	{
		echo '<script type="text/javascript">alert("Le mot de passe doit contenir au moins une minuscule, un chiffre, et doit faire au moins 8 caractères")</script>';
	}
	else
	{
		$email = $_SESSION['usermail'];
		
		$result = $dbh->prepare("UPDATE users SET password = ? WHERE email = ?");
		$result->execute(array($pass1, $email));
		
		echo '<script type="text/javascript">alert("Votre mot de passe a été mis à jour")</script>';		

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
      		<form action="reset_form.php" method="POST" autocomplete="off">
          	<input type="password" id="password" name="pass1" placeholder="New password.." required/>
          	<input type="password" id="password" name="pass2" placeholder="Confirm password.." required/>
        	<button name="confirmer">Send</a></button>
      	</form>
    </div>
 </div>
 </div>
 <div class="footer"></div>
</body>
</html>