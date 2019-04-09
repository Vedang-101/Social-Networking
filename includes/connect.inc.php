<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login-system";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(mysqli_connect_error()) {
	die("Error: connecting into database");
}