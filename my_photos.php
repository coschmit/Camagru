<?php
$data = $_POST;
session_start();
if (!$_SESSION[login])
{
	header('location: index.php');
	exit;
}
?>
<?php
try
 {
  $pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru;', 'root', 'pass');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
  die($e->getMessage());
 }
?>
<!DOCTYPE html>

<head>
    <title>MY Galery</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link href="gal.css" type="text/css" rel="stylesheet">
    <style type="text/css" media="screen">
    #gal{
    	text-align: center;
    }
		/* footer{
			position:absolute;
			bottom: 0;
		} */
    		</style>
    </head>
        <!-- the header -->
        <?php require_once('header.php'); ?>
      <body>
    		<div id="gal">
          <?php
          $login = $_SESSION[login];
           $photo_on_page = 5;
           $num_all_photo = $pdo->query('SELECT COUNT(*) AS total FROM photo');
           $data_all_photo = $num_all_photo->fetch();
           $total = $data_all_photo['total'];
           $pages_number = ceil($total/$photo_on_page);
               if (isset($_GET['page']))
                {
        	         $page = intval($_GET['page']);
        	          if ($page > $pages_number)
        		          $page = $pages_number;
                }
                else
        	       $page = 1;
              $first_val = ($page - 1) * $photo_on_page;
              $request = $pdo->query("SELECT * FROM photo WHERE name = '$login' ORDER BY photo_date DESC LIMIT $first_val, $photo_on_page");
              while ($data = $request->fetch()) {
           ?>
           <div id="gal_gal">
    		<div id="com">
    			<img src="<?php echo htmlspecialchars($data['photo_path']); ?>" width="320" height="240"/>
          <br>

    				<a href="comment.php?photo=<?php echo $data['id']; ?>" id="button_coment">Comment</a>

    			</div>
    		</div>
    	</div>
                <?php
    }
                    echo '<p id="pageact" align="center">Page : ';
                    for ($i = 1; $i <= $pages_number; $i++)
                    {
                	     if ($i == $page)
                		     echo ' [ '.$i.' ] ';
                	        else
                		        echo '<a id="numb_page" href="my_photos.php?page='.$i.'"> '.$i.' </a>';
                          }
                  echo '</p>';
                  $request->closeCursor();
                ?>

      </body>
    <!-- the footer -->
  <?php require_once('footer.php'); ?>

</body>
</html>