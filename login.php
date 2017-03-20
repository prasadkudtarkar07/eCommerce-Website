<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	if ( isset($_SESSION['username'])!="" ) {
		header("Location: welcome.php");
		exit;
	}
 
	$error = false;
 
	if( isset($_POST['login_btn']) ) { 

		$username = trim($_POST['username']);
		$username = strip_tags($username);
		$username = htmlspecialchars($username);
  
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);

		if(empty($username)){
			$error = true;
			$usernameError = "Please enter your username.";
		}
  
		if(empty($password)){
			$error = true;
			$passwordError = "Please enter your password.";
		}
  
		if (!$error) {
   
			$password = hash('md5', $password); // password hashing using md5
  
			$res=mysql_query("SELECT username, password FROM customer WHERE username='$username'");
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res);
   
			if( $count == 1 && $row['password']==$password ) {
				$_SESSION['username'] = $row['username'];
				$_SESSION["searchField"]="";
				$_SESSION["search"]="";
				header("Location: welcome.php");
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
		}
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			body{
				background-color: #525252;
			}
			.centered-form{
				margin-top: 60px;
			}

			.centered-form .panel{
				background: rgba(255, 255, 255, 0.8);
				box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div id="login-form" class="row centered-form">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
					<?php
						if ( isset($errMSG) ) {
					?>
					<div class="form-group">
						<div class="alert alert-danger">
							<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
						</div>
					</div>
					<?php
						}
					?>
					<div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Login to CHEAPBOOKS <small>Cheapest Online Bookstore!</small></h3>
							</div>
							<div class="panel-body">
								<form role="form">
									<div class="form-group">
										<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username">
										<span class="text-danger"><?php echo $usernameError; ?></span>
									</div>
							
									<div class="form-group">
										<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
										<span class="text-danger"><?php echo $passwordError; ?></span>
									</div>
							
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="submit" value="Login" class="btn btn-info btn-block" name="login_btn">
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<a href="registration.php" class="btn btn-info btn-block" role="button"></span>Registration</a>
											</div>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>