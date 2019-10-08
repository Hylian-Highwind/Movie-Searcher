<?php
// Database Credentials
$dbhost = 'us-cdbr-iron-east-05.cleardb.net:3306';
$dbuser = 'ba34f3f8d9d386';
$dbpass = '6206b3d7';
$dbname = 'heroku_f4436271c441c5d';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>