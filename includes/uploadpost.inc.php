<?php
	if(isset($_POST['post'])) {
		session_start();
		include_once 'connect.inc.php';
		$caption = mysqli_real_escape_string($conn, $_POST['caption']);
		$profile = $_FILES['profile']['tmp_name'];
		$usrName= $_SESSION['user_id'];
		if(!empty($profile))
			$image = addslashes(file_get_contents($profile));
		if(!empty($profile) && empty($caption)) {
			$query = "INSERT INTO `posts`(`uploaded_by`, `photo`,`Likes`, `time`) VALUES('$usrName', '$image', '0', CURRENT_TIMESTAMP)";
		}
		else if(!empty($caption) && empty($profile)) {
			$query="INSERT INTO `posts`(`uploaded_by`, `Caption`,`Likes`, `time`) VALUES('$usrName', '$caption', '0', CURRENT_TIMESTAMP)";
		}
		else if(!empty($caption) && !empty($profile)) {
			$query="INSERT INTO `posts`(`uploaded_by`, `Caption`,`photo`,`Likes`, `time`) VALUES('$usrName', '$caption', '$image', '0', CURRENT_TIMESTAMP)";
		}
		$result = mysqli_query($conn, $query);
		header("Location: ../home.php");
	}
?>