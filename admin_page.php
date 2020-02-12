<?php include 'layout/header.php' ?>
<head>
		  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.css">
</head>

<body>
	<br>
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
	</div>
</body>
