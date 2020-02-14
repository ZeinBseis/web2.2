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
 	<a href="data.php?id=403560">  <img class="half-page-image" src="img/3.PNG"></a>
  <a href="geo.php"> <img class="half-page-image" src="img/4.png"></a>
  <?php convert(); ?>
  <a href="csv/weatherData.xml" download>
    <img src="img/download.png" style="position:relative;left:800px;width:300px"></img>
  </a> 
       
  </div>

  
</body>

<?php include 'layout/footer.php' ?>
<?php

}else{
  echo "You do not have permession do view this part the site";
  header( "refresh:2;url=index.php" );
}
?>
