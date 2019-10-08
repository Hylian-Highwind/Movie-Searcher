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
    /*
    $dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
    $dbuser = 'ba34f3f8d9d386';
    $dbpass = '6206b3d7';
    $dbname = 'heroku_f4436271c441c5d';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    */
    
    include 'DBConfig.php';

    
    if(isset($_POST['username'])){
        $gaveuname = $_POST['username'];
        $gavepsw = $_POST['password'];
        //Make a Query to select one user from siteusers table in database that has a username and password matching the ones given by the form
        $sql_query = "select * from siteusers WHERE username= '".$gaveuname."'AND user_password='".$gavepsw."' limit 1";
        //capture the result of the query
        $result = mysqli_query($conn, $sql_query);
        
        //If result has a row, it found a user with matching credentials
        if(mysqli_num_rows($result) > 0){
            $_SESSION['logged_in'] = true;
            
            //Set the username logged in with as a SESSION variable
            $_SESSION['username'] = $gaveuname;
            $_SESSION['isAdmin'] = (mysqli_fetch_array($result))['admin_flag'];
            header ("Location: loginsuccess.php");
        }
        else{
            echo "Failed to Login";
            header ("Location: login.php");
        }
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
        <form method ="post" action = "#">
            <label>Username: </label><br/>
            <input type="text" placeholder="Enter Username" name="username" required> <br/>
            <label>Password: </label><br/>
            <input type="password" placeholder="Enter Password" name="password" required> <br>
            
            <button type="submit">Login</button>
            <input type=button onClick="location.href='index.php'" value='Cancel'>
            
            <br><a href="signup.php" class="LoginRedirect"> New User? Sign Up Here. </a>
        </form>
        </div>
        </div>
    </body>

</html>