<?php
$data = $_POST;
session_start();
if (!$_SESSION[login])
{
	header('location: index.php');
	exit;
}
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
 if ($_POST['submit'])
{
	$date = date("Y-m-d H:i:s");
	$author = $_SESSION[login];
	$comment = $_POST['submit'];
	$id = $_GET['photo'];
	$reqest = "INSERT INTO `comments` (`id_photo`, `author`, `comment`, `date_com`) VALUES ('$id', '$author', '$comment','$date');";
    $pdo->prepare($reqest)->execute();
    //$reqest->closeCursor();
    $reqest = $pdo->prepare('SELECT name FROM photo WHERE id = ?');
    $reqest->execute(array($id));
    $name = $reqest->fetch();
    $mail = $pdo->prepare('SELECT email FROM users WHERE username = ?');
    $mail->execute(array($name['name']));
    $email = $mail->fetch();
  //  header("Refresh:1");
    mail($email['email'], 'New comment !!', 'yeep !! Come to Camagru and check new comments!!', 'From : admin@camag.com');
    //mail($email, 'Camagru', 'for register come here ! => http://127.0.0.1:8888/Main/aftermail.php', 'From : admin@camag.com');
      header('Location: '.$_SERVER['REQUEST_URI']);
}
?>
<!DOCTYPE html>

<head>
    <title>Comment</title>
    <link rel="stylesheet" href="style2.css">
    <style type="text/css" media="screen">
    body{
      text-align: center;
    }
    button{
      background-color: red;
    }
    #comment_input
    {
		border-radius:40px;
		margin-top: 20px;
		margin-bottom:20px;
      width: 400px;
      height: 50px;
    }
    #com_text
    {
		margin: auto;
		width: 600px;
	background-color: #323942;
	color: white;
	word-wrap: break-word;
	overflow: auto;
  }
#who
{
	border-bottom: 1px solid white;
	border-top: 1px solid white;
	padding-bottom: 5px;
	padding-top: 5px;
}
h2
{
	margin: 40px auto ;
	width: 500px;
	font-size: 35px;
	border: 4px solid white;
}

    </style>
</head>
    <!-- the header -->
  <?php require_once('header.php'); ?>
  <body>
    <?php
    $reqest = $pdo->prepare('SELECT id, photo_path, name FROM photo WHERE id = ?');
    $reqest->execute(array($_GET['photo']));
    $data = $reqest->fetch();
     ?>
		 <?php
		 if ($login == $data['name']) {
			 echo '<button id="delbutton" type="button" name="del">DELETE</button>';
		 }
			?>
			<script type="text/javascript">
				var delbut = document.getElementById('delbutton');
				delbut.addEventListener('click', () =>
				{
					if (confirm("You sure you want to delete?"))
					{
						var xhr = new XMLHttpRequest();
						var link = "<?php echo $data['photo_path']; ?>";
						console.log(link);
	    		xhr.open("POST", "delPhoto.php", true);
	    		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	    		xhr.send("img=" + link);
					}
					window.location.href = 'my_photos.php';
			  });
			</script>
    <div id="photo_box">

      <img src="<?php echo htmlspecialchars($data['photo_path']); ?>" width="600" height="500"/>
      <form action="comment.php?photo=<?php echo $_GET['photo']; ?>" method="POST">
				<input id="comment_input" name="submit" type="text" value="" placeholder="
				                                               ENTER YOUR COMMENT"/>

			</form>
    </div>
    <div id="com_text">
			<h2>COMMENTS</h2>
		<?php
		$reqest->closeCursor();
		$reqest = $pdo->prepare('SELECT author, comment, date_com FROM comments WHERE id_photo = ? ORDER BY date_com');
		$reqest->execute(array($_GET['photo']));
		while ($data = $reqest->fetch())
		{
		?>
			<p id="who"><strong><?php echo htmlspecialchars($data['author']); ?> <?php echo $data['date_com']; ?></p>
			<p><?php echo nl2br(htmlspecialchars($data['comment'])); ?></p>
		<?php
		}
		$reponse->closeCursor();
		?>
		</div>
  </body>
    <!-- the footer -->
  <?php require_once('footer.php'); ?>

</body>
</html>