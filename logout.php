<?php
 session_start();
 require_once 'dbconnect.php';
 if (!isset($_SESSION['username'])) {
  header("Location: login.php");
 } else if(isset($_SESSION['username'])!="") {
  header("Location: welcome.php");
 }
 
 if (isset($_GET['logout'])) {
	
	$sql_delete = "Delete  from contains where basketid='".$_SESSION['username']."'";
	mysql_query($sql_delete);
	unset($_SESSION['username']);
	unset($_SESSION['searchField']);
	unset($_SESSION['search']);
	session_unset();
	
	header("Location: login.php");
	exit;
	
 }
 
 ?>