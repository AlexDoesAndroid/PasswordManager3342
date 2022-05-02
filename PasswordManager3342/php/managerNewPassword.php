<?php
	session_start();
	require_once("config.php");
	
	// Connect DB
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		// print "Database connection failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}

	// Get web data
	$Password = md5(mysqli_real_escape_string($con, $_GET["Password"]));
	$ValidationPassword = md5(mysqli_real_escape_string($con, $_GET["validationPassword"]));
	$ServiceName = mysqli_real_escape_string($con, $_GET["ServiceName"]);
	$Username = mysqli_real_escape_string($con, $_GET["Username"]);
	$WebsiteURL = mysqli_real_escape_string($con, $_GET["WebsiteURL"]);
	$Category = mysqli_real_escape_string($con, $_GET["Category"]);
	$Account_ID = mysqli_real_escape_string($con, $_GET["Account_ID"]);

	// check passwords match
	if ($Password != $ValidationPassword) {
		$_SESSION["Message"] = "Passwords don't match'";
		echo json_encode($_SESSION);
		exit();
	}
	$LastDateModified = date("Y-m-d h:i:s");
	// insert the new password
	$query = "Insert into Account_Passwords (ServiceName, Username, WebsiteURL, Password, Category, LastDateModified, Account_ID) "
		."values ('$ServiceName','$Username','$WebsiteURL','$Password', '$Category', '$LastDateModified', '$Account_ID');";
	$result = mysqli_query($con, $query);
	if (!$result) {
		// print "Registration insertion failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Password insertion failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}

	$_SESSION["Message"] = "Password set succesfully";
	echo json_encode($_SESSION);
	exit();
?>