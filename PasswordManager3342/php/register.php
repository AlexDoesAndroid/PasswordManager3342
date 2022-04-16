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
	$query = "Insert into Users (FirstName, LastName, Email, Acode, Rdatetime, Status) "
		."values ('$FirstName','$LastName','$Email','$Acode', '$Rdatetime', 1);";
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
		$mail->Username="Alex3324mail@gmail.com";
		$mail->Password = "2B5NktXtMNuXhqT";
		$mail->SMTPSecure = "ssl";
		$mail->Port=465;
		$mail->SMTPKeepAlive = true; 
		$mail->Mailer = "smtp";
		$mail->setFrom("tuj54380@temple.edu", "Alex Michaelson");
		$mail->addReplyTo("tuj54380@temple.edu","Alex Michaelson");
		$msg = "Your authentication code is $Acode. Please complete the registration process on site.";
		$mail->addAddress($Email,"$FirstName $Last");
		$mail->Subject = "Welcome to Raehaan's Lab3.5";
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