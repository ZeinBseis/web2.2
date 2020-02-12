
<?php 
// load datab connection
include('../lib/connection.php');	

$email = $_POST['email'];
$password = $_POST['password'];
$selectUsernameQuery= "SELECT * FROM users WHERE email ='$email' ";
   
$selectUsernameQueryResult = $mysqli ->query($selectUsernameQuery);
if  ($selectUsernameQueryResult->num_rows >0) {
     // user exists 
 $userExists = true;
 }else{
 $userExists = false;
 }  
 if ($userExists){
// -- check if user exsists
 	$row= $selectUsernameQueryResult -> fetch_assoc();
 	$userId = $row['id'];
 	$firstname = $row['firstname'];
 	$lastname = $row['lastname'];
 	$userpassword = $row['password'];
 	$email = $row['email'];
 	$location= $row['location'];
 	$user_type = $row['user_type'];
 	
 	if (password_verify ($password, $userpassword)){
 		echo 'password is valid!';
   		header("Location: ../dashboard.php");
   
 $_SESSION['loggedin'] = ['authenticated' =>true, 'first_name' => $firstname,'last_name' =>$lastname, 'email' =>$email,'location'=> $location ,'user_id' => $userId , 'user_type'  => $user_type,];

 $_SESSION['colors']= ['black'=> '#000000','blue' => '#2702f7','green'=> '#32CD32','yellow'=>'#FFFF00'];
 		
	} else{
		$_SESSION['message'] = "Error: Invalid Password";
		header( "refresh:1;url=../index.php" );
	}
}else{
	//display login error page
	// echo "user does not exist";
	$_SESSION['message'] = "Error: User does not exists";
	header( "refresh:1;url=../index.php" );
}
   // header("Location: ../logged.php");
  
 
?>