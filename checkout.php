<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
 
	if( !isset($_SESSION['username']) ) {
		header("Location: login.php");
		exit;
	}
 
	$basketID=$_SESSION['username'];
	$res=mysql_query("SELECT * FROM customer WHERE username LIKE '".$_SESSION['username']."'");
	$userRow=mysql_fetch_array($res);
 
	$ISBN = trim($_POST['ISBN']);
	$ISBN = strip_tags($ISBN);
	$ISBN = htmlspecialchars($ISBN);
  
	if ( isset($_POST['buy_button']) ) {
		$sql2 = "SELECT a.warehouseCode as warehouseCode, b.ISBN as ISBN, b.basketID as username, b.number as number FROM stocks a,contains b where a.ISBN=B.ISBN " ;
		$result2 = mysql_query($sql2);
		if($result2!=null) {
			while($row = mysql_fetch_assoc($result2)) {
				$isbn=$row["ISBN"];
				$warehouseCode=$row["warehouseCode"];
				$username=$row["username"];
				$number=$row["number"];
				
				$sql_basket = "INSERT INTO shippingorder ".
					"(ISBN,warehouseCode,username,number) ".
					"VALUES ".
					"('$isbn','$warehouseCode','$username','$number')";
					   	
				mysql_query($sql_basket);
			
				$sql6 =	"select b.ISBN as ISBN , sum(a.number) as quantity, b.number as available from contains a,stocks b where a.ISBN=b.ISBN group by b.ISBN";
				$result6 = mysql_query($sql6);
				if($result6!=null) {
					
					while($row = mysql_fetch_assoc($result6)) {
						if($row["quantity"]<=$row["available"]) {
							$sql7 =	"update stocks set number = number - ".$row["quantity"]." where ISBN = ".$row["ISBN"];
							$result7 = mysql_query($sql7);
						}
					}
				}
			
				mysql_query("DELETE FROM contains WHERE basketID='".$basketID."'");
				
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Checkout</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
								</button> 
							</div>
				
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li class="active">
										<a href="#">CheapBooks</a>
									</li>
								</ul>

								<ul class="nav navbar-nav navbar-right">
									<form class="navbar-form navbar-left"  action="checkout.php" method="post">
										<B style="color:white"></B>
										<a href="welcome.php" class="btn btn-info btn-block" role="button"></span>Continue Shopping</a>
									</form>
						
									<form class="navbar-form navbar-left"  action="logout.php?logout" method="GET">
										<B style="color:white"></B>
										<input type="hidden" name="logout" >
										<button   class="btn btn-info" name="logout" >
											<span class="glyphicon glyphicon-log-out"></span> Logout 
										</button>
									</form>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
		
		<h1 align="center" style="text-align:center;margin-top:100px;">My Cart</h1>
		<div class="container-fluid">
		<div class="cart-view-table-back">
			<form method="post" action="checkout.php">
				<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr></thead>
					<tbody>
  
						<?php
							$sql = "SELECT * FROM book INNER JOIN contains ON contains.ISBN=book.ISBN WHERE contains.basketID='".$_SESSION['username']."'";
							$b = 0;
							$amount = 0;
							$result = mysql_query($sql);

							while($row = mysql_fetch_assoc($result)) {
								$bg_color = ($b++%2==1) ? 'odd' : 'even';
								$title=$row["title"];
								$price=$row["price"];
								$number=$row["number"];
		
								echo '<tr class="'.$bg_color.'">';
								echo '<td>'.$title.'</td>';
								echo '<td>'.$price.'</td>';
								echo '<td>'.$number.'</td>';
								echo '<td>'.($price*$number).'</td>';
								echo '</tr>';
								$amount += ($price*$number);
							}
						?>
						
					</tbody>
				</table>
				<div id="buy-form" class="row centered-form">
					<br><hr><br>
					<div style="margin-left: 2cm;"><Strong>Total Amount: <?php echo $amount ?></Strong></div>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
						<div style="margin-right: 1cm;"><button type="submit" class="btn btn-info" name="buy_button">Buy</button></div>
					</form>
				</div>
			</form>
		</div>
		</div>
	</body>
</html>