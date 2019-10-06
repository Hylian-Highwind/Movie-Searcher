<?php
    session_start();
    $username = "kring";
    $password = "ringabel";

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
        header("Location: index.php");
    }
    
    if(isset($_POST['username']) && isset($_POST['password']) ){
        if($_POST['username'] == $username && $_POST['password'] == $password){
            $_SESSION['logged_in'] = true;
            header ("Location: index.php");
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
