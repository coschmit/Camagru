<?php
session_start();
require_once('config/setup.php');
if ($_SESSION[login])
{
	header('location: main.php');
	exit;
}
 ?>
<!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <style type="text/css" media="screen">
      #mainp{
        width: 984px;
        height: 614px;
        margin: -8px auto;
      }
      #sn{
          position: absolute;
      }
      #no{
        width: 1000px;
        height: 700px;
        position: relative;
        top:-50px;
      }
      span{
        color: Red;
        font-style: italic;
        font-size: 150%;
      }
      #menu{
        width: 984px;
        height: 1500px;
        margin: 0 auto;
        text-align: center;
      }
      .button{
        width: 150px;
        height: 50px;
        margin-top: 15px;
        background-color: gold;
      }
      #menu-content{
        margin-top: 100px;
      }
    </style>
  </head>
  <body>
    <div id="mainp">
      <img id="sn" src="img/main.png">
      <img id="no" src="img/no-circle.png">
    </div>
    <div id="menu">
      <div id="menu-content">
    <p >Join NEW Social Network</p>
    <button class="button" type="button" name="button" onclick="location.href='login.php'"><span>Log in</span></button>
    <br>
    <button style="margin-right:4px"class="button" type="button" name="button" onclick="location.href='signup.php'"><span>Register</span></button>
      </div>
    </div>
  </body>
</html>