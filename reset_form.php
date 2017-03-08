<?php
require 'global.php';
session_start();

echo "RESET FORM"

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Reset Password</title>
	</head>
		<body>
			<div>
				<h1>Choose Your New Password</h1>
				<form action="reset_form.php" method="post" autocomplete="off">
					<div class="field">
						<label>
							<span>Password</span>
						</label>
						<input type="password" name="password" required/>
					</div>
					<div class="field">
						<label>
							<span>Confirm Password</span>
						</label>
						<input type="password" name="password2" required/>
					</div>
					<button name="confirmer">Envoyer</button>
				</form>
			</div>
		</body>
</html>