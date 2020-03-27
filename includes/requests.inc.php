<?php
	if(isset($_POST['accept']) || isset($_POST['reject'])) {
		include_once 'connect.inc.php';
		$sr = $_GET['sr'];
		if(isset($_POST['accept'])) {
			$sql = "UPDATE `friendship` SET `status`=1 WHERE `Sr_No`=$sr;";
			$result = mysqli_query($conn, $sql);
		} else {
			$sql = "DELETE FROM `friendship` WHERE `Sr_No`=$sr;";
			$result = mysqli_query($conn, $sql);
		}
		header("Location: ../home.php");
	} else {
		header("Location: ../index.php");
	}