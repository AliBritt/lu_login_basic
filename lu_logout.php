<?php #lu_logout.php

	//access the session
	session_start();

	//if no session is present redirect the user
	if(!isset($_SESSION['user_id'])){
		//get the functions
		require('includes/lu_login_functions.inc.php');
		redirect_user('lu_login.php');
	}
	else{
		//cancel session
		$_SESSION = array(); //setting SESSION to empty array resets SESSION
		session_destroy(); // removes data from server.does not unset global variables
		setcookie('PHPSESSID', '', time()-3600,'/','', 0, 0);//destroys cookie.
		//PHPSESSID is the session ID parameter passed in a cookie. not sure about the rest of parameters except time???
		
	}
	//page title
	$page_title = 'Logged out'; //have i set this variable???
	
	//print message
	echo "<h1>Logged out</h1>
	<p>You are now logged out</p>";
?>
<!--add content + style-->
<html>
	<head>
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

	</head>
</html>