<?php
	include_once 'dbh.inc.php';

	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$pswd = $_POST['pswd'];

	$sql = "INSERT INTO users (name, phone, email, pswd) VALUES ('$name', '$phone', '$email', '$pswd');";
	mysqli_query($conn, $sql);

	//$to=$_POST['email'];

	$subject="Account Created";
	$txt="You have successfully created an account!";

	mail("kdog6500@gmail.com",$subject,$txt);

header("localhost/webProject/index.php");
     $location='location:../index.php';
     header($location);
	
