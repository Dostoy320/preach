<?php

require '../core/init.php';

if ($_POST['action'] == 'register') {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$users->register($username, $password);
	echo "Registration Complete";
}

?>
<body>
	<div id="main">
		<h3>Register</h3>

		<form method="post" action="register.php" name="login_form">
		<input type="hidden" name="action" value="register">
			<h4>Username:</h4>
			<input type="text" name="username">
			<h4>Password:</h4>
			<input type="password" name="password">
			<br>
			<input type="submit" name="submit" value="register">
		</form>
	</div>
</body>
</html>
