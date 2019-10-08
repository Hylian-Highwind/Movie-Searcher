<?php
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        header("Location: login.php");
    }
?>

<h2> Already Logged In </h2>

<h2><a href ="index.php"> Back to Home Page </a> </h2>