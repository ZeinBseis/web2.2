<!-- mysql connection -->
<?php include 'lib/connection.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SUSG demo</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.min.css">
<link rel="stylesheet" type="text/css" href="cutestrap/dist/css/custom.css">
  
	<ul class="topnav">
		<li><a href="dashboard.php">Home</a></li>
		<li class="right"><a href="action/logout.php">Logout</a></li>
		<li class="right"><a href="#about">Hello <?php echo $_SESSION['user']['user_name'] ?></a></li>
	</ul>


</body>