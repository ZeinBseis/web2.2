<?php include 'layout/reg_header.php' ?>

<div style="" class="container"   >
	<form method="POST" action="action/register.php">
	  <label class="textfield">
	    <input required="" name="firstname" type="text" />
	    <span class="textfield__label">Firstname</span>
	  </label>
	  	<label class="textfield">
	    <input style="width:;" name="lastname" type="text" />
	    <span class="textfield__label">Lastname</span>
	  </label>
	  <label class="textfield">
	    <input style="width:;" name="location" type="text" />
	    <span class="textfield__label">Location</span>
	  </label>
	  <label class="textfield">
	    <input style="width:;" name="email" type="email" />
	    <span class="textfield__label">Email</span>
	  </label>
	  <label class="textfield">
	    <input required="" style="width:;" name="password" type="password" />
	    <span class="textfield__label">Password</span>
	  </label>
	  <label class="textfield">
	    <input required="" style="width:;" name="vpassword" type="password" />
	    <span class="textfield__label">Verify Password</span>
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
	  <input style="background-color:#0529F5" class="cbc" type="submit" value="Register" />
	</form>
</div>


<?php include 'layout/footer.php' ?>
