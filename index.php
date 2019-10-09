<?php
    session_start();
    
    include 'DBConfig.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystylesheet.css">
</head>

<body>
<div class="Wrapper" style ="position: relative;">
    <div style ="text-align: center">
        <div class="Links">
            <h2>LINKS</h2>

            <!--PHP used to only display buttons needed when or when not logged in.-->
            <?php
            if(isset($_SESSION['logged_in'])){
                echo "<label> Add a Movie Here </label><br>
                <button type='button' class='RedirectButton' onClick='location.href=&quot;newMovieInfo.php&quot;'>Submit a Movie</button>

                <br><label> Logout Here </label><br>
                <button type='button' class='RedirectButton' onClick='location.href=&quot;logout.php&quot;'>Logout</button>";
            }
            else{
                echo"<label> Login Here </label><br>
                <button type='button' class='RedirectButton' onClick='location.href=&quot;login.php&quot;'>Login</button>
                
                <br><label> Create an Account Here </label><br>
                <button type='button' class='RedirectButton' onClick='location.href= &quot;signup.php&quot;'>Sign Up</button>";
            }
            
            ?>
            
        </div>
    </div> 
</div>

    <!-- Wrapper around the area of the home page dedicated to the search functionality for movies in the database-->
    <div class = "Wrapper" style="text-align: center">
        
        <div class="Homepage-Search-Area">        

            <p> <font size = 6 face="Arial Black"> Welcome to the homepage. Here you can search through movies. </font></p>

            <label for="Movie_Search" >Search for a movie</label><br>
                
            <!-- Search Functionality-->
            
            <form action ="index.php" method="post">
                    <input type="text" name ="search" placeholder="Search for Movie Title">
                    <br><button type="submit" class="RedirectButton" value ="Search" >Search</button>
            </form>
        </div>
        
    </div>


    <div class = "Wrapper" style="text-align: center">
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
                            <td><a href= "movieDetails.php?title=<?php echo $row['movie_title'];?>">
                            <img src= <?php echo $row['poster_path']; ?> class="previewImage"> </a></td>       
                            
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
