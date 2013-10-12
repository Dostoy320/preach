
<?php
$general->logged_in_protect();
include 'header.php';
?>
<body>
	<div id="main">
		<h3>Login</h3>

		<?php if(empty($errors) === false){

		echo '<p>' . implode('</p><p>', $errors) . '</p>';

		}
		?>
		<form method="post" action="index.php" name="login_form">
		<input type="hidden" name="action" value="login_attempt">
			<h4>Username:</h4>
			<input type="text" name="username">
			<h4>Password:</h4>
			<input type="password" name="password">
			<br>
			<input type="submit" name="submit" value="Login">
		</form>
	</div>
</body>
</html>

<?php
include 'footer.php'
?>