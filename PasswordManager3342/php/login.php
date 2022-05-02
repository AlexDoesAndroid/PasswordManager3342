<?php
    session_start();
    require_once("config.php");
    // Connect DB
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if(!$con){
        $_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
        $_SESSION["RegState"] = 2;
        echo json_encode($_SESSION);
        exit();
    }
    //print "database connected <br>";
     //Get Webdata
     $Email = mysqli_real_escape_string($con, $_POST["Email"]);
     $Password = md5($_POST["Password"]);        //Encrypt user password immediately upon receiving.
     $_SESSION["RememberMe"] = $_POST["RememberMe"];

    //Check if cookie can be found
    // print "Webdata ($Email)($Password)(".$_SESSION["RememberMe"].") <br>";

    $CookieName = md5("tuj43590");
    if(isset($_COOKIE[$CookieName])){
        // Check DB to see if SessionCode exists
        // print "Cookie found <br>";
        $CookieValue = $_COOKIE[$CookieName];
        $query = "select * from User_Manager where SessionCode = '$CookieValue';";
        $result = mysqli_query($con, $query);
        if (!$result){
            // print "Login query failed, either password or email don't match: ".mysqli_error($con);
            $_SESSION["Message"] = "Login query failed, either password or email don't match: ".mysqli_error($con);
            $_SESSION["RegState"] = -4;
            echo json_encode($_SESSION);
            exit();
        }
        if (mysqli_num_rows($result) == 1){
            //Cookie Login Success
            // print "Cookie Log in Success <br>";
            $row = mysqli_fetch_assoc($result);
            $_SESSION["FirstName"] = $row["FirstName"];
            $_SESSION["LastName"] = $row["LastName"];
            $_SESSION["Email"] = $row["Email"];
            $_SESSION["RegState"] = 4;
            $_SESSION["Message"] = "Cookie logged in!";
            echo json_encode($_SESSION);
            exit();
        }
        // print "Cookie Log in failure <br>";
    }
    // print "cookie not found. Regular login <br>";
    // Build query to check if email and password match in database
    $query = "Select * from User_Manager where Email='$Email' and Acc_Password='$Password';";      // Check if the user Email and encrypted Password match with database.
    $result = mysqli_query($con, $query);
    if(!$result){   // If not match, set negative RegState, report "Either password or email not match", redirect back to index.php.
        // print "Login query failed, either password or email don't match: ".mysqli_error($con);
        $_SESSION["Message"] = "Login query failed, either password or email don't match: ".mysqli_error($con);
        $_SESSION["RegState"] = -1;
        echo json_encode($_SESSION);
        exit();
    }
    if (mysqli_num_rows($result) != 1) {        // Should only return one row theoretically
        $_SESSION["Message"] = "Login query failed, either password or email don't match: ".mysqli_error($con);
        // print "$query <br>";
        // print "NumRows: ".mysqli_num_rows($result)." <br>";
        $_SESSION["RegState"] = -1;
        echo json_encode($_SESSION);
        exit();
    }
    // logged in
    $row = mysqli_fetch_assoc($result);
    $_SESSION["FirstName"] = $row["FirstName"];     // If match, retrieve FirstName and LastName to two new session variables, redirect the visitor to protected page.
    $_SESSION["LastName"] = $row["LastName"];
    $_SESSION["Email"] = $row["Email"];
    // print "login success!!!! <br>";
    //Update Users to track LDateTime

    session_regenerate_id(true);
    $SessionID = session_id();
    function make_seed(){
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }
    srand(make_seed());
    $CookieContent = rand();
    // print "Seeded rand($CookieContent) <br>";
    $Ldatetime = date("Y-m-d h:i:s");
    //Update DB
    $query = "update User_Manager set SessionCode = '$CookieContent', LoginDateTime='$Ldatetime' where Email='$Email';";
    $result = mysqli_query($con, $query);
    if(!$result){
        // print "Login update query failed : ".mysqli_error($con);
        $_SESSION["Message"] = "Login update query failed : ".mysqli_error($con);
        $_SESSION["RegState"] = -2;
        echo json_encode($_SESSION);
        exit();
    }
    // print "DB cookie content update Success <br>";
    // How to verify the update worked
    if (mysqli_affected_rows($con) != 1){
        // print "Update Failed : ".mysqli_error($con);
        $_SESSION["Message"] = "Login update query failed 2: ".mysqli_error($con);
        $_SESSION["RegState"] = -3;
        echo json_encode($_SESSION);
        exit();
    }
    // print "Update verification success <br>";
    // Set Cookie
    setcookie($CookieName, $CookieContent, time()+86400, "/");
    $_SESSION["RegState"] = 4;
    $_SESSION["Message"] = "Logged in!";
    // print "Cookie Created <br>";
    echo json_encode($_SESSION);
    exit();
?>