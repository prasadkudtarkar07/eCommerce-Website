<?php
	ob_start();
	session_start();
	if( isset($_SESSION['username'])!="" ){
		header("Location: welcome.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['register_btn']) ) {
		$username = trim($_POST['username']);
		$username = strip_tags($username);
		$username = htmlspecialchars($username);
  
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
  
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
  
		$password_confirmation = trim($_POST['password_confirmation']);
		$password_confirmation = strip_tags($password_confirmation);
		$password_confirmation = htmlspecialchars($password_confirmation);
  
		$phone = trim($_POST['phone']);
		$phone = strip_tags($phone);
		$phone = htmlspecialchars($phone);
  
		$address = trim($_POST['address']);
		$address = strip_tags($address);
		$address = htmlspecialchars($address);
  
		if (empty($username)) {
			$error = true;
			$usernameError = "Please enter username";
		} else if (strlen($username) < 6) {
			$error = true;
			$usernameError = "Username must have atleat 6 characters.";
		} else {
			$query1 = "SELECT username FROM customer WHERE username='$username'";
			$result = mysql_query($query1);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$usernameError = "Entered username is already registered.";
			}
		}
  
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			$query2 = "SELECT email FROM customer WHERE email='$email'";
			$result = mysql_query($query2);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "Entered email is already registered.";
			}
		}

		if (empty($password)){
			$error = true;
			$passwordError = "Please enter password.";
		} else if(strlen($password) < 6) {
			$error = true;
			$passwordError = "Password must have atleast 6 characters.";
		}

		if (empty($password_confirmation)){
			$error = true;
			$passwordConfirmationError = "Please enter password.";
		} else if($password != $password_confirmation) {
			$error = true;
			$passwordConfirmationError = "Password must have atleast 6 characters.";
		}
  
		$password = hash('md5', $password);
  
		if (empty($phone)){
		$error = true;
		$phone = "Please enter phone number.";
		}

		if (empty($address)){
			$error = true;
			$address = "Please enter address.";
		}

		if( !$error ) {
			$query3 = "INSERT INTO customer(username, email, password, phone, address) VALUES('$username', '$email', '$password', '$phone', '$address')";
			$res1 = mysql_query($query3);
			$query4 = "INSERT INTO shoppingbasket(basketID, username) VALUES('$username', '$username')";
			$re2 = mysql_query($query4);
    
			if($res1) {
				$errTyp = "success";
				$errMSG = "Successfully registered";
				unset($username);
				unset($email);
				unset($password);
				unset($password_confirmation);
				unset($phone);
				unset($address);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later..."; 
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
			<div id="registration-form" class="row centered-form">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
				<?php
					if ( isset($errMSG) ) {
				?>
				<div class="form-group">
					<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
						<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
					</div>
				</div>
				<?php
					}
				?>
		
				<div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Sign Up for CHEAPBOOKS <small>Cheapest Online Bookstore!</small></h3>
			 			</div>
			 			<div class="panel-body">
							<form role="form">
								<div class="form-group">
									<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username" value="<?php echo $username ?>">
								</div>
							
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?php echo $email ?>">
								</div>

								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" value="<?php echo $password ?>">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" value="<?php echo $password_confirmation ?>">
										</div>
									</div>
								</div>
							
								<div class="form-group">
									<input type="tel" name="phone" id="phone" class="form-control input-sm" placeholder="Phone" value="<?php echo $phone ?>">
								</div>
							
								<div class="form-group">
									<input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address" value="<?php echo $address ?>">
								</div>

								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="submit" value="Register" class="btn btn-info btn-block" name="register_btn">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<a href="login.php" class="btn btn-info btn-block" role="button"></span>Login</a>
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