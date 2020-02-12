<!-- mysql connection -->
<?php include 'lib/connection.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<link rel="stylesheet" type="text/css" href="cutestrap/dist/css/custom.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.min.css">

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


	<ul class="topnav">
		<li><a href="index.php">Back to login</a></li>
		<?php  if ($_SESSION['loggedin']['user_type']=='admin') {
			?> 
			<li><a href="admin_page.php">Admin Panel</a></li>
			<?php
		}else{
			echo "";
		}; ?> 
	</ul>

</body>
