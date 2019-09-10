<?php
try
 {
  $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;charset=utf8', 'root', 'pass1234');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
  die($e->getMessage());
 }

function auth($login, $passwd)
{

  if (!$login || !$passwd)
  {
    return false;
  }
  $account = $pdo->query('SELECT username, password FROM users');

    while ($users = $account->fetch()) {
      if ($users['password'] == $passwd && $users['username'] == $login) {
        return true;
      }
    }


  return false;
}
 ?>
