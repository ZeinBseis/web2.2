<?php include 'layout/header.php' ?>
<?php include 'lib/functions.php' ?>
<head>
		  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.css">
		  <link rel="stylesheet" type="text/css" href="cutestrap/dist/css/custom.css">

</head>

<body>
<?php 
$id = $_GET['id'];
// prepare the sql query
$query = "SELECT * from users where id = $id";
// run the query and save it in a  result variable
$result = $mysqli->query($query);
	// if you have more then 1 result frmo your query keep going
	if ($result->num_rows > 0) {
		// get all the row content (column content) and save it as a row variable
		while($row = $result->fetch_assoc()) {
			$firstname = $row['firstname'];
			$lastname= $row['lastname'];
			$location= $row['location'];
			$email= $row['email'];
		}
	} else {
		// if there was less then 1 result found, return this error.
		echo "users found.";
	}

 ?>
	<div style="" class="container"   >
		<form method="POST" action="action/update.php?id=<?=$id ?> ">
		  <label class="textfield">
		    <input required="" name="firstname"  value="<?=$firstname ?>" type="text" />
		    <span class="textfield__label">Firstname</span>
		  </label>
		  	<label class="textfield">
		    <input style="width:;" value="<?= $lastname ?>" name="lastname" type="text" />
		    <span class="textfield__label">Lastname</span>
		  </label>
		  <label class="textfield">
		    <input style="width:;" value="<?= $location ?>" name="location" type="text" />
		    <span class="textfield__label">Location</span>
		  </label>
		  <label class="textfield">
		    <input style="width:;" value="<?= $email ?>" name="email" type="email" />
		    <span class="textfield__label">Email</span>
		  </label>
		  <label class="textfield">
		    <input required="" style="width:;" value="*******" name="password" type="password" />
		    <span class="textfield__label">Old Password</span>
		  </label>
		  <label class="textfield">
		    <input required="" style="width:;" name="npassword" type="password" />
		    <span class="textfield__label">New Password</span>
		  </label>
		  <?php 
		if (isset($_SESSION['message'])) {
			echo '<div class="alert alert-danger">';
			// echo   $_SESSION['message'];
			echo "<p style='color:blues'>" . $_SESSION['message'] . "</p>";
			echo '</div>';
			$_SESSION['message'] = null;
		}
	 ?>
		  <br/>
		  <input style="background-color:#0529F5" class="cbc" type="submit" value="Save Changes" />
		</form>
	</div>

</body>
