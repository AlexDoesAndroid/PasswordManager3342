<?php
	session_start();
	require_once("config.php");
	// Get webdata


	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();		
	}
	// print "database connected <br>";
	// add mysqli_real_escape_string here
	$Acode = $_GET["Acode"];
	$Email = $_SESSION["Email"];
	// print "Webdata ($Acode) ($Email) <br>";
	$query = "Select * from Users where Acode='$Acode' and Email='$Email';";
	$result = mysqli_query($con, $query);
	if (!$result) {
		print "Authentication query failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Authentication query failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();	
	}
	//print "Query worked. <br>";
	// Must check mysqli_num_rows == 1
	if (mysqli_num_rows($result) != 1) {
		$_SESSION["Message"] = "Authentication failed. Hacking suspected.";
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();	
	}
	// print "Authentication sucess! <br>";
	// Must Update ACode for hacking prevention
	$Acode = rand(10000, 99999);
	$ADateTime = date("Y-m-d h:i:s");
	$query = "Update Users set Acode='$Acode', ADateTime = '$ADateTime' where Email = '$Email';";
	$result = mysqli_query($con, $query);
	if (!$result) {
		// print "Acode update failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Acode update failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();	
	}
	if (mysqli_affected_rows($con) != 1){
        $_SESSION["Message"] = "Acode update failed: ".mysqli_error($con);
        $_SESSION["RegState"] = 1;
        echo json_encode($_SESSION);
        exit();
    }
	// print "Password set successfully <br>";
	// Authentication success. Allow to set password
	$_SESSION["RegState"] = 2;
	$_SESSION["Message"] = "Authentication success. Please set password.";
	echo json_encode($_SESSION);
	exit();		
?>