<?php #login_functions.inc.php
	// define functions for login and logout
	//determine the absolute URL and redirect
	function redirect_user($page = 'index.php'){
	//define the url 
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);//do these need val/sani filters?
	//rm trailing slashes incase of existance of subfolder(?)
		$url = rtrim($url, '/\\');
	//add the page	
		$url .= '/' . $page;
	//redirect
		header("Location: $url");
		//quit script
		exit();
	}
	
	//form validation
	function check_login($dbc, $email = '' , $pass = '' ){
		
		//require('lu_includes/password.php');
		
		$errors = array(); //initialize errors array
		//validate..
		if (empty($email)){
			$errors[]='You forgot to enter your email.';
		}
		
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[]='You have entered an invalid email address';
		}
		else{
			//removes chars - nessessary to use both?
			$sani_email = filter_var($email, FILTER_SANITIZE_EMAIL);
			//escapes special chars from email for use in query. dbc sets char type 
			$e = mysqli_real_escape_string($dbc, trim($sani_email));
		}
		
		
		if (empty($pass)){
			$errors[]='You forgot to enter your pasword.';
		}
		else{
			$p = mysqli_real_escape_string($dbc, trim($pass));
		}
	
		
		if(empty($errors)){
			//retrive user id for username password combo
			$q = "SELECT user_id, first_name FROM logoninfo WHERE email=? AND password=? ";
			//Initialize a statement and return an object to use with _prepare?
			$stmt = mysqli_stmt_init($dbc);
			//prep statment
			mysqli_stmt_prepare($stmt, $q);
			//Bind variables to prepared statement as parameters
			mysqli_stmt_bind_param($stmt, 'ss', $e, $p);
			//run dis query
			mysqli_stmt_execute($stmt);
			// bind result to variable
			mysqli_stmt_bind_result($stmt, $user_id, $first_name);
			//fetch that data
			if(mysqli_stmt_fetch($stmt)){
			//if(mysqli_stmt_num_rows == 1){
				//create array
				$row = array('user_id'=> $user_id, 'first_name' => $first_name);
				//return true and the record
				return array(TRUE, $row);
			}
			
			else{
				 //not a match. error occurred with fetch.returned false.
				 $errors[] = 'The username and pasword entered do not match those on file.';
			}
			mysqli_stmt_close($stmt);
		} // end of empty errors
		
		//return false and the errors
		return array(false, $errors);
		
		
	} //end of check_login function
