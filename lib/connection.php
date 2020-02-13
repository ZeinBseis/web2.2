<?php
$servername = "localhost";
<<<<<<< HEAD
$username = "";
=======
$username = "root";
>>>>>>> 34820837649280d874857903d6f6195a52a1a594
$password = "";
$dbname = "test";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// echo "Connected successfully";
?>