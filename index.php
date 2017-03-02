<?php
require 'global.php';
require_once 'process/register.php';
?>

<!DOCTYPE html>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="index.css">
		<title>Camagru</title>
	</head>
	<body>
	<header>
		<?php if (isset($return)) echo $return; ?>
		<div class="form">
			<div class="login">
				<h1>Login</h1>
				<form action="index.php" method="post" autocomplete="off">
					<div class="field">
						<label>
							<span>Username</span>
						</label>
						<input type="username" name="username"/>
					</div>					
					<div class="field">
						<label>
							<span>Password</span>
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
							<span>Username</span>
						</label>
						<input type="username" name="username"/>
					</div>
					<div class="field">
						<label>
							<span>Email</span>
						</label>
						<input type="email" name="email"/>
					</div>
					<div class="field">
						<label>
							<span>Password</span>
						</label>
						<input type="password" name="pasword"/>
					</div>
					<button type="submit" name="signup">Register</button>
				</form>
			</div> <!-- signup -->

		</div> <!-- form -->
	</header>
	</body>
</html>