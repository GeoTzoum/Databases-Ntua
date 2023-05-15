<?php
/* Database credentials. Assuming you are running MySQL
server with default setting  */
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'team O');
define('DB_PASSWORD', 'project_team_O');
define('DB_NAME', 'hotel_gnd');

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
