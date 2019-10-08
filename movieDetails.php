<?php 
    session_start();
    
    include 'DBConfig.php';

    //The name of the page, which should match this movie's movie_title in the movies Table
    $page = $_GET['title'];


    //Find the Movie associated with this Page in the movies table
    $sql_query = "select * from movies WHERE movie_title= '".$page."' limit 1";
    $result = mysqli_query($conn, $sql_query);

    if(mysqli_num_rows($result) > 0){
        //Get the result's row as an associative array
        $row = mysqli_fetch_assoc($result);
        
        $title = $row["movie_title"];
        $poster = $row["poster_path"];
        $synopsis = $row["synopsis"];
        $movieid = $row["movie_id"];


        //Get the Average score across all reviews associated with this movie_id
        $AVEquery = "Select AVG(movie_reviews.score) AS 'average_score' from movie_reviews where movie_id= '".$movieid."' 
        GROUP BY movie_reviews.movie_id";
        $AVEresult = mysqli_query($conn, $AVEquery);
        $AVErow = mysqli_fetch_assoc($AVEresult);
        //Round the Average Score Float to 1 decimal place
        $averagescore = 0;
        $averagescore = round($AVErow['average_score'], 1);
        
        //If no Scores have been submitted, display a dash instead of 0
        if($averagescore == 0){
            $averagescore ='-';
        }

    }
    else{
        echo "Couldn't find the movie";
    }
    
    

    
    //Handles Review Submission
    if(isset ($_POST['reviewSubmit']) ){
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
        
        else{
            echo "Please Login to submit a review";
            header ("Location: login.php?notLoggedIn");
        }
        

    }

?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="mystylesheet.css">

    <style>
        body{
            font-family: "Cambria", sans-serif;
        }
    </style>
    <script>
        function goBack() {
            window.history.back()
        }
</script>
</head>

<body>

<div class = "Movie-Stuff">
    <img src=<?php echo $poster ?> class = "Page-Poster">
    <div class = "Movie-Info">
        <!-- Display the title by echoing the title variable retrieved from the database-->
        <p class = "Info-Title"> Title: <?php echo $title ?></p>
        <p class="Synopsis"> <?php echo $synopsis ?> </p>
        <p class = "Score"> Average Score: <?php echo $averagescore ?>/5</p>
        
    </div>

</div>

<div class ="Review-Section">
<button onClick="location.href='index.php'" value='Home'>Home</button>
    <div class="Wrapper">
        <div id="reviewSubmissionDiv">
        <form action= "" 
        id = "reviewForm" Method = "POST">
            <input type="hidden" name="username" value= <?php echo $_SESSION["username"] ?> >
            
            <label>Score</label> <br>
            <div id="scoreEnterDiv">
            <input id ="scoreEntry" type="number" name="score" min="1" max="5"> <span style ="font-size: 1.25em; font-weight: bold">/5</span>
            </div>
            <br>
            <br>
            <textarea name="comment"></textarea><br>
            <button type="submit" name ="reviewSubmit"> Post Review! </button>
        </form>

        </div>
    </div>
    <br>
    <table class = "Review-Table">
        <thead>
            <th>Username</th>
            <th>Review Score</th>
            <th>Comment</th>
        </thead>
        <tbody>
            <?php 
                //Query for the reviews with an id matching this movie's
                $sql_reviews_query = "Select * from movie_reviews WHERE movie_id = '".$movieid."' ORDER BY username";
                $review_query_results = mysqli_query($conn, $sql_reviews_query);
                while($review = mysqli_fetch_assoc($review_query_results) ){ ?>
                    <tr>
                    <td><?php echo $review['username'];?></td>
                    <td><?php echo $review['score'];?></td>
                    <td><?php echo $review['movie_comment'];?></td>
                    </tr>
               <?php  } ?>
        </tbody>

    </table>

</div>

</body>

</html>
