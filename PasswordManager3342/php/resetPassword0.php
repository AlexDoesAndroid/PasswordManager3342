<?php
    session_start();
    $_SESSION["RegState"] = 5;
    header("location:../login.html");
    exit();
?>