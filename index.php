<?php include 'layout/header_no_toolbar.php';
 ?>
<?php include 'lib/functions.php' ?>

<body style="background-image: url('img/2.jpg')">
<div style="margin-left:250px;" >
	<img style="padding-top:-70px;" src="img/ho.svg" alt="" height="200px;">
</div>

<div style="margin-top: -50px;" class="container"   >
	<p style="text-align:center;"></p>
		<form method="POST" action="action/login.php">
			<label class="textfield">
				<input name="email" required="" type="text" />
				<span class="textfield__label">Email</span>
			</label>

			<label class="textfield">
				<input style="width:;" required="" name="password" type="password" />
				<span class="textfield__label">Password</span>
		    </label>
		    <?php
		if (isset($_SESSION['message'])) {
			echo '<div class="alert alert-danger">';
			// echo   $_SESSION['message'];
			echo "<p style='color:blue'>" . $_SESSION['message'] . "</p>";
			echo '</div>';
			$_SESSION['message'] = null;
		}
	 ?>

			
			<input style="background-color:#0529F5" class="cbc" type="submit" value="Login" />
			<a style="color:#5BBF21;" href="register.php">Signup</a> <br/>
		</form>
</div>
<!-- <p style="" ></p> -->
</body>

<?php include 'layout/footer.php' ?>
