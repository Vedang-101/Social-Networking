<?php
	include_once 'connect.inc.php';

	$id = $_GET['id'];
	$image = mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id;");
	$image = mysqli_fetch_array($image);
	$image = $image['user_profile'];

	header("Content-type: image/jpeg");

	echo $image;
?>