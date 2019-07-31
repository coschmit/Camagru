<?php
$data = $_POST;
session_start();
if (!$_SESSION[login])
{
	header('location: index.php');
	exit;
}
?>
<!DOCTYPE html>

<head>
    <title>My Account</title>
    <link rel="stylesheet" href="style2.css">
    <style type="text/css" media="screen">
    button{
      background-color: white;
      border-color: gold;
    }
		footer{
			position: absolute;
			bottom: 0;
		}
    </style>
</head>
    <!-- the header -->
  <?php require_once('header.php'); ?>

  <body>
    <div class="">
      <?php
      $login = $_SESSION[login];
			//echo $login;
			try
			 {
				$pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru;', 'root', 'pass');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 }
			 catch(PDOException $e)
			 {
				die($e->getMessage());
			 }
      $account = $pdo->query('SELECT username,email FROM users');
      while ($users = $account->fetch()) {
				//print_r($users);
        if ($users['username'] == $login) {
          $mail = $users['email'];
        }
      }
			 //echo $login;
      // echo $_SESSION[login];
       ?>
       <form  action="myaccount.php" method="POST">
       <p style="color: white;">username:  <?php echo $login;?></p>
       <p style="color: white;">email:  <?php echo $mail;?></p>
         <p style="color: white;">new email: <input type="text" name="newemail" style="color: white;" value=""></p>
       <button type="submit" name="change">Change</button>
     </form>
     <?php
     $newemail = $data['newemail'];
     //echo $username;
  if (isset($data['change'])) {
if ($newemail != "") {
	   $reqest = "UPDATE `users` SET `email` = '$newemail' WHERE `users`.`username` = '$login';";
	    $pdo->prepare($reqest)->execute();
		}
   header("Location: myaccount.php");
}
      ?>
    </div>
  </body>
    <!-- the footer -->
  <?php require_once('footer.php'); ?>

</body>
</html>