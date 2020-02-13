<?php
$servername = "localhost";
$username = "";
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