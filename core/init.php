<?php
#starting the users session
session_start();
require 'connect/database.php';
require 'classes/users.php';
require 'classes/general.php';
require 'classes/posts.php';

$users			= new Users($db);
$general		= new General();
$posts			= new Posts($db);

$errors			= array();

?>
