<?php

$dir = dirname(__DIR__);

require_once $dir.'/classes/User.class.php';
require_once $dir.'/classes/DB.class.php';
require_once $dir.'/classes/Portfolio.class.php';
require_once $dir.'/classes/Album.class.php';
require_once $dir.'/classes/MailTools.class.php';
require_once $dir.'/classes/Category.class.php';
require_once $dir.'/classes/MyTools.class.php';

//connect to the database
$db = new DB();
$db->connect();

//initialize UserTools object
$UserTools = new UserTools();

//start the session
session_start();

//refresh session variables if logged in
if(isset($_SESSION['logged_in'])) {
	$user = unserialize($_SESSION['user']);
	$_SESSION['user'] = serialize($UserTools->get($user->id));
}
?>