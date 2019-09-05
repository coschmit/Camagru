<?php
$data = $_POST;
 ?>
<!DOCTYPE html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <header id="header">
   <a href="index.php"> <h1>Register</h1></a>
  </header>
  <body>
<form  action="signup.php" method="POST">

    <div id="forma">
      <label for="username">Username</label>
      <br>
      <input type="text" name="username"  id="username" placeholder="your login" required value="<?php echo @$data['username']; ?>">
      <br>
      <label for="email">Email</label>
      <br>
      <input type="text" name="email" id="email" placeholder="yourname@gmail.com" required  value="<?php echo @$data['email']; ?>">
      <br>
      <label for="password">Password</label>
      <br>
      <input type="password" name="password" id="password" required placeholder="must be strong" >
      <br>
      <label for="re-password">Confirm Password</label>
      <br>
      <input type="password" name="re_password" id="re_password" required placeholder="must be strong">
      <br>
      <button id="Create-acc" type="submit" name="submit">Create Account</button>
      <div id="errorMessage">
        <?PHP
        session_start();
        function EmailValid($value)
        {
          $reg = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
          $a = preg_match($reg,$value);
          return($a);
        }
        function ValidPassword($value)
        {
          $reg = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
          return (preg_match($reg,$value));
        }
        //require_once 'config/setup.php';
        try
         {
          $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;', 'root', 'pass1234');
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e)
         {
          die($e->getMessage());
         }
        //chek for unic username and email
        function checkMAIL($account, $email)
        {
          while ($users = $account->fetch()) {
            if ($users['email'] == $email) {
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
        //
         if (isset($data['submit'])) {
           //register;
           $errors = array();
           if ($data['re_password'] != $data['password']) {
            $errors[] = "Password doesnt match";
           }
           if (($data['email'] != '')  && !EmailValid($data['email'])) {
             $errors[] = "Email is not valid";
           }
           if ( ($data['re_password'] == $data['password'])  &&  !ValidPassword($data['password'])) {
              $errors[] = "Password is not valid";
              $errors[] = "Use at least 6 characters";
              $errors[] = "With 1 lower, 1 uppercase and 1 number!";
           }
           $account = $pdo->query('SELECT email FROM users');
           if (checkMAIL($account, $data['email'])) {
             $errors[] = "This email already used";
           }
           $account = $pdo->query('SELECT username FROM users');
           if (checkUSERNAME($account, $data['username'])) {
             $errors[] = "This username already used";
           }
           if (empty($errors)) {
              $username = $data['username'];
              $email = $data['email'];
              $password = $data['password'];
              $password = hash('whirlpool', $password);
             //require_once 'config/conect.php';
             //register
             $reqest = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password');";
             $pdo->prepare($reqest)->execute();
             mail($email, 'Camagru', 'for register come here ! => http://127.0.0.1:8888/Main/aftermail.php', 'From : admin@camag.com');
               echo "Email with instruction was sent to your email";
               header("refresh:10;index.php");
               exit;
             //
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