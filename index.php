<?php
require 'core/init.php';

if(isset($_POST['action'])) {
	$action = $_POST['action'];
} else {
	$action = 'view_main';
}

if ($action == 'admin login') {
	$title = "Login Page";
	include('view/login.php');

} else if ($action == 'login_attempt') {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$title = "Login Page";

	if (empty($username) === true || empty($password) ===true) {
		$errors[] = 'We need your username and password.';
		include('view/login.php');
	}
	else if ($users->user_exists($username) === false) {
		$errors[] = 'That username doesn\'t exist.';
		include('view/login.php');
	}
	else {

		$login = $users->login($username, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that username/password is invalid.';
			include('view/login.php');
		}
		else {
			// username/password is correct and the login method of the $users object returns the user's id, which is stored in $login.

			$_SESSION['id'] = $login; //The user's id is now set into the user's session in the form of $_SESSION['id']

			# -------------->>>>>>Redirect the user to Logged In Welcome<<<<<<<<--------------
			header('Location: index.php');
			exit();
		}
	}

} else if ($action == 'logout') {
	include('view/logout.php');

} else if ($action == 'view_main') {

	//Get the most recent post and display it on the main page
	$title = "Preach Blog";
	$content = $posts->get_last_post();
	include('view/main.php');

} else if ($action == 'create post') {
	//get title and text from saves table to fill editor fields:
	$content = $posts->get_saved_post();
	//Go to text editor
	$title = "Editor";
	include('view/editor.php');

} else if ($action == 'save post') {
	$title = $_POST['blog_title'];
	$text = $_POST['blog_text'];
	$posts->save_post($title, $text);

	$reply = $_REQUEST['est'];
	echo $reply;

} else if ($action == 'submit post') {
	if(array_key_exists('blog_text', $_POST)){
		$title = $_POST['blog_title'];
		$text = $_POST['blog_text'];
	    $posts->add_post($title, $text);
	    //empty title and text variables before updating saves table
	    $title = "";
	    $text = "";
	    $posts->save_post($title, $text);
	    //save table cleared, get last post and display it on the main page
	    $content = $posts->get_last_post();
		include('view/main.php');

 	} else {

 		//Return to editor (it was empty)
 		$title = "Editor";
		include('view/editor.php');
	}
}
