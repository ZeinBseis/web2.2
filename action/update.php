 <?php
include('../lib/connection.php');	

// define variables and set to empty values
$firstname = $lastname = $location = $password = $role = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = test_input($_POST["firstname"]);
  $lastname = test_input($_POST["lastname"]);
  $location = test_input($_POST["location"]);
  $password = test_input($_POST["npassword"]);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $email= test_input($_POST["email"]);
  $usertype="user";
  $id = $_GET['id'];

}

$query = "UPDATE users SET firstname='$firstname' , lastname = '$lastname',  location = '$location' , password = '$password'
WHERE id= '$id'";
	
if ($mysqli->query($query) == true) {
  $_SESSION['message'] = "Success: Update was successfull";
	header( "refresh:2;url=../user_page.php?id=$id" );
}else{
  $_SESSION['message'] = "Error: Update went wrong";
	header( "refresh:2;url=../user_page.php?id=$id" );
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>