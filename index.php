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
      *{
        background-color: black;
      }
      
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
        top:50px;
        margin-bottom: 50px;
        border: 1px red solid;
        padding-bottom: 50px;
        position:relative;
      }
      span{
        color: white;
        background-color: #3d3d3d;
        font-style: italic;
        font-size: 150%;
      }
      #menu{
        width: 984px;
        height: 1500px;
        margin:  auto;
        padding-top:70px;
        text-align: center;
      }
      .button{
        transition: 0.2s;
        width: 150px;
        border-radius:10px;
        height: 50px;
        margin-top: 15px;
        background-color: #3d3d3d;
      }
      .button:hover{
        transition: 0.2s;
        cursor: pointer;
        box-shadow: 0 0px 13px 6px rgb(53, 41, 119);
        background: #b8b8b8;
        color: black;
      }
      #menu-content{
        margin-top: 100px;
      }
    </style>
  </head>
  
  <body>
    <div id="mainp">
      <img id="no" src="img/no-circle.png">
    </div>
    <div id="menu">
      <div id="menu-content">
    <p>Take the better selfie</p>
    <button class="button" type="button" name="button" onclick="location.href='login.php'"><span>Log in</span></button>
    <br>
    <button style="margin-right:4px"class="button" type="button" name="button" onclick="location.href='signup.php'"><span>Register</span></button>
      </div>
    </div>
  </body>
</html>