<?php 
    session_start();

    if($_SESSION['isAdmin'] == false){
        header("Location: accessDenied.php");    
    }

    /*
    // Database Credentials
    $dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
    $dbuser = 'ba34f3f8d9d386';
    $dbpass = '6206b3d7';
    $dbname = 'heroku_f4436271c441c5d';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    */

    include 'DBConfig.php';

    //echo "Starting File Check <br>";

    //Checks if the title of the movie has been set
    if(isset($_POST['title']) ){
        //echo "Inside if statement <br>";
        
        //Does various checks for adding the image file
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTMPName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        //Get and make lowercase the file's extension
        $fileExt = explode('.', $fileName);
        $fileActualExt =strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        //check if file's lowercase extension is one that is allowed
        if(in_array($fileActualExt, $allowed)){
            //Confirm no error in file
            if($fileError === 0){
                //Limit file size to 500 kb
                if($fileSize < 1000000){                    
                    //Set Destination to the server's img folder
                    $fileDestination = 'img/'.$fileName;
                    
                    //Gets the title and synopsis from the form submitted
                    $title = $_POST['title'];
                    $synopsis = $_POST['synopsis'];

                    //replace to add slashes before single quotes and ensure their inclusion in Title or Synopsis
                    $title = str_replace("'", "\'", $title);
                    $synopsis = str_replace("'", "\'", $synopsis);
                    
                    //Make a Query with select to find a movie with matching title
                    //NOTE: Currently cannot handle different movies with identical titles given
                    $sql_query = "select * from movies WHERE movie_title= '".$title."' limit 1";
                    //capture the result of the query
                    $result = mysqli_query($conn, $sql_query);

                    //If result has a row, it found a movie with this title
                    if(mysqli_num_rows($result) > 0){
                        echo "<br>This Movie title is already in the Database<br>";
                        echo '<a href ="newMovieInfo.php?alreadyIn"> Want to add another movie? </a><br>';
                        exit();
                    }

                    //If nothing found, the movie can be inserted. Move uploaded file into destination folder and insert this movie row
                    else{
                        //Make sure fileDestination has a value
                        if($fileDestination){
                            move_uploaded_file($fileTMPName, $fileDestination);
                            $sql = "INSERT INTO movies (movie_title, poster_path, synopsis) 
                            VALUES ('".$title."', '".$fileDestination."', '".$synopsis."')";
                            
                            $insertResult = mysqli_query($conn, $sql);                           
                            
                            header("Location: index.php?uploadsuccess");

                        }           
                        
                    }

                }
                else{
                    echo "File is too large";
                    //header("Location: newMovieInfo.php?failedupload");
                    exit();
                }                
            }
            else
            {
                echo "Error Uploading File";
                //header("Location: newMovieInfo.php?failedupload");
                exit();
            }
        }
        else{
            echo "Ineligible File Type";
            //header("Location: newMovieInfo.php?failedupload");
            exit();
        }

        //echo "Passed File check<br>";
        
        
    }


?>

<!DOCTYPE HTML>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="mystylesheet.css">

        <style>
            
        </style>
    </head>
    <body>
        <div class ="Wrapper">
            <div class ="submission">    
                <form id="submission" method ="post" action = "#" enctype="multipart/form-data">
                    <label>Title: </label><br/>
                    <input type="text" placeholder="Enter Title" name="title" required> <br/>
                    <label>Synopsis: </label><br/>
                    <textarea rows = "5" cols = "50" name = "synopsis" placeholder="Enter Synopsis Here"></textarea> <br/>
                    
                    <input type= "file" name="file" required> <br>

                    <br><button type="submit">Submit Movie</button>
                </form>
                <br>
                <input type=button onClick="location.href='index.php'" value='Home'>
            </div>
        </div>
    </body>

</html>
