<?php
	include 'includes/dbh.inc.php';
	$id = $_GET['item'];
	$total=$_GET['total'];
	//$arr =$id.split(',',$id);
	session_start();
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$rest_name = $_SESSION['rest_name'];
	$sql = "INSERT into orders(user_name,order_item,cost,rest_name) values('$name','$id','$total','$rest_name')";
	mysqli_query($conn,$sql);
	header("Location:Your Cart.php");
?>