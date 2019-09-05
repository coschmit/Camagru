<?php
try
 {
  $pdo = new PDO('mysql:host=127.0.0.1;dbname=db_camagru;charset=utf8', 'root', 'pass1234');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
  die($e->getMessage());
 }

function auth($login, $pass1234wd)
{

  if (!$login || !$pass1234wd)
  {
    return false;
  }
  $account = $pdo->query('SELECT username, pass1234word FROM users');

    while ($users = $account->fetch()) {
      if ($users['pass1234word'] == $pass1234wd && $users['username'] == $login) {
        return true;
      }
    }


  return false;
}
 ?>
