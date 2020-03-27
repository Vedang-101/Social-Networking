<?php
	if(isset($_POST['update'])) {
		include_once 'connect.inc.php';
		
		session_start();
		$usr = $_SESSION['user_id'];
		$profile = $_FILES['display_profile']['tmp_name'];
		$email = mysqli_real_escape_string($conn, $_POST['newemail']);
		$oldpswd = mysqli_real_escape_string($conn, $_POST['oldpswd']);
		$newpswd = mysqli_real_escape_string($conn, $_POST['newpswd']);
		if(!empty($profile)) {
			$image = addslashes(file_get_contents($profile));
			$sql = "UPDATE `users` SET `user_profile`='$image' WHERE `user_name`='$usr'";
			$result = mysqli_query($conn, $sql);
		}
		if(!empty($profile)) {
			$image = addslashes(file_get_contents($profile));
			$sql = "UPDATE `users` SET `user_profile`='$image' WHERE `user_name`='$usr'";
			$result = mysqli_query($conn, $sql);
		}
		if(!empty($email)) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$sql = "UPDATE `users` SET `user_email`='$email' WHERE `user_name`='$usr'";
				$result = mysqli_query($conn, $sql);
			}
		}
		if(!empty($newpswd)) {
			if(!empty($oldpswd)) {
				$sql = "SELECT * FROM users WHERE user_name='$usr';";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result);
				$pswdCheck = password_verify($oldpswd, $row['user_password']);
				if($pswdCheck == true) {
					$hash_pswd = password_hash($newpswd, PASSWORD_DEFAULT);
					$sql = "UPDATE `users` SET `user_password`='$hash_pswd'' WHERE `user_name`=$usr";
					$result = mysqli_query($conn, $sql);
				}
			}
		}
		header("location: ../home.php");
	}