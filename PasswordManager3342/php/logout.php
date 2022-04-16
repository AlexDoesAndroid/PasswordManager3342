<?php
    session_start();
    require_once("config.php");
    // Add database connection, query to update LOdateTime
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if(!$con){
        $_SESSION["Message"] = "Database connection failed while logout: ".mysqli_error($con);
        $_SESSION["RegState"] = 4;
        echo json_encode($_SESSION);
        exit();
    }
    $LOdatetime = date("Y-m-d h:i:s");
    $Email = $_SESSION["Email"];
    $query = "update Users set LOdatetime='$LOdatetime' where Email = '$Email';";
    $result = mysqli_query($con, $query);
    if(!$result){
        $_SESSION["Message"] = "Update query failed while logout: ".mysqli_error($con);
        $_SESSION["RegState"] = 4;
        echo json_encode($_SESSION);
        exit();
    }
    if (mysqli_affected_rows($con) != 1){
        $_SESSION["Message"] = "Update query didn't work.";
        $_SESSION["RegState"] = 4;
        echo json_encode($_SESSION);
        exit();
    }
    $CookieName = md5("tuj43590");
    if($_SESSION["RememberMe"] != "remember-me"){
        //remove cookie
        // print "Cookie Removed <br>";
        setcookie($CookieName, "", time()-3600, "/");
    } else // print "Cookie Stayed <br>";
    unset($_SESSION['Email']);
    unset($_SESSION['RegState']);
    unset($_SESSION['Message']);
    unset($_SESSION['RememberMe']);
	session_destroy();
    // $_SESSION["RegState"] = 0;  //Add a "logout" button in protected page. Add "logout.php" to reset all session variables and redirect to index.php
    echo json_encode($_SESSION);
    exit();
?>