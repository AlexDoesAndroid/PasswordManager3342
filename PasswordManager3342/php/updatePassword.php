<?php
	session_start();
	require_once("config.php");
	$Password = md5($_POST["Password"]);
	// Connect DB
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		// print "Database connection failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		$_SESSION["PassState"] = 0;
		echo json_encode($_SESSION);
		exit();
	}
	$query = "Update Account_Passwords Password  = '$Password' , ServiceName = '$ServiceName' , Username = '$Username'
	, WebsiteURL = '$WebsiteURL' , Category = '$Category' where PasswordID='$PasswordID';";"
	echo json_encode($_SESSION);
	exit();
?>