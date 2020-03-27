<?php
	include_once 'connect.inc.php';

	$no = $_GET['sr_no'];
	$image = mysqli_query($conn, "SELECT * FROM posts WHERE sr_no=$no;");
	$image = mysqli_fetch_array($image);
	$image = $image['photo'];

	header("Content-type: image/jpeg");

	echo $image;
?>