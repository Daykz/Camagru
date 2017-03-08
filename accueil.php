<?php
session_start();

$username = $_SESSION['username'];
	if (!isset($_SESSION['username']))
	{
		$_SESSION['message'] = "you must be authentificated";
		// header("Location: $siteurl/index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/accueil.css">
</head>
<body>
	<a class="logout" href="logout.php">Logout</a>
	<?php echo "<h2>Bonjour $username<h2>";
	?>
	<video id="video"></video>
	<button id="startbutton">Prendre une photo</button>
	<canvas id="canvas"></canvas>
	<script type="text/javascript" src="webcam.js"></script>
</body>
</html>