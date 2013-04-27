<?php //activate.php
	//this page activates the users account
	require('lu_includes/config.inc.php');
	require('lu_includes/password.php');
	
	//if $x/$y don't exist/are in wrong format re-direct user
	if (isset($_GET['x'], $_GET['y']) && filter_var($_GET['x'], FILTER_VALIDATE_EMAIL) && strlen($_GET['y'])== 60){
		//sanitize
		$e = filter_var($_GET['x'], FILTER_SANITIZE_EMAIL);
		$a = filter_var($_GET['y'], FILTER_SANITIZE_MAGIC_QUOTES);
		//prepped statement to activate user if email and activation code match db
		require(MYSQL);
		$q = 'UPDATE logoninfo SET active = NULL WHERE email = ? AND active = ? LIMIT 1';
		$stmt = mysqli_stmt_init($dbc);
		mysqli_stmt_prepare($stmt, $q);
		mysqli_stmt_bind_param($stmt, 'ss', $e, $a);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_affected_rows($stmt) == 1){
			echo "<p>Your account has been activated. You may now login.</p>";
		}
		else{
			echo "<p>Your account could not be activated. Please re-check the link or contact the administrator</p>";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
	}
	else{
		//redirect
		$url = BASE_URL . 'lu_registration';
		//delete the last data put into buffer. why?
		ob_end_clean();
		header("Location: $url");
		//quit the script
		exit();
	}

?>

<html>
	<head>
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

	</head>
</html>