<?php $data = $_POST; ?>
  <!DOCTYPE html>
  <html>
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
          height: 600px;
          margin: 0 auto;
          text-align: center;
        }
        #content{
          margin-top: 125px;
        }
        #error{
          color: red;
          margin-top: 55px;
        }
        #header{
          text-align: center;
        }
        #button{
          font-size: 150%;
          background-color: gold;
          margin-top: 50px;
        }
        #forget{
          position: relative;
          bottom: -50px;
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
      <form  action="login.php" method="POST">

      <div id="forma">

        <label for="username">Username</label>
        <br>
        <input type="text" name="username"  id="username" required>
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="password" required >
        <br>
        <button id="button" type="submit" name="submit" >Login</button>
        <br>
        <a id="forget" href="forgetpassword.php">Forget Password?</a>
    <div id="error">
      <?php
 session_start();
        //conect to database
        try
         {
          $pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru;', 'root', 'pass');
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e)
         {
          die($e->getMessage());
         }
        //
        function checkPASSWORD($account, $password)
        {
          while ($users = $account->fetch()) {
            if ($users['password'] == $password) {
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
        // if user was activated thru email or no
        function CheckVALID($account)
        {
          while ($users = $account->fetch()) {
            if ($users['valid'] == 1) {
              return true;
            }
          }
          return false;
        }
          $errors = array();
      if (isset($data['submit'])) {
        $username = $data['username'];
        $password = $data['password'];
        $password = hash('md5', $password);
        $account = $pdo->query('SELECT username FROM users');
        if ((checkUSERNAME($account, $username) == false) || $username == '') {
          $errors[] = "Username entered wrong";
        }
        $account = $pdo->query('SELECT password FROM users');
        if ((checkPASSWORD($account, $password) == false) || $password == '') {
          $errors[] = "password entered wrong";
        }
        $account = $pdo->query('SELECT valid FROM users');
        if (!CheckVALID($account)) {
          $errors[] = "User is not activated";
        }
        if (empty($errors)) {
           echo "all good";
          $_SESSION[login] = $username;
          header("Location: main.php");
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


</form>