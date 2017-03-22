<?php
session_start();
require 'global.php';
require_once 'process/register.php';
require_once 'process/login.php';
require_once 'verify_email.php';
?>

<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="css/login-register.css">
</head>
<body>
<div class="header"></div>
<?php 
	if (isset($_SESSION['message']))
		echo $_SESSION['message'];
		if (isset($return)) echo $return; 
?>
<div class="wrapper">
	<div class="login-page">
		<div class="form">
			<form class="login-form" method="POST" autocomplete="off">
			<input type="text" id="username" name="username" placeholder="Username.." required/>			
			<input type="password" name="password" placeholder="Password.." required/>
		 	<button type="submit" name="login">Login</a></button>
		 	<br></br>
		 	<p><a href="register_page.php">Not registered yet ?</a></p>
		 	<br></br>
		 	<p><a href="forgot.php">Forgot Password</a></p>
			</form>
		</div>
	</div>
</div>
<div class="footer"></div>
</body>
</html>