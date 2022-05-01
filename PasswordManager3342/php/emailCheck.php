<?php
    session_start();
    require_once("config.php");
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
	require '../PHPMailer-master/src/Exception.php';
	require '../PHPMailer-master/src/PHPMailer.php';
	require '../PHPMailer-master/src/SMTP.php';

    // Get Web Data
    $Email = $_GET["regedEmail"];
    print "checkEmail ($Email) <br>";
    // Connect Database
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 5;
		echo json_encode($_SESSION);
		exit();	
	}
    print "database connected <br>";
    // Build Query
    $query = "Select * from User_Manager where Email = '$Email';";
    // Run the query
    $result = mysqli_query($con, $query);
    if(!$result){
        print "Check email query failed: ".mysqli_error($con);
        $_SESSION["Message"] = "Check Email query failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 5;
        echo json_encode($_SESSION);
		exit();	
    }
    // Check mysqli_num_rows() == 1
    if (mysqli_num_rows($result) != 1){
        $_SESSION["Message"] = "Email check failed: ".mysqli_error($con);
        $_SESSION["RegState"] = 5;
        echo json_encode($_SESSION);
        exit();
    }
    print "Email found <br>";
    // Define FirstName and LastName
    $row = mysqli_fetch_assoc($result);
    $FirstName = $row["FirstName"];
    $LastName = $row["LastName"];
    print "Name found($FirstName) ($LastName)<br>";

    $Acode = rand(10000, 99999);
    print "Acode is:  $Acode <br>";
    $query = "update Users set Acode = '$Acode' where Email='$Email';";
    $result = mysqli_query($con, $query);
    if(!$result){
        $_SESSION["Message"] = "Acode update query failed: ".mysqli_error($con);
        $_SESSION["RegState"] = 5;
        echo json_encode($_SESSION);
        exit();
    }
    print "Acode updated <br>";
    // build email to authenticate
    $mail= new PHPMailer(true);
	try { 
		$mail->SMTPDebug = 2; // Wants to see all errors for now
		$mail->IsSMTP();
		$mail->Host="smtp.gmail.com";
		$mail->SMTPAuth=true;
		$mail->Username="Group4CIS3342@gmail.com";
		$mail->Password = "PasswordManager2022";
		$mail->SMTPSecure = "ssl";
		$mail->Port=465;
		$mail->SMTPKeepAlive = true; 
		$mail->Mailer = "smtp";
		$mail->setFrom("Group4CIS3342@gmail.com", "S22CIS3342 Group 4");
		$mail->addReplyTo("Group4CIS3342@gmail.com","S22CIS3342 Group 4");
		$msg = "If you forgot your password you can use this code to reset: $Acode. Please complete the resetPassword process on site.";
		$mail->addAddress($Email,"$FirstName $LastName");
		$mail->Subject = "Welcome to the Group 4's' Password Management App";
		$mail->Body = $msg;
		$mail->send();
		print "Email sent ... <br>";
		$_SESSION["RegState"] = 5;
		$_SESSION["Message"] = "Email sent.";
		$_SESSION["Email"] = $Email;
	} catch (phpmailerException $e) {
		$_SESSION["Message"] = "Mailer error: ".$e->errorMessage();
		$_SESSION["RegState"] = 5;
		print "Mail send failed: ".$e->errorMessage;		
	}
    // Return
    echo json_encode($_SESSION);
    exit();
?>