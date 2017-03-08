<?php
session_start();
require 'global.php';
require_once 'process/register.php';
require_once 'process/login.php';
require_once 'verify_email.php';
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="css/login-register.css">
</head>
<body>
<div class='header'></div>
<?php 
			if (isset($_SESSION['message']))
				echo $_SESSION['message'];
			if (isset($return)) echo $return; 
			?>
  <div class="login-page">
    <div class="form">
      <form action="index.php" method="POST" autocomplete="off">
          <input type="email" id="email" name="email" placeholder="Email.."/>
          <input type="username" id="username" name="username" placeholder="Username.." />
          <input type="password" id="password" name="password"  placeholder="Password.."/>
          <input type="password" name="password2" placeholder="Confirm password.." required/>
        <button type="submit" name="signup">Register</a></button>
      </form>
    </div>
  </div>
</body>
</html>