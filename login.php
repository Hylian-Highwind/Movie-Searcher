<?php
    session_start();

    $dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
    $dbuser = 'ba34f3f8d9d386';
    $dbpass = '6206b3d7';
    $dbname = 'heroku_f4436271c441c5d';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(isset(['username'])){
        $gaveuname = $_POST['username'];
        $gavepsw = $_POST['password'];

        //Make a Query to select one user from siteusers table in database that has a username and password matching the ones given by the form
        $sql_query = "select Count(*) from siteusers WHERE username= '".$gaveuname."'AND user_password='".$gavepsw."'";

        //capture the result of the query
        $result = mysqli_query($conn, $sql_query);
        
        //If result has a row, it found a user with matching credentials
        if($result === 1){
            $_SESSION['logged_in'] = true;
            header ("Location: loginsuccess.php");
        }
        else{
            header ("Location: login.php");
        }
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
