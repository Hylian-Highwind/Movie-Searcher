<?php
    session_start();

    //Unset the Session variables for the username 
    //Then Destroy the Session
    session_unset();
    session_destroy();    

?>

<!DOCTYPE HTML>
    
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="mystylesheet.css">

    </head>
    <body>
        
    <div style ="text-align: center">
        <div class="submission" >
            <h1>Logged out successfully</h1>

            <br>
            <input type=button onClick="location.href='index.php'" value='Back to Homepage'><br>
            <br>
            <input type=button onClick="location.href='login.php'" value='Login to another account?'>
            <br>
            <br> <a href="signup.php" class="LoginRedirect"> New User? Sign Up Here. </a>

        </div>
    </div>
    </body>

</html>
