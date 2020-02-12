<?php 
include('../lib/connection.php');
session_destroy();
header('Location: ../index.php');
 ?>
