<?php #login.php
	//this page processes the login form submission
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		require('lu_includes/lu_login_functions.inc.php');
		require('/var/mysqli_connect_phplogin.php');//require paths maybe not best practice?
			
		//check the login. takes values from form and uses function from login_function.php
		list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
		
		if($check){
		//set the session data
			session_start();
			$_SESSION['user_id'] = $data['user_id']; //this is retreving data from db using $data
			$_SESSION['first_name'] = $data['first_name']; 
			
			redirect_user('lu_loggedin.php');
		}
		else{
			//Assign data to $errors for lu_login_page.inc.php
			$errors = $data;
		
		}
			
		mysqli_close($dbc);
		
	}// end of the main submit conditional

	//create the page
	include('lu_includes/lu_login_page.inc.php');
?>