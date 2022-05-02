<?php
	session_start();
	require_once("config.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
	require '../PHPMailer-master/src/Exception.php';
	require '../PHPMailer-master/src/PHPMailer.php';
	require '../PHPMailer-master/src/SMTP.php';

	// Connect DB
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		// print "Database connection failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();
	}
	//  Get web data
	$FirstName = mysqli_real_escape_string($con, $_GET["FirstName"]);
	$LastName = mysqli_real_escape_string($con, $_GET["LastName"]);
	$Email = mysqli_real_escape_string($con, $_GET["Email"]);
	//print "Web data ($FirstName)($LastName)($Email) <br>";


	// print ("Database connected <br>");
	// Register the visitor
	$Rdatetime = date("Y-m-d h:i:s");
	$Acode = rand(10000,99999);
	$query = "Insert into User_Manager (FirstName, LastName, Email, Acode, RegDateTime, Status) "
		."values ('$FirstName','$LastName','$Email','$Acode', '$RegDateTime', 1);";
	$result = mysqli_query($con, $query);
	if (!$result) {
		// print "Registration insertion failed: ".mysqli_error($con);
		$_SESSION["Message"] = "Registration insertion failed: ".mysqli_error($con);
		$_SESSION["RegState"] = 1;
		echo json_encode($_SESSION);
		exit();
	}
	//print "Registration success <br>";
	// Ready to send authentication email
	// Build the PHPMailer object:
	$mail= new PHPMailer(true);
	try {
		$mail->SMTPDebug = 0; // No errors reporting to prevent breaking the ajax call
		$mail->IsSMTP();
		$mail->Host="smtp.gmail.com";
		$mail->SMTPAuth=true;
		$mail->Username="groupfourcis3342project@gmail.com";
        $mail->Password = "Gr0Up4Ema1LP@ssW0rd";
		$mail->SMTPSecure = "ssl";
		$mail->Port=465;
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->setFrom("groupfourcis3342project@gmail.com", "S22CIS3342 Group 4");
        $mail->addReplyTo("groupfourcis3342project@gmail.com","S22CIS3342 Group 4");
		$msg = "Your authentication code is $Acode. Please complete the registration process on site.";
		$mail->addAddress($Email,"$FirstName $LastName");
		$mail->Subject = "Welcome to the Group 4's' Password Management App";
		$mail->Body = $msg;
		$mail->send();
		// print "Email sent ... <br>";
		$_SESSION["RegState"] = 1;
		$_SESSION["Message"] = "Email sent";
		$_SESSION["Email"] = $Email;
	} catch (phpmailerException $e) {
		$_SESSION["Message"] = "Mailer error: ".$e->errorMessage();
		$_SESSION["RegState"] = 1;
		// print "Mail send failed: ".$e->errorMessage;
	}
	echo json_encode($_SESSION);
	exit();
?>