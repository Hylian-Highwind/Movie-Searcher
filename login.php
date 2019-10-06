<?php
    session_start();
        
    /* Database credentials. */
    define('DB_SERVER', 'us-cdbr-iron-east-05.cleardb.net');
    define('DB_USERNAME', 'ba34f3f8d9d386');
    define('DB_PASSWORD', '6206b3d7');
    define('DB_NAME', 'heroku_f4436271c441c5d');
    
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $gaveuname = $_POST['username'];
    $gavepsw = $_POST['password'];

    //Make a Query to select one user from siteusers table in database that has a username and password matching the ones given by the form
    $sql_query = "select * from siteusers WHERE username= '".$gaveuname."'AND user_password='".$gavepsw.
    "'limit 1";

    //capture the result of the query
    $result = mysqli_query($sql_query);
    
    //If result has a row, it found a user with matching credentials
    if(my_sqli_num_rows($result) == 1){
        $_SESSION['logged_in'] = true;
        header ("Location: loginsuccess.php");
    }
    else{
        header ("Location: login.php");
    }
?>

<!DOCTYPE HTML>

<html>

    <body>
        <form method = "post">
            Username:<br/>
            <input type="text" placeholder="Enter Username" name="username" required> <br/>
            Password: <br/>
            <input type="password" placeholder="Enter Password" name="password" required> <br>
            
            <button type="submit">Login</button>
        </form>
    </body>

</html>
