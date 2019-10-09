<?php
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        header("Location: login.php");
    }
?>

<!DOCTYPE HTML>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="mystylesheet.css">

    </head>
    <body>
        <div class ="Wrapper">
        <div class ="submission">
            <h2> Already Logged In </h2>

            <h2><a href ="index.php"> Back to Home Page </a> </h2>
        </div>
        </div>
    </body>

</html>
