<?php // lu_forgot_pass.php
	require('lu_includes/config.inc.php');
	require('lu_includes/password.php');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require(MYSQL);
		//define user id variable and set to false
		$uid = FALSE;
		//validate email
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$e = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			//check for record of email 
			$q = 'SELECT user_id FROM logoninfo WHERE email = ?';
			$stmt = mysqli_stmt_init($dbc);
			mysqli_stmt_prepare($stmt, $q);
			mysqli_stmt_bind_param($stmt, 's', $e);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id);
			
			if(mysqli_stmt_fetch($stmt)){
				$uid = $id;
			}
			else{
				echo '<p> The email address provided does not match those on file</p>';
			}
			mysqli_stmt_close($stmt);
		}
		else{
			echo '<p> Please provide a vailid email address.</p>';
		}
	
	
		if ($uid){
			//create a random 10 char password
			$p = substr(password_hash(uniqid(rand(), true), PASSWORD_BCRYPT), 10, 20);
			//pass hash the random password
			$ph = password_hash($p, PASSWORD_BCRYPT);
			// update db with new pass
			$q = "UPDATE logoninfo SET pass = ? WHERE user_id = ? LIMIT 1";
			$stmt = mysqli_stmt_init($dbc);
			mysqli_stmt_prepare($stmt, $q);
			mysqli_stmt_bind_param($stmt, 'ss', $ph , $uid);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_affected_rows($stmt)== 1){
				//send email
				$body = "Your password has been temporarily changed to '$p'. 
				Please log in using this password and this email. You can then change your password to something more familiar.";
				
				mail($e, 'Your temporary password', $body, 'From:Admin@Whatever.com'); 
				//print message(with email included as i dont have mail set up)
				echo $body . '<p>Your password has been changed. You will recieve the new temporary password at the email address which you registered. 
				Once you have logged in you may change you password by clicking the "change password" link.</p>';
			}
			else{
				echo '<p>Your password could not be changed due too a system error. Please try again</p>';
			}
			mysqli_stmt_close();
		}
		else{//nessessary?
			echo 'Please try again';
		}
		
		mysqli_close();
	}//end of main conditional
	
	
	include 'lu_includes/lu_forgot_pass.inc.php';
?>