<!DOCTYPE html>
<html lang='en'>
<head>
	<title><?php echo $title ?></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="scripts/jquery-1.10.2.min.js"></script>
	<script src="scripts/modernizr.js"></script>
</head>
<body>
<div id='container'>
<header>
<h1><a href="index.php">Preach</a></h1>
<form action="index.php" method="post" id="test">
<ul>
	<?php
	if(empty($_SESSION['id'])) {
		echo "<li><input type='submit' name='action' value='admin login'></li>";
	}
	if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
		echo "<li><input type='submit' name='action' value='logout'></li>";
		echo "<li><input type='submit' name='action' value='create post'></li>";
	}
	?>	
</ul>
</form>
</header>