<?php
    session_start();
    require_once("config.php");
    // Get webdata
    $Password1 = md5($_POST["Password1"]);
    $Password2 = md5($_POST["Password2"]); 
    if ($Password1 != $Password2) {
        $_SESSION["RegState"] = 2;
        $_SESSION["Message"] = "Passwords not match. Please try again.";
        echo json_encode($_SESSION);
        exit();
    }
    $Email = $_SESSION["Email"];
    $AuthDateTime = date("Y-m-d h:i:s");
    // print "Webdata ($Email)($Password1) <br>";
    // print "Webdata ($Adatetime) <br>";       //Anaconda Testing
    // connect to DB
    // Build update
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
        $_SESSION["RegState"] = 2;
        $_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
        echo json_encode($_SESSION);
        exit();		
	}
    // Build update add RSPWCount += RSPWCount +1
    $query = "Update User_Manager set Acc_Password  = '$Password1' , AuthDateTime = '$AuthDateTime' where Email='$Email';";
    $result = mysqli_query($con, $query);
	if (!$result){
        $_SESSION["RegState"] = 2;
        $_SESSION["Message"] = "Password update failed: ".mysqli_error($con);
        echo json_encode($_SESSION);
        exit();		
	}
 
    // Run the query
    // Check query result mysqli_affected_rows() 
    if (mysqli_affected_rows($con) != 1){
        $_SESSION["Message"] = "query failed, password not set".mysqli_error($con);
        $_SESSION["RegState"] = 2;
        echo json_encode($_SESSION);
        exit();
    }
    //print "Password set. <br>";
    //track RSPW count
    $query = "Update User_Manager set RSPWCount= RSPWCount + 1 where Email='$Email';";
    $result = mysqli_query($con, $query);
	if (!$result){
        $_SESSION["RegState"] = 2;
        $_SESSION["Message"] = "RSPWcount update failed: ".mysqli_error($con);
        echo json_encode($_SESSION);
        exit();		
	}    
    // Run the query
    // Check query result mysqli_affected_rows() 
    if (mysqli_affected_rows($con) != 1){
        $_SESSION["Message"] = "RSPWCount update query 2 failed".mysqli_error($con);
        $_SESSION["RegState"] = 2;
        echo json_encode($_SESSION);
        exit();
    }
    //Authentication success
    $_SESSION["RegState"] = 0;      // Set RegState = 0
    $_SESSION["Message"] = "Password set. Please login.";
    echo json_encode($_SESSION);
    exit();
?>