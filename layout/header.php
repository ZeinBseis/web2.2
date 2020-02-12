<!-- mysql connection -->
<!-- <?php include 'lib/connection.php'; ?> -->
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SUSG</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.css">
<link rel="stylesheet" type="text/css" href="cutestrap/dist/css/custom.css">

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


<section class="navigation">
  <div class="nav-container">
    <div class="brand">
      <a href="#!"><img class="" style="height: 70px; width: 70px;" src="img/panda.png"></a>
    </div>
    <nav>
      <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
      <ul style="margin-right: -180px;" class="nav-list">
        <li>
          <a href="dashboard.php">Home</a>
        </li>
       <?php  if ($_SESSION['loggedin']['user_type']=='admin') {
			?>
			<li>
				<a href="admin_page.php">Admin Panel</a>
			</li>
			<?php
		}else{
			echo "";
		}; ?>
        
       <!--  <li>
          <a href="#!">Pricing</a>
        </li> -->
        <li>
          <a href="#!">Hello <?php echo $_SESSION['loggedin']['first_name'] ?></a>
          <ul class="nav-dropdown">
            <li>
              <a href="user_page.php?id=<?php echo $_SESSION['loggedin']['user_id']  ?>">Edit profile</a>
            </li>
            
          </ul>
        </li>
        <li>
          <a href="action/logout.php">Logout</a>
        </li>
      </ul>
    </nav>
  </div>
</section>



<!-- 
	<ul class="topnav">
		<li><a href="dashboard.php">Home</a></li>
		<li class="right"><a href="action/logout.php">Logout</a></li>
		<?php  if ($_SESSION['loggedin']['user_type']=='admin') {
			?>
			<li><a href="admin_page.php">Admin Panel</a></li>
			<?php
		}else{
			echo "";
		}; ?>
		<li class="dropdown right">
    <a href="javascript:void(0)" class="dropbtn">Hello <?php echo $_SESSION['loggedin']['first_name'] ?></a>
    <div class="dropdown-content">
      <a href="user_page.php?id=<?php echo $_SESSION['loggedin']['user_id']  ?>">Edit profile</a>
    </div>
  </li>
	</ul> -->
<script type="text/javascript">
	(function($) { // Begin jQuery
  $(function() { // DOM ready
    // If a link has a dropdown, add sub menu toggle.
    $('nav ul li a:not(:only-child)').click(function(e) {
      $(this).siblings('.nav-dropdown').toggle();
      // Close one dropdown when selecting another
      $('.nav-dropdown').not($(this).siblings()).hide();
      e.stopPropagation();
    });
    // Clicking away from dropdown will remove the dropdown class
    $('html').click(function() {
      $('.nav-dropdown').hide();
    });
    // Toggle open and close nav styles on click
    $('#nav-toggle').click(function() {
      $('nav ul').slideToggle();
    });
    // Hamburger to X toggle
    $('#nav-toggle').on('click', function() {
      this.classList.toggle('active');
    });
  }); // end DOM ready
})(jQuery); // end jQuery
</script>

</body>
