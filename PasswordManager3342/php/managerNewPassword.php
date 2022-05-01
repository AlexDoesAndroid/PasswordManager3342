<?php
	session_start();
	require_once("config.php");
	
	// Connect DB
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		// print "Database connection failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();
	}

	echo json_encode($_SESSION);
	exit();
?>