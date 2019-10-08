<?php
/* Database credentials. */
define('DB_SERVER', 'us-cdbr-iron-east-05.cleardb.net');
define('DB_USERNAME', 'ba34f3f8d9d386');
define('DB_PASSWORD', '6206b3d7');
define('DB_NAME', 'heroku_f4436271c441c5d');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
