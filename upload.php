<?php

require 'global.php';


$photo = $_POST[photo];
$user = $_SESSION['username'];



$name = htmlspecialchars($_POST[titre]);
$sticker = (int)$_POST[sticker];



$i = 1;

list($type, $data) = explode(';', $photo);
list(, $data) = explode(',', $data);

$data = str_replace(' ', '+', $data);
$data = base64_decode($data);

if (!file_exists("img_database/".$user))
	mkdir("img_database/".$user);
while (file_exists("img_database/".$user."/".$name.$i.".png"))
	$i++;
$name = $name.$i;

file_put_contents("img_database/".$user."/".$name.".png", $data);

try
{
	$bdd = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
  	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (exception $e)
{
  	die('Erreur : ' . $e->getMessage());
}

$sql = $bdd->prepare("SELECT path FROM stickers WHERE id = $sticker");
$sql->execute();
$sticky = $sql->fetch();

$source = imagecreatefrompng($sticky[0]);
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
imagealphablending($source, true);
imagesavealpha($source, true);

$destination = imagecreatefrompng("img_database/".$user."/".$name.".png");
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

$destination_x = ($largeur_destination - $largeur_source) / 2;
$destination_y = ($hauteur_destination - $hauteur_source) / 2;

imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
imagepng($destination, "img_database/".$user."/".$name.".png");
imagedestroy($destination);
imagedestroy($source);



$sql = $bdd->prepare("INSERT INTO photos (name, owner, likes, path) VALUES(?, ?, ?, ?)");
$sql->execute(array($name, $user, "", "img_database/".$user."/".$name.".png"));
$sql->closeCursor();

?>