<?php 


    echo "Logged in ".$_SESSION['logged_in']."<br>";
    echo "Successfully loaded <br>";

    if(isset($_POST['reviewSubmit'])){

        echo "Review submitted <br>";
        //Only allow a user to submit a review if they are logged in
        if(isset($_SESSION['logged_in'])){
            
            echo "Logged in <br>";
            $user = $_POST['username'];
            $score = $_POST['score'];
            $comment = $_POST['comment'];

            //SELECT from the movie_reviews to find if a review is recorded for this user AND this movie_id
            $sql_query = "select * from movie_reviews WHERE username= '".$user."' AND movie_id= '".$movieid."' limit 1";
            //capture the result of the query
            $result = mysqli_query($conn, $sql_query);
            echo mysqli_num_rows($result);
            //If result has a row, this user has submitted a review already
            if(mysqli_num_rows($result) > 0){
                echo "Found a review by you already";
            }
            else{
                //Insert into the movie_reviews table (username, movie_id, score, movie_comment)
                $sql = "INSERT INTO movie_reviews 
                VALUES ('".$user."', '".$movieid."', '".$score."', '".$comment."')";
                $insertresult = mysqli_query($conn, $sql);
                
                header("Location: Avengers.php");
            }

        }
        /*
        else{
            echo "Please Login to submit a review";
            header ("Location: login.php?notLoggedIn");
        }
        */

    }


?>