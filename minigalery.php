

<?php
/*session_start();
try
 {
  $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;', 'root', 'pass1234');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
  die($e->getMessage());
 }
$login = $_SESSION[login];
$reqest = $bdd->query("SELECT photo_path FROM photo WHERE name='$login'");
while ($donnees = $reqest->fetch())
{
	$path = $donnees['photo_path'].'.png';
	print '<img src="'.$path.'"  width="150" height="100" /><br />';
}
?>