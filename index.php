<?php
    session_start();

    /*
    // Database Credentials
    $dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
    $dbuser = 'ba34f3f8d9d386';
    $dbpass = '6206b3d7';
    $dbname = 'heroku_f4436271c441c5d';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    */

    include 'DBConfig.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystylesheet.css">
</head>

<body>

    <div style ="text-align: center">
    <div class="Links">
        <h2> Login to an Account Here </h2>
        <button type="button" class="RedirectButton" onClick="location.href='login.php'">Login</button>
        
        <h2> Create an Account Here </h2>
        <button type="button" class="RedirectButton" onClick="location.href='signup.php'">Sign Up</button>

        <h2> Add a Movie Here </h2>
        <button type="button" class="RedirectButton" onClick="location.href='newMovieInfo.php'">Submit a Movie</button>

        <h2> Logout of your Account Here </h2>
        <button type="button" class="RedirectButton" onClick="location.href='logout.php'">Logout</button>
    </div>
    </div>


    <!-- Wrapper around the area of the home page dedicated to the search functionality for movies in the database-->
    <div class = "Wrapper" style="text-align: center">
        <div class="Homepage-Search-Area">
        <p> <font size = 6 face="Arial Black"> Welcome to the homepage. Here you can search through movies. </font></p>

        <!--<a href="Avengers.html"> Go to Avengers Page for Testing </a> <br> -->

        <label for="Movie_Search" >Search for a movie</label><br>
        <input type="text" id="Movie_Search" value=""> <br>
        <a href='' onclick = "this.href = document.getElementById('Movie_Search').value +'.php'">Go to Movie's Page</a> <br>
        <button type="button" class="RedirectButton" 
        onClick= "location.href = document.getElementById('Movie_Search').value +'.php'">Go to Movie</button>
        
        <!-- Messing with Search Functionality-->
        
        <form action ="index.php" method="post">
                <input type="text" name ="search" placeholder="Search for Movie Title">
                <br><button type="submit" value ="Search" >Search</button>

        </form>
    </div>
    </div>

    <div class = "Wrapper" style="text-align: Center">
        <div class="Homepage-Movie-List" >
            <h2 id ="searchResultHead">Movies</h2>
        
        <!-- Search PHP code-->
        <table class = "searchTable">
        <thead>
            <th>Poster</th>
            <th>Title</th>
        </thead>
        <tbody>
           
            <?php    
            //Collect Search term to use for query
            if(isset($_POST['search'])){
            //Get the search term
            $searchTerm = $_POST['search'];
            
            $query = mysqli_query($conn, "SELECT * from movies WHERE movie_title LIKE '%$searchTerm%'");
            $count = mysqli_num_rows( $query);
            if($count == 0){
                echo "There were no search results";
            }
            else{
                while($row = mysqli_fetch_array($query) ){ ?>
                    <tr>             
                    <td><img src= <?php echo $row['poster_path']; ?> class="previewImage"> </td>       
                    <!--<td><?php //echo $row['poster_path'];?></td> -->
                    <td> <a href= "movieDetails.php?title=<?php echo $row['movie_title'];?>"> <?php echo $row['movie_title'];?> </a></td>
                    </tr>
                <?php  }
                
                }
            } ?>                
                                
        </tbody>

    </table>
        <!--End Search code--> 

        </div>
    <div>
</body>

</html>