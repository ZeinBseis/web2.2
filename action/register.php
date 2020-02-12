 <?php
include('../lib/connection.php');	

// define variables and set to empty values
$firstname = $lastname = $location = $password = $role = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = test_input($_POST["firstname"]);
  $lastname = test_input($_POST["lastname"]);
  $location = test_input($_POST["location"]);
  $password = test_input($_POST["password"]);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $email= test_input($_POST["email"]);
  $usertype="user";


}

$query="INSERT INTO users VALUES (null, '$firstname','$lastname','$location','$password','$email','$usertype')";
	
if ($mysqli->query($query) == true) {
  $_SESSION['message'] = "Success: User creation was successfull";
	header( "refresh:2;url=../index.php" );
}else{
  $_SESSION['message'] = "Error: Something went wrong while creating the user";
	header( "refresh:2;url=../register.php" );
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>