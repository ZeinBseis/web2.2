<?php

$color1 = "2dd0ed";
$color2 = "#2702f7";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $newcolor1 = test_input($_POST["color1"]);
 $newcolor2 = test_input($_POST["color2"]);}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;}

 ?>
