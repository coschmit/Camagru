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
        padding-top:20px;
        text-align: center;
      }
      .button{
        transition: 0.2s;
        width: 60%;
        border-radius:10px;
        height: 50px;
        margin-top: 15px;
        background-color: #3d3d3d;
      }
      .button:hover{
        transition: 0.2s;
        cursor: pointer;
        transform: scale(1.1);
        box-shadow: 0 0px 13px 6px rgb(53, 41, 119);
        color: black;
      }
      #menu-content{
      }

      .white-text{ color: white;}

.container{
  display:flex;
  justify-content:center;
}
      h1 {
        display:flex;
        position:relative;
        justify-content: center;
        cursor: default;
        margin-top: 50px;
        border-radius:25px;
        padding: 5px 10px;
        letter-spacing: 5px;
        text-align: center;
        font-family: serif;
        transition: .75s ;
      }
      h1:hover {
        color:black;
        background-color: white;
      }
    </style>
  </head>
  
  <body>
  <div class="container">
   <h1 class="white-text">CAMAGRU</h1>
   </div>
   <div class="container">
    <div id="menu">
      <div id="menu-content">
    <p class="white-text">Take the better selfie</p>
    <button class="button" type="button" name="button" onclick="location.href='login.php'"><span>Log in</span></button>
    <br>
    <button style="margin-right:4px"class="button" type="button" name="button" onclick="location.href='signup.php'"><span>Register</span></button>
      </div>
    </div>
    </div>
  </body>
</html>