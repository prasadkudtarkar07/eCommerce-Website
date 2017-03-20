<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
 
	if( !isset($_SESSION['username']) ) {
		header("Location: login.php");
		exit;
	}
 
	if( isset($_SESSION['username']) ) {
		$query2 = "SELECT SUM(number) FROM contains WHERE basketID LIKE '".$_SESSION['username']."'";
		$res2 = mysql_query($query2);
		$row2 = mysql_fetch_assoc($res2);
		$count = $row2["SUM(number)"];
		if($count == "") $count = 0;
	}

	$basketID=$_SESSION['username'];
	$res=mysql_query("SELECT * FROM customer WHERE username LIKE '".$_SESSION['username']."'");
	$userRow=mysql_fetch_array($res);
 
	
 
	
	$ISBN = trim($_POST['ISBN']);
	$ISBN = strip_tags($ISBN);
	$ISBN = htmlspecialchars($ISBN);
  
	$number = trim($_POST['number']);
	$number = strip_tags($number);
	$number = htmlspecialchars($number);
 
	if(isset($_POST['add_to_cart_button']) && $number>0) {
		$query = "INSERT INTO contains(ISBN, basketID, number) VALUES('$ISBN', '$basketID', $number)";
		$res = mysql_query($query);
	
		$query3 = "SELECT SUM(number) FROM contains WHERE basketID LIKE '".$_SESSION['username']."'";
		$res3 = mysql_query($query3);
		$row3 = mysql_fetch_assoc($res3);
		$count = $row3["SUM(number)"];
	}
 
	if(isset($_POST["logout"])) {
		$sql_delete = "Delete  from contains where basketid='$username'";
		mysql_query($sql_delete);
	}	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Welcome - <?php echo $userRow['username']; ?></title>
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
										<button class="btn btn-info" >
											<span class="glyphicon glyphicon-shopping-cart"></span>	Cart (<?php echo $count?>)
										</button>
									</form>
						
									<form class="navbar-form navbar-left"  action="logout.php?logout" method="get">
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
		
		<div class="container" style="text-align:center;margin-top:50px;">
			<div class="col-lg-12">
				<h1>Welcome</h1>
				<hr/>
				<div class="well well-lg">
					<form action="welcome.php" method="GET">
						<div><input type="text" name="search" class="form-control" placeholder="Search" value=<?php ?>></div><br>
						<button type="submit" class="btn btn-info" name="searchField" value="SearchByAuthor">Search By Author</button>
						<button type="submit" class="btn btn-info" name="searchField" value="SearchByBookTitle">Search By Book Title</button>
					</form>
				</div>
			</div>
			<br>
			
			<div class="cart-view-table-welcome">
				<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Name</th><th>ISBN</th><th>Quantity</th><th>Available Quantity</th></tr></thead>
					<tbody>	
						<?php
						
						if(isset($_GET['searchField']))
						{
							$_SESSION["searchField"]=$_GET['searchField'];
						}
						if(isset($_GET['search']))
						{
							$_SESSION["search"]=$_GET['search'];
						}
						
					//	echo $_SESSION["searchField"];
					//	echo $_SESSION["search"];
						
						
							$sql;
							if(isset($_GET['searchField']) || $_SESSION["searchField"]!="") {
								if($_GET['searchField'] == SearchByAuthor || $_SESSION["searchField"] == SearchByAuthor) {
									$key=$_SESSION["search"];
									$sql = "SELECT * FROM writtenby INNER JOIN author ON author.ssn=writtenby.ssn INNER JOIN book ON book.ISBN=writtenby.ISBN WHERE author.name='".$key."'";
								} else if($_GET['searchField'] == SearchByBookTitle ||  $_SESSION["searchField"] == SearchByBookTitle) {
									$key=$_SESSION["search"];
									
									$sql = "SELECT * FROM book WHERE title='".$key."'";	
								} else if($_GET['searchField'] == ShoppingBasket) {
									header("Location: checkout.php");
								}
							}
							
							
							
							
							

							if($sql != NULL) {
								$result = mysql_query($sql);
								$b = 0;

								while($row = mysql_fetch_assoc($result)) {
									$bg_color = ($b++%2==1) ? 'odd' : 'even';	
									$title=$row["title"];
									$ISBN=$row["ISBN"];
									$sql2 = "SELECT SUM(number) AS value_sum FROM stocks WHERE ISBN=".$ISBN;
									$result2 = mysql_query($sql2);
									while($row2 = mysql_fetch_assoc($result2)) {
										$warehousecount = $row2["value_sum"];
									}
		
									if($warehousecount>0) {
		
										echo '<tr class="'.$bg_color.'">';
										echo '<td>'.$title.'</td>';
										echo '<td>'.$ISBN.'</td>';?>
										<td><form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
												<input type="hidden" name="ISBN" value=<?php echo $ISBN ?>>
												<input type="hidden" name="basketID" value=$_SESSION['username']>
												<input type="text" name="number"  value="0" />
												<button type="submit" class="btn btn-info" name="add_to_cart_button">Add To Cart</button>
											</form>
										</td>

										<?php 
											echo '<td>'.$warehousecount.'</td>';
											echo '</tr>';}}}
										?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
<?php ob_end_flush(); ?>