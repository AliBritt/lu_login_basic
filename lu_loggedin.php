<?php # loggedin.php The user is redirected here from login.php
	
	session_start();
	//if no session..
	if(!isset($_SESSION['user_id'])){
		//need the functions from..
		require('lu_includes/lu_login_functions.inc.php');
		//redirect to main page
		redirect_user('lu_login.php');//fix this later
		
	}
	
	//set page title (do i have this set up???)
	$page_title = 'Logged in!';
	
	//print message
	echo "<h1>Logged in</h1>
	<p>You are now logged in {$_SESSION['first_name']}</p>
	<p><a href=\"lu_logout.php\">Logout</a></p>";
		/*
	echo "$errors @ login :";
	echo count($errors) . " entrie(s) in error array. <br>";*/
	/*foreach ($_SESSION as $i=>$j){
		echo $i . $j . "<br>";
	}*/
	
	//add content + style. this is homepage.

?>
<html>
	<head>
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		
	</head>
</html>