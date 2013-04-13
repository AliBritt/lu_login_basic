<?php # login_page.inc.php
	
	//error messages
	if (isset($errors) && !empty($errors)){
		echo '<h1> Error!</h1> <p class="error"> The following errors(s) occurred:<br />;';
		foreach ($errors as $msg) {
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	}
	
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Sign in · Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="..../BasicLogIn/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="..../BasicLogIn/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input class="input-block-level" placeholder="Email" type="text" name="email">
        <input class="input-block-level" placeholder="Password" type="password" name="pass">
        <!--<a href="new_user_final.php">Sign Up</a>-->
        <label class="checkbox">
          <input value="remember-me" type="checkbox"> Remember me
        </label>
        
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        
      </form>
      
        

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/jquery.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-transition.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-alert.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-modal.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-dropdown.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-scrollspy.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-tab.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-tooltip.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-popover.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-button.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-collapse.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-carousel.js"></script>
    <script src="Sign%20in%20%C2%B7%20Twitter%20Bootstrap_files/bootstrap-typeahead.js"></script>

  

</body>
</html>
