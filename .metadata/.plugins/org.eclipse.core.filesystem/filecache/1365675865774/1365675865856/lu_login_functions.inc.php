<?php #login_functions.inc.php
	
	function redirect_user($page = 'index.php'){
	//define the url 
		$url= 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	//rm trailing slashes
		$url = rtrim($url, '/\\');
	//add the page	
		$url .= '/' . $page;
	//redirect
		header("Location: $url");
		exit();
	}
	//echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	//redirect_user('login_page.inc.php');
	
	//form validation
	function check_login($dbc, $email = '', $pass = ''){
		
		$errors = array(); //initialize errors array
		
		if (empty($email)){
			$errors[]='You forgot to enter your email.';
		}
		else{//escapes special chars from email for use in query. dbc sets char type 
			$e = mysqli_real_escape_string($dbc, trim($email));
		}
		
		if (empty($pass)){
			$errors[]='You forgot to enter your pasword.';
		}
		else{
			$p = mysqli_real_escape_string($dbc, trim($pass));
		}
	
	
		if(empty($errors)){
			//retrive user id for username password combo
			$q = "SELECT user_id, first_name FROM logoninfo WHERE email='$e' AND password=('$p')";//look up SHA1 for password incription
			$r = @mysqli_query($dbc, $q);
			//run dis query
		
			//check the result
			if(mysqli_num_rows($r) == 1){
			//fetch the record
				$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
				//return true and the record
				return array(true, $row);
			
			}
			else{
				 //not a match
				 $errors[] = 'The username and pasword entered do match those on file.';
			}
		} // end of empty errors
	} //end of check_login function
