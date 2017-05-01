<?php
session_start();
  $comment = $_POST['commentaire'];
  $photoPath = $_POST['photoPath'];
  $user = $_SESSION['username'];

try
  {
    $dbh = new PDO("mysql:host=localhost;dbname=camagruDB", "root", "root");
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  }
  catch (exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

	$sql = $dbh->prepare("SELECT path, owner FROM photos ORDER BY id DESC");
    $sql->execute();
    $photos = $sql->fetchAll();

  $sql = $dbh->prepare("SELECT email FROM user WHERE username = $photos[owner]");
  $sql->execute();
  $data = $sql->fetch();


  if (isset($comment) && !empty($comment))
  {
    $rep = $dbh->prepare("INSERT INTO comments (photo, user, comment) VALUES(?, ?, ?)");
  if (!$rep->execute(array($photoPath, $user, $comment)))
  {
    echo "\nPDO::errorInfo():\n";
    print_r($rep->errorInfo());
    die();
  }
        $owner = $photos[0][owner];
        $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= "To: $name <Camagru>" . "\r\n";
          $headers .= 'From: Yassinofski <Yassinofski@student.43.fr>' . "\r\n";
        $to = "daykzmathe@gmail.com";
        $subject = 'You have a new comment';
        $message_body = "
             <html>
              <head>
               <title>Camagru</title>
              </head>
              <body>
               Hello $owner,<br>
            You have a new comment from $user:<br>
            <p>
            $comment
            </p>
              </body>
             </html>
             ";
        mail($to, $subject, $message_body, $headers);
}
unset($_POST['commentaire']);
header("Location: gallery.php");
 ?>