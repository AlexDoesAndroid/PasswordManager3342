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
	$Account_ID = mysqli_real_escape_string($con, $_GET["Account_ID"]);
	$CurrentPassword = md5(mysqli_real_escape_string($con, $_GET["Password"]));
	$NewPassword = md5($_POST["Password"]);
	$ValidationPassword = md5($_POST["validationPassword"]);
	$ServiceName = $_POST["ServiceName"];
	$Username = $_POST["Username"];
	$WebsiteURL = $_POST["WebsiteURL"];
	$Category = $_POST["Category"];

	// check passwords match
	if ($CurrentPassword != $ValidationPassword) {
		$_SESSION["Message"] = "Passwords don't match'";
		echo json_encode($_SESSION);
		exit();
	}

	$LastDateModified = date("Y-m-d h:i:s");
	// insert the new password
	$query = "Update Account_Passwords (ServiceName, Username, WebsiteURL, Password, Category, LastDateModified, Account_ID) "
		."values ('$ServiceName','$Username','$WebsiteURL','$NewPassword', '$Category', '$LastDateModified', '$Account_ID');";
	$result = mysqli_query($con, $query);
	if (!$result) {
		// print "Registration insertion failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Password update failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}

    // Check query result mysqli_affected_rows() 
    if (mysqli_affected_rows($con) != 1){
        $_SESSION["Message"] = "query failed, password couldn't be updated'".mysqli_error($con);
        echo json_encode($_SESSION);
        exit();
    }


	$_SESSION["Message"] = "Password set succesfully";
	echo json_encode($_SESSION);
	exit();
?>