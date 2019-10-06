<?php

    // Include config file
    require_once "DBconfig.php";
 
    // Define variables and initialize with empty values
    $username = $password  = "";
    $username_err = $password_err = "";

    // Process the Form Data submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        }
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } else{
            $password = trim($_POST["password"]);
        }
    }
    // Check that input is not empty
    if(empty($username_err) && empty($password_err) ){
        
        // Select user from the siteusers table where the entered username and password both match one for a registered user
        $usermatch = Select * from siteusers where ($username = username && $password = user_password);

        // Attempt to Redirect to Homepage if login successful
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            header("location: index.html");
        } else{
            echo "Something went wrong. Please try again later.";
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }    

?>