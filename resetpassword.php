<?php
$data = $_POST;

 ?>
<!DOCTYPE html>
  <head>
    <title>RESETING PASS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css" media="screen">
      #forma{
        padding-top: 150px;
      }
    </style>
  </head>
  <header id="header">
    <h1>Minimalism Style</h1>
  </header>
  <body>
<form  action="resetpass1234word.php" method="POST">

    <div id="forma">
      <label for="pass1234word">SECURITY CODE</label>
      <br>
      <input type="text" name="code" id="code" required placeholder="insert code">
      <br>
      <label for="pass1234word">NEW Password</label>
      <br>
      <input type="pass1234word" name="pass1234word" id="pass1234word" required placeholder="must be strong">
      <br>
      <label for="re-pass1234word">Confirm Password</label>
      <br>
      <input type="pass1234word" name="re_pass1234word" id="re_pass1234word" required placeholder="must be strong">
      <br>
      <button id="Create-acc" type="submit" name="submit" >Reset Password</button>
      <div id="errorMessage">
        <?php
          session_start();
          //check pass1234
          function ValidPassword($value)
          {
            $reg = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
            return (preg_match($reg,$value));
          }
          //check for right security code
          function checkCODE($account, $code)
          {
            while ($users = $account->fetch()) {
              if ($users['pass1234word'] == $code) {
                return true;
              }
            }
            return false;
          }
          //connet to db
          try
           {
            $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;charset=utf8', 'root', 'pass1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           catch(PDOException $e)
           {
            die($e->getMessage());
          }


           //magic

            $errors = array();
           if (isset($data['submit'])) {
             if (($data['re_pass1234word'] != $data['pass1234word'])) {
                $errors[] = "Password doesnt match";
             }
             if (!ValidPassword($data['pass1234word'])) {
                $errors[] = "Password is not valid";
                $errors[] = "Use at least 6 characters";
                $errors[] = "With 1 lower, 1 uppercase and 1 number!";
             }

             $account = $pdo->query('SELECT pass1234word FROM users');
             if (!checkCODE($account, $data['code'])) {
               $errors[] = "Wrong Security Code";
             }

             if (empty($errors)) {
               $code = $data['code'];
               echo "Password Apdated";
               //
               $pass1234word = hash('md5', $data['pass1234word']);
               $reqest = "UPDATE `users` SET `pass1234word` = '$pass1234word' WHERE `users`.`pass1234word` = '$code';";
               $pdo->prepare($reqest)->execute();
               
               header("Location: login.php");
               exit();

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
