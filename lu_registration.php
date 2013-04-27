<?php
	require('lu_includes/config.inc.php');
	require('lu_includes/password.php');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		//handle the form
		
		require(MYSQL);
		//trim incoming data(space,return,tab,new line ,NULL)and set to an array
		$trimmed = array_map('trim', $_POST);
		//set user variables to FALSE
		$fn = $ln = $e = $p = FALSE;
		//check first name for chars
		if(preg_match('/^[a-z \'.-]{2,20}$/i', $trimmed['first_name'])){
			//sanitize- escape " ' " . 
			$fn = filter_var($trimmed['first_name'], FILTER_SANITIZE_MAGIC_QUOTES);
		}
		else{
			echo "<p>Please enter your first name!</p>";
		}
		//check last name for chars
		if(preg_match('/^[a-z \'.-]{2,40}$/i', $trimmed['last_name'])){
			//sanitize
			$ln = filter_var($trimmed['last_name'], FILTER_SANITIZE_MAGIC_QUOTES);
		}
		else{
			echo "<p>Please enter your last name!</p>";
		}
		//email
		if(filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)){
			$e = filter_var($trimmed['email'], FILTER_SANITIZE_EMAIL);
		}
		else{
			echo "<p>Please enter a valid email address</p>";
		}
		//password
		if(preg_match('/^\w{4,20}$/', $trimmed['pass1'])){
			if($trimmed['pass1'] == $trimmed['pass2']){
				$p = $trimmed['pass1'];//why use my_real_escape_string here?( \x00, \n, \r, \, ', " and \x1a are all dealt with by preg_match)
			}
			else{
				echo "<p>Your passwords do not match</p>";
			}
		}
		else{
			echo"<p>Please enter a valid password</p>";
		}
		
		if($fn && $ln && $e && $p){
			//check if email is taken - retrive user_id for existing email
			$q = "SELECT user_id FROM logoninfo WHERE email = ? ";
			//initailise statment - return statement object?
			$stmt = mysqli_stmt_init($dbc);
			//prepare statement for exe- points to query
			mysqli_stmt_prepare($stmt, $q);
			//bind variables
			mysqli_stmt_bind_param($stmt, 's', $e);
			//run query
			mysqli_stmt_execute($stmt);
			//bind results do i need this???????????????????????????????????
			//mysqli_stmt_bind_result($stmt, $user_id );
			//fetch results and check if exist
			if(!mysqli_stmt_fetch($stmt)){
				mysqli_stmt_close($stmt);
				//hash the password
				$p = password_hash($p, PASSWORD_BCRYPT);
				//create the activation code- hashed string based on time in milsec with prefex of random number
				$a = password_hash(uniqid(rand(), true), PASSWORD_BCRYPT);
				//icreate insert query - using same $ as above. should be ok??????????????????????????????????????????
				$q = "INSERT INTO logoninfo (email, pass, first_name, last_name, active, registration_date) VALUES (? , ? , ? , ? , ? , NOW())";
				//initailise statment - return statement object?
				$stmt = mysqli_stmt_init($dbc); 
				//prepare statement for exe- points to query
				mysqli_stmt_prepare($stmt, $q);
				//bind variables
				mysqli_stmt_bind_param($stmt, 'sssss',$e ,$p ,$fn , $ln, $a); 
				//exe 
				mysqli_stmt_execute($stmt); 
				//could do error report here
				//if query was success..
				if(mysqli_stmt_affected_rows($stmt) == 1){
					//send email
					$body = "Thank you for registering at www.Whatevers.com. To activate your account please click the following link <br><br>\n\n";
					$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a" ;
					mail($e, 'Registration Conformation', $body, 'From: Admin@Whatevers.com');
					//i have echoed $body here as i dont have email set up
					echo "<p>Thanks for registering. A conformation email has been sent to the address you provided. <br><br>\n\n
					Please follow the link to activate your account <br>\n\n EMAIL: </p>" . $body ;
					exit();
				}
				// query was not a success
				else{
					echo '<p>You could not be registered due to a system error, Sorry</p>';
				}
			}
			//email is already on db
			else{
				echo '<p>That email address is already registered</p>';
			}
			
		mysqli_stmt_close($stmt);	
		}
		// failed verification
		else{
			echo'Please try again';
		}
	mysqli_close();
	}//end of submit conditional
	include('lu_includes/lu_register_page.inc.php');

?>