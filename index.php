<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Camagru</title>
	</head>
<?php
/*
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['login']))
		{
			require 'login.php';
		}
		if (isset($_POST['signup']))
		{
			require 'register.php';
		}
	}
	*/
?>
<?php
	try
	{
		$dbh = new PDO('mysql:host=localhost;dbname=accounts', "root", "root");
	}
	catch (exception $ex)
	{
		die('Erreur connection PDO : '.$ex->getMessage());
	}
?>
	<body>
		
		<div class="form">
			<div class="login">
				<h1>Login</h1>
				<form action="index.php" method="post" autocomplete="off">
					<div class="field">
						<label>
							Username<span>*</span>
						</label>
						<input type="username" name="username"/>
					</div>					
					<div class="field">
						<label>
							Password<span>*</span>
						</label>
						<input type="password" name="pasword"/>
					</div>
					<p><a href="forgot.php">Forgot Password?</a></p>
					<button name="login">Log In</button>
				</form>
			</div> <!-- login -->

			<div class="signup">
				<h1>Sign Up</h1>
				<form action="index.php" method="post" autocomplete="off">
					<div class="field">
						<label>
							Username<span>*</span>
						</label>
						<input type="username" name="username"/>
					</div>
					<div class="field">
						<label>
							Email<span>*</span>
						</label>
						<input type="email" name="email"/>
					</div>
					<div class="field">
						<label>
							Set a password<span>*</span>
						</label>
						<input type="password" name="pasword"/>
					</div>
					<button type="submit" name="signup">Register</button>
				</form>
			</div> <!-- signup -->

		</div> <!-- form -->
	</body>
</html>