<?php

if(isset($_POST['login'])) {

	include_once 'connect.inc.php';

	$usrName = mysqli_real_escape_string($conn, $_POST['usrName']);
	$pswd = mysqli_real_escape_string($conn, $_POST['pswd']);
	
	$sql = "SELECT * FROM users WHERE user_name='$usrName';";

	$result = mysqli_query($conn, $sql);
	$resulRow = mysqli_num_rows($result);

	if($resulRow < 1) {
		header("Location: ../index.php?error=Username");
		exit();
	} else {
		$row = mysqli_fetch_array($result);
		$pswdCheck = password_verify($pswd, $row['user_password']);
		if($pswdCheck == false) {
			header("Location: ../index.php?error=password");
			return;
		} else {
			//Login sucessful
			session_start();
			$_SESSION['user_id'] = $usrName;
			header("Location: ../home.php");
			return;
		}
	}

} else {
	header("Location: ../index.php");
	exit();
}

?>