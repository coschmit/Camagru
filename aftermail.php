<?php   $data = $_POST; ?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Log-in</title>

    <style type="text/css" media="screen">
      body{
        font-family: helvetica, sans-serif;
        font-size: 150%;
      }
      input{
        height: 25px;
        padding: 5px;
        font-size: 25px;
        border-color: black;
        margin-top: 15px;
        margin-bottom: 15px;
      }
      label{

      }
      #forma{
        width: 500px;
        height: 500px;

        margin: 0 auto;
        text-align: center;
      }
      #content{
        margin-top: 125px;
      }
      #header{
        text-align: center;
      }
      #button{
        font-size: 150%;
        background-color: gold;
        margin-top: 50px;
      }
      #error{
        color: red;
        margin-top: 15px;
      }
      H1 {
  display: inline-block;
  position: relative;
  letter-spacing: .05em;
  font-size: 50px;
  cursor: pointer;
  color: white;
  transition: all 1s;
  }


  H1:hover {
    color: Gold;
    }

    </style>
  </head>
  <header id="header">
    <h1>Minimalism Style</h1>
  </header>
  <body>
    <form  action="aftermail.php" method="POST">

        <div id="forma">
          <p>PLEASE REENTER INFO TO FINISH REGISTRATION</p>
          <label for="username">Username</label>
          <br>
          <input type="text" name="username"  id="username" required>
          <br>

          <label for="pass1234word">Password</label>
          <br>
          <input type="pass1234word" name="pass1234word" id="pass1234word" required >

          <button id="button" type="submit" name="submit" >Create Account</button>
      <div id="error">
        <?php
        session_start();

          //conect to database
          try
           {
            $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;charset=utf8', 'root', 'pass1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           catch(PDOException $e)
           {
            die($e->getMessage());
           }
          //

          function checkPASSWORD($account, $pass1234word)
          {
            while ($users = $account->fetch()) {
              if ($users['pass1234word'] == $pass1234word) {
                return true;
              }
            }
            return false;
          }

          function checkUSERNAME($account, $username)
          {
            while ($users = $account->fetch()) {

              if ($users['username'] == $username) {
                return true;
              }
            }
            return false;
          }
            $errors = array();
        if (isset($data['submit'])) {
          $username = $data['username'];

          $pass1234word = $data['pass1234word'];

          $pass1234word = hash('md5', $pass1234word);

          $account = $pdo->query('SELECT username FROM users');
          if ((checkUSERNAME($account, $username) == false) || $username == '') {
            $errors[] = "Username entered wrong";
          }

          $account = $pdo->query('SELECT pass1234word FROM users');
          if ((checkPASSWORD($account, $pass1234word) == false) || $pass1234word == '') {
            $errors[] = "pass1234word entered wrong";
          }


          if (empty($errors)) {
            //register
            echo "Registration finished";
             $reqest = "UPDATE `users` SET `valid` = '1' WHERE `users`.`username` = '$username';";
             $pdo->prepare($reqest)->execute();
           header("refresh:3;index.php");
            exit;
          }
          else
          { $i = 0;
            while ($errors[$i]) {
                echo "<span>&#9654</span>".$errors[$i]."<span>&#9664</span>"."<br>";
                $i++;
            }
          }
          }


         ?>
      </div>
    </div>
</form>
  </body>
</html>
