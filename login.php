<?php  session_start();
 $data = $_POST; ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Log-in</title>

      <style type="text/css" media="screen">
        body{
          font-family: helvetica, sans-serif;
          font-size: 150%;
          background-color: rgb(24, 24, 24);
        }
        input{
          height: 25px;
              padding: 15px;
              text-align: center;
              font-size: 25px;
              border-color: black;
              margin-top: 5px;
              border-radius: 15px;
        }
        label{
        }
        #forma{
          background-color: rgb(34, 35, 49);
    padding-top: 20px;
    width: 450px;
    height: 400px;
    border: 1px white solid;
    margin: 0 auto;
    text-align: center;
    color: white;
    transition: all 0.5s;
    border-radius: 15px;
        }

        #forma:hover{
    box-shadow: 0 5px 15px 9px rgb(53, 41, 119);
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
          color:white;
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
      color: rgb(53, 41, 119);
      }
      input:focus {
      outline-color : blue ;
      outline-width: 7px;
}

      #button {
        margin-top: 30px;
    background-color: white;
    border-radius: 40px;
    width: 150px;
    font-size: 14px;
    height: 50px;
    transition: all 0.4s
      }    

      #button:hover{
        transition: all 0.4s;
    cursor: pointer;
    background: black;
    color: white;
    height: 60px;
    width: 170px;
    font-size: 17px;
      }
      </style>
    </head>
    <header id="header">
    <a href="index.php"><h1>Login</h1></a>
    </header>
    <body>
      <form  action="login.php" method="POST">

      <div id="forma">

        <label for="username">Username</label>
        <br>
        <input type="text" name="username"  id="username" required>
        <br>
        <label for="pass1234word">pass1234word</label>
        <br>
        <input type="pass1234word" name="pass1234word" id="pass1234word" required >
        <br>
        <button id="button" type="submit" name="submit" >Login</button>
        <br>
        <a id="forget" href="forgetpass1234word.php">Forget pass1234word?</a>
    <div id="error">
      <?php
        try
         {
          $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;', 'root', 'pass1234');
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e)
         {
          die($e->getMessage());
         }
        //
        function checkpass1234WORD($account, $pass1234word)
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
        $pass1234word = $data['pass1234word'];
        $pass1234word = hash('whirlpool', $pass1234word);
        $account = $pdo->query('SELECT username FROM users');
        if ((checkUSERNAME($account, $username) == false) || $username == '') {
          $errors[] = "Username entered wrong";
        }
        $account = $pdo->query('SELECT pass1234word FROM users');
        if ((checkpass1234WORD($account, $pass1234word) == false) || $pass1234word == '') {
          $errors[] = "pass1234word entered wrong";
        }
        $account = $pdo->query('SELECT valid FROM users');
        if (!CheckVALID($account)) {
          $errors[] = "User is not activated";
        }
        if (empty($errors)) {
           echo "all good";
          $_SESSION[login] = $username;
          echo "<script>document.location.href='main.php'</script>";           exit;
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