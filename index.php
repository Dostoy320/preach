<?php
require 'core/init.php';

if(isset($_POST['action'])) {
	$action = $_POST['action'];
} else {
	$action = 'view_main';
}

if ($action == 'view_main') {

	//Get the most recent post and display it on the main page
	$content = $posts->get_last_post();
	include('view/main.php');

} else if ($action == 'create_post') {

	//Go to text editor
	include('view/editor.php');

} else if ($action == 'submit_post') {
	if(array_key_exists('blog_text', $_POST)){
		$text = $_POST['blog_text'];
	    $posts->add_post($text);
	    $content = $posts->get_last_post();
		include('view/main.php');

 	} else {

 		//Return to editor (it was empty)
		include('view/editor.php');
	}
}
