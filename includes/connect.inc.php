<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "social-network";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(mysqli_connect_error()) {
	die("Error: connecting into database");
}