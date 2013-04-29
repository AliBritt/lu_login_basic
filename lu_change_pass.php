<?php  //lu_change_pass.php
	require 'lu_includes/config.inc.php';
	require 'lu_includes/password.php';
	//if no first name session variable exist then redirect
	//echo "<p>You are now logged in {$_SESSION['first_name']}</p>";
	session_start();
	if(!isset($_SESSION['user_id'])){
		//define url
		$url = BASE_URL . 'lu_login.php';
		//delete buffer
		ob_end_clean();
		header("Location: $url");
		exit();
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require(MYSQL);
		$p = FALSE;
		if(preg_match('/^(\w){4,20}$/', $_POST['pass1'])){
			if ($_POST['pass1'] == $_POST['pass2']){
				$p = mysqli_real_escape_string($dbc, $_POST['pass1']);
			}
			else{
				echo "<p>The passwords you've entered do not match.</p>";
			}
		}
		else{
			echo "<p>Please enter a vaild password.</p>";
		}
	
		if($p){
			$ph = password_hash($p , PASSWORD_BCRYPT);
			$uid = $_SESSION['user_id'];
			$q = "UPDATE logoninfo SET pass=? WHERE user_id=? LIMIT 1";
			$stmt = mysqli_stmt_init($dbc);
			mysqli_stmt_prepare($stmt, $q);
			mysqli_stmt_bind_param($stmt, 'ss',$ph ,$uid);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_affected_rows($stmt) == 1){
				echo "<p>Your password has been changed</p>";
			}
			else{
				echo "<p>Your password could not be changed. Make sure the password is different from your current pasword. Please try again</p>";
			}
			mysqli_stmt_close();
			mysqli_close();
		}
		else{//really nessessary?
			echo"<p>Please try again";
		}
		
	}// end of submit conditional
	include('lu_includes/lu_change_pass.inc.php');
?>