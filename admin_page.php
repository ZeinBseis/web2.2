<?php include 'layout/header.php'; 
include 'lib/connection.php';
?>
<head>
		  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.css">
		  <style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>

<body style="background-image: url('img/admin.png');">

<?php

$sql = "SELECT id, firstname, lastname, email, location FROM users";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='customers'><tr><th>ID</th><th>Name</th><th>email</th><th>location</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>". $row["email"]."</td><td>". $row["location"] ."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

	<!-- <br>
	<form method="POST" action="admin_page.php">
	<div>
		<label style="width: 20%; margin-left: 50px" class="select">
    <select name="color1" >
      <option disabled="disabled" selected="selected"></option>
			<option value="#000000">Black</option>
      <option value="#0fa814">Green</option>
      <option value="#f7f204">Yellow </option>
			<option value="#f70000">Red </option>
			<option value="#2dd0ed">Light Blue </option>
			<option value="#2702f7">Dark Blue </option>
			<option value="#9306a3">Purple </option>
			<option value="#ff56e0">Pink </option>
			<option value="#f7b204">Orange </option>
			<option value="#FFFFFF">White </option>
			<option value="#774292">Brown</option>
    </select>
    <span class="select__label" for="select">Color 1</span>
  </label>

	<label style="width: 20%; margin-left: 50px" class="select">
    <select name="color2" >
      <option disabled="disabled" selected="selected"></option>
      <option value="#000000">Black</option>
      <option value="#0fa814">Green</option>
      <option value="#f7f204">Yellow </option>
			<option value="#f70000">Red </option>
			<option value="#2dd0ed">Light Blue </option>
			<option value="#2702f7">Dark Blue </option>
			<option value="#9306a3">Purple </option>
			<option value="#ff56e0">Pink </option>
			<option value="#f7b204">Orange </option>
			<option value="#FFFFFF">White </option>
			<option value="#774292">Brown</option>
    </select>
    <span class="select__label" for="select">Color 2</span>
  </label>

	<label style="width: 20%; margin-left: 50px" class="select">
		<select name="mapstyle" >
			<option disabled="disabled" selected="selected"></option>
			<option value="auto">Auto </option>
			<option value="regions">Regions </option>
			<option value="markers">Markers</option>
			<option value="text">Text </option>
		</select>
		<span class="select__label" for="select">Mapstyle</span>
	</label>

	<label style="width: 20%; margin-left: 50px" class="textfield">
				<input required="" style="width:;" name="country" type="" />
				<span class="textfield__label">Country</span>
			</label>

			<label style="width: 20%; margin-left: 50px" class="textfield">
				<input required="" style="width:;" name="stationid" type="" />
				<span class="textfield__label">Station-ID</span>
			</label>

   <input style="background-color:#0529F5;width: 20%; margin-left: 50px" class="cbc" type="submit" value="Save" />
  </form>
	</div> -->
</body> 
