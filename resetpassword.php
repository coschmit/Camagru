<?php
$data = $_POST;
session_start();

 ?>
<!DOCTYPE html>
  <head>
    <title>RESETING PASS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css" media="screen">
      #forma{
        height: 380px;
        padding-top: 15px;
      }
    </style>
  </head>
  <header id="header">
  <a href="index.php"  ><h1>Reset Password</h1></a>
  </header>
  <body>
<form  action="resetpassword.php" method="POST">

    <div id="forma">
      <label for="password">SECURITY CODE</label>
      <br>
      <input type="text" name="code" id="code" required placeholder="insert code">
      <br>
      <label for="password">NEW Password</label>
      <br>
      <input type="password" name="password" id="password" required placeholder="must be strong">
      <br>
      <label for="re-password">Confirm Password</label>
      <br>
      <input type="password" name="re_password" id="re_password" required placeholder="must be strong">
      <br>
      <button id="Create-acc" type="submit" name="submit" >Reset Password</button>
      <div id="errorMessage">
        <?php
          
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
              if ($users['password'] == $code) {
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
             if (($data['re_password'] != $data['password'])) {
                $errors[] = "Password doesnt match";
             }
             if (!ValidPassword($data['password'])) {
                $errors[] = "Password is not valid";
                $errors[] = "Use at least 6 characters";
                $errors[] = "With 1 lower, 1 uppercase and 1 number!";
             }

             $account = $pdo->query('SELECT password FROM users');
             if (!checkCODE($account, $data['code'])) {
               $errors[] = "Wrong Security Code";
             }

             if (empty($errors)) {
               $code = $data['code'];
               echo "Password Apdated";
               //
               $password = hash('whirlpool', $data['password']);
               $reqest = "UPDATE `users` SET `password` = '$password' WHERE `users`.`password` = '$code';";
               $pdo->prepare($reqest)->execute();
               
               echo "<script>setTimeout(function(){document.location.href='login.php';},5000)</script>"; 
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
