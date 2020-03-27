<?php

	include_once "connect.inc.php";
	session_start();
	$usrName = $_SESSION['user_id'];
	$friend = $_GET['friend'];
	//echo $friend;
	$query = "INSERT INTO `friendship`(`Person_name`, `Friend_name`, `status`) VALUES('$friend', '$usrName', '0')";

	if(mysqli_query($conn, $query)){
		header('Location: ../home.php');
	}

?>