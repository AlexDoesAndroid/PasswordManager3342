<?php
    session_start();
    if(!isset($_SESSION["RegState"])){
        $_SESSION["RegState"] = 0;
    }
    // All session vars available at this point.
    echo json_encode($_SESSION);
    exit();
?>