<?php
require 'core/init.php';
$general->logged_in_protect();
?>

    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" >
    <title>Login and registration</title>
    </head>
    <body>	
    <div id="container">
    <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="register.php">Register</a></li>
    <li><a href="login.php">Login</a></li>
    </ul>
    <h1>Welcome to our site!</h1>
    </div>
    </body>
    </html>