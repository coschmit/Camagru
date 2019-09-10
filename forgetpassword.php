<?php $data = $_POST; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Forget Pass</title>
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
    height: 200px;
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
  <a href="index.php"><h1>Forget Password</h1></a>
  </header>
  <body>
    <form  action="forgetpassword.php" method="POST">

        <div id="forma">

          <label for="email">Email</label>
          <br>
          <input type="text" name="email" id="email" placeholder="yourname@gmail.com" required value="<?php echo @$data['email']; ?>">
          <br>

          <button id="button" type="submit" name="submit" >Reset password</button>
          <div id="errorMessage">
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
             //chek if email exist
             function checkMAIL($account, $email)
             {
               while ($users = $account->fetch()) {
                 if ($users['email'] == $email) {
                   return true;
                 }
               }
               return false;
             }
               //generate security password for reseting it
             function generateRandomString($length = 10) {
               $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
               $charactersLength = strlen($characters);
               $randomString = '';
               for ($i = 0; $i < $length; $i++) {
                 $randomString .= $characters[rand(0, $charactersLength - 1)];
               }
               return $randomString;
               }

             $errors = array();
             if (isset($data['submit'])) {
               $account = $pdo->query('SELECT email FROM users');
               if (!checkMAIL($account, $data['email'])) {
                 $errors[] = "Email is not valid";
               }
               if (empty($errors)) {
                 //run
                 $email = $data['email'];
                 //new pass1234


                 $string = generateRandomString();
                  // echo $string;
                 $reqest = "UPDATE `users` SET `password` = '$string' WHERE `users`.`email` = '$email';";

                 $pdo->prepare($reqest)->execute();

                 echo "Link was sented on entered email=)";

                 mail($email, 'Camagru', 'For reseting password CLICK HERE! => http://localhost:3306/resetpassword.php
                 Use This code:'.$string, 'From : admin@camag.com');
                //  mail($email, 'Camagru', 'for register come here ! => http://127.0.0.1:8888/Main/aftermail.php', 'From : admin@camag.com');
                  echo "<br>You will be redirected to another page in 10 seconds";
                  header("refresh:10;resetpassword.php");
                 //exit;
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
