<?php
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        header("Location: login.php");
    }
?>

<h2> Login Successful </h2>

<h2><a href ="index.php"> Back to Home Page </a> </h2>
