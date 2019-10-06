<?php
    session_start();
    /*
    $username = "kring";
    $password = "ringabel";

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
        header("Location: alreadyin.php");
    }
    
    if(isset($_POST['username']) && isset($_POST['password']) ){
        if($_POST['username'] == $username && $_POST['password'] == $password){
            $_SESSION['logged_in'] = true;
            header ("Location: loginsuccess.php");
        }
    }
    */
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
