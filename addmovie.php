<?php
    session_start();
    // Database Credentials
    $dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
    $dbuser = 'ba34f3f8d9d386';
    $dbpass = '6206b3d7';
    $dbname = 'heroku_f4436271c441c5d';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    
    if(isset($_POST['title']) ){
        $title = $_POST['title'];
        $synopsis = $_POST['synopsis'];
         
        //Make a Query with select to find a movie with matching title
        //NOTE: NEED TO ADD CODE TO CHECK OTHER DETAILS IN CASE OF DIFFERENT MOVIES WITH SAME TITLE
        $sql_query = "select * from movies WHERE title= '".$title."' limit 1";
        //capture the result of the query
        $result = mysqli_query($conn, $sql_query);

        //If result has a row, it found a movie with this title
        if(mysqli_num_rows($result) > 0){
            echo "This Movie title is already in the Database<br>";
            echo '<a href ="addmovie.php"> Want to add another movie? </a><br>';
        }
        //If nothing found, the movie can be inserted
        else{
            $sql = "INSERT INTO movies (movie_title, synopsis) 
            VALUES ('".$title."', '".$synopsis."')";
            
        }
    }
?>

<!DOCTYPE HTML>

<html>

    <body>
        <form method ="post" action = "#">
            Title:<br/>
            <input type="text" placeholder="Enter Title" name="title" required> <br/>
            Synopsis: <br/>
            <textarea rows = "5" cols = "50" name = "synopsis" placeholder="Enter Synopsis Here"></textarea>

            <br><button type="submit">Submit Movie</button>
        </form>
    </body>

</html>