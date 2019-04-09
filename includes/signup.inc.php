<?php

if(isset($_POST['signup'])) {

	include_once 'connect.inc.php';

	$usrName = mysqli_real_escape_string($conn, $_POST['usrName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pswd = mysqli_real_escape_string($conn, $_POST['pswd']);
	$repswd = mysqli_real_escape_string($conn, $_POST['repswd']);
	
	$profile = $_FILES['profile']['tmp_name'];

	if(empty($profile))
		$profile = 'C:\xampp\htdocs\Login\images\userDefault.png';

	//ErrorCheck
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../index.php?error=email");
		exit();
	} else {
		if($pswd != $repswd) {
			header("Location: ../index.php?error=password");
			exit();
		} else {
			$sql = "SELECT * FROM `users` WHERE user_name='$usrName';";
			$result = mysqli_query($conn, $sql);
			$resulRow = mysqli_num_rows($result);
			if($resulRow > 0) {
				header("Location: ../index.php?error=Username");
				exit();
			} else {
				$hash_pswd = password_hash($pswd, PASSWORD_DEFAULT);
				$image = addslashes(file_get_contents($profile));
	 			//Insert
				$query = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`, `user_profile`) VALUES ('$usrName', '$email', '$hash_pswd', '$image');";
				$result = mysqli_query($conn, $query);
				header("Location: ../index.php");
				exit();
			}
		}
	}

} else {
	header("Location: ../index.php");
	exit();
}

?>