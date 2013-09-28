<?php
require 'core/init.php';
$general->logged_in_protect();

if (empty($_POST) === false) {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (empty($username) === true || empty($password) ===true) {
		$errors[] = 'We need your username and password.';
	}
	else if ($users->user_exists($username) === false) {
		$errors[] = 'That username doesn\'t exist.';
	}
	else {

		$login = $users->login($username, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that username/password is invalid.';
		}
		else {
			// username/password is correct and the login method of the $users object returns the user's id, which is stored in $login.

			$_SESSION['id'] = $login; //The user's id is now set into the user's session in the form of $_SESSION['id']

			# -------------->>>>>>Redirect the user to Logged In Welcome<<<<<<<<--------------
			header('Location: home.php');
			exit();
		}
	}
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Login</title>
</head>
<body>
	<div id="container">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
		<h1>Login</h1>

		<?php if(empty($errors) === false){

		echo '<p>' . implode('</p><p>', $errors) . '</p>';

		}
		?>
		<form method="post" action="">
			<h4>Username:</h4>
			<input type="text" name="username">
			<h4>Password:</h4>
			<input type="password" name="password">
			<br>
			<input type="submit" name="submit">
		</form>
	</div>
</body>
</html>