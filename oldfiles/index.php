<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="mystylesheet.css">

    <style>
    
    </style>
</head>

<body>

<h1> Hello World! </h1>

    <h2><a href ="login.php"> Login Link</a></h2>
    
    <h2> <a href ="signup.php"> Create an Account Here </a> </h2>

<div class = "Wrapper" style="text-align: center">
    <div class="Homepage-Search-Area">
    <p> <font size = 6 face="Arial Black"> Welcome to the homepage. Here you can search through movies. </font></p>

    <a href="Avengers.html"> Go to Avengers Page for Testing </a> <br>

    <label for="Movie_Search" >Search for a movie</label><br>
    <input type="text" id="Movie_Search" value="Avengers"/> <br>
    <a href='' onclick = "this.href = document.getElementById('Movie_Search').value +'.html'">Go to Movie's Page</a>
    </div>
</div>

<div class="Homepage-Movie-List">
    <h3>Movies</h3>
</div>
</body>

</html>
