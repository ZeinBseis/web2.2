<?php include 'layout/header.php';
      include 'lib/functions.php';

if( isset($_SESSION['loggedin'])) {
?>


<link rel="stylesheet" type="text/css" href="cutestrap/dist/css/cutestrap.min.css">

<head>
	<style>


  .half-page-image {
max-width: 50%;
margin-left: auto;
margin-right: auto;
display: Inline-block;
height: 500px; 
}

.parent{
	 text-align:center;
}
	</style>
<?php echo"<br>" ?>
</head>

<body>
 <div style="" class="parent">
 	<a href="data.php">  <img class="half-page-image" src="img/3.png"></a>
  <a href="geo.php"> <img class="half-page-image" src="img/4.png"></a>

  <div>
  <form action="dashboard.php" method="POST">
  <?php
    if (isset($_POST['appetizer_button'])) {
      convert();
      echo "<a href='csv/weatherData.xml' download>";
  }
   ?>
  <button name="appetizer_button" type="button" class="btn btn-secondary" style="float:center;background-color: #4CAF50;"> 
  Download Data
  </button>
  <?php
    if (isset($_POST['appetizer_button'])) {
      echo "</a>";
  }
   ?>
  </form>
  </div>
       
  </div>

  
</body>

<?php include 'layout/footer.php' ?>
<?php

}else{
  echo "You do not have permession do view this part the site";
  header( "refresh:2;url=index.php" );
}
?>
