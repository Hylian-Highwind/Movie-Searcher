<?php
    session_start();

    /*
    // Database Credentials
    $dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
    $dbuser = 'ba34f3f8d9d386';
    $dbpass = '6206b3d7';
    $dbname = 'heroku_f4436271c441c5d';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    */

    include 'DBConfig.php';
    
    
     if(isset($_POST['username']) ){
         $gaveuname = $_POST['username'];
         $gavepsw = $_POST['password'];
         $gaveconfpass = $_POST['confpassword'];
         //If the password and confirm password do not match
         if( !($_POST['password'] == $_POST['confpassword']) ){
             //Print an error message and do not go further with the script in this call
             echo '<a href ="signup.php"> Please make sure your entered passwords match </a><br>';
             exit();
         }
         //Make a Query to select one user from siteusers table in database that has a username matching the ones given by the form
         $sql_query = "select * from siteusers WHERE username= '".$gaveuname."' limit 1";
         //capture the result of the query
         $result = mysqli_query($conn, $sql_query);
         //If result has a row, it found a user with matching credentials
         if(mysqli_num_rows($result) > 0){
             echo "Username is taken <br>";
             echo '<a href ="signup.php"> Please use a different username </a><br>';
         }
         else{
             $sql = "INSERT INTO siteusers (username, user_password) 
             VALUES ('".$gaveuname."', '".$gavepsw."')";
             $insertresult = mysqli_query($conn, $sql);
             header("Location: login.php?signedup");
         }
 }
?>

<!DOCTYPE HTML>

<html>
    <head>

    <link rel="stylesheet" type="text/css" href="mystylesheet.css">

    </head>
    <body>
        <div class="Wrapper">
        <div class="submission">
        <form method ="post" action = "#">
            <label>Username: </label><br/>
            <input type="text" placeholder="Enter Username" name="username" required> <br/>
            
            <label>Password: </label><br/>
            <input type="password" placeholder="Enter Password" name="password" required> <br>
            
            <label>Confirm Password: </label><br/>
            <input type="password" placeholder="Confirm Password" name="confpassword" required> <br>
            
            <button type="submit">Login</button>
            <input type=button onClick="location.href='index.php'" value='Cancel'>

            <br><a href="login.php" class="LoginRedirect"> Already a user? Login here. </a>

        </form>
        </div>
        </div>
    </body>

</html>