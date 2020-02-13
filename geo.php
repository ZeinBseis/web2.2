<?php
session_start();
if( isset($_SESSION['loggedin'])) {
?>
<html>
<style type="text/css">
  
  .btn{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.btn4 {background-color: #e7e7e7; color: black;} /* Gray */ 
</style>
<a href=""></a>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taiwan Fertilizer Inc.</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="cutestrap/dist/css/custom.css">
<style type="text/css">
  
</style>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
<!-- new header starts here -->

<section class="navigation">
  <div class="nav-container">
    <div class="brand">
      <a href="#!"><img class="" style="height: 70px; width: 70px; margin-bottom: -230px;" src="img/ho.svg"></a>
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
<?php include 'lib/functions.php' ?>
  <script type='text/javascript' src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="regions_div" style="width: 1200; height: 680px;margin-bottom: px;"></div>

<?php

$countryid = [];
$row = 1;
// $stationid = [];
// $countries = [];
if (($handle = fopen("csv/stationid.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    if($row == 1){ $row++; continue; }
    $countryid[$data[0]] = $data[1];
  }
  fclose($handle);
}

// print_r($countryid);

// $countries = array('Australia', 'Austria', 'Canada', 'Germany', 'France', 'Japan', 'Netherlands', 'Taiwan', 'Thailand', 'US');
// $stationid = array(947670, 110350, 710347, 93850, 70020, 476710, 62600, 466920, 484550, 725090);

//TODO make funtion to import data lib/functions
// $dayID = 18298;
// $test = 405750;
// // $input = 'python -c "from getdata import getData; getData('.$test.", ".$dayID.')"';
// $command = escapeshellcmd('python -c "from getdata import getData; getData('.$test.", ".$dayID.')"');
// // $command = escapeshellcmd('python -c "from getdata import getData; getData(405750, 18298)"');
// shell_exec($command);
//###########################################


$countriesData = [];
$dayID = 18262+date('z');


foreach ($countryid as $id => $country){
  $command = escapeshellcmd('python -c "from getdata import getData; getData('.$id.", ".$dayID.')"');
  shell_exec($command);
  $weatherdata = get_weather($id, $dayID);
  $countriesData[$id] = [$country, $weatherdata[0], $weatherdata[1]];
}

// print_r($countriesData);
// print_r($countriesData[405750]);
$filelocation = 'xml/weatherdata.xml';
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
foreach ($countriesData as $id => $measurements) {
  $country = $xml_data->addChild('Country', $measurements[0]);
  $country->addChild('Temperature', $measurements[1]);
  $country->addChild('Humidity', $measurements[2]);
}
$result = $xml_data->asXML($filelocation);

/*
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
array_to_xml($countriesData, $xml_data);
$result = $xml_data->asXML('xml/weatherdata.xml');
*/

// $australia = get_weather($stationid[0], 1);
// $austria = get_weather($stationid[1], 1);
// $canada = get_weather($stationid[2], 1);
// $germany = get_weather($stationid[3], 1);
// $france = get_weather($stationid[4], 1);
// $japan = get_weather($stationid[5], 1);
// $netherlands = get_weather($stationid[6], 1);
// $taiwan = get_weather($stationid[7], 1);
// $thailand = get_weather($stationid[8], 1);
// $us = get_weather($stationid[9], 1);
?>




<?php  if ($_SESSION['loggedin']['user_type']=='admin') {?>
  <a href="xml/weatherdata.xml" download="weatherdata">
    <button class="btn btn4" type="submit" onclick=>Download XML</button>
  </a>
  <?php
}else{
  echo "";
}; ?>


<script type="text/javascript">

  google.charts.load('current', {
    'packages': ['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
  });
  google.charts.setOnLoadCallback(drawRegionsMap);
 function drawRegionsMap() {
   var countrydata = <?php echo json_encode($countriesData); ?>

   var data = google.visualization.arrayToDataTable([
     ['Country', 'Temperature', 'Humidity'],
     ['Australia',5,3],
     ['<?=$countries[1]; ?>',<?=$austria[0]; ?>,<?=$austria[1]; ?>],
     ['<?=$countries[2]; ?>',<?=$canada[0]; ?>,<?=$canada[1]; ?>],
     ['<?=$countries[3]; ?>',<?=$germany[0]; ?>,<?=$germany[1]; ?>],
     ['<?=$countries[4]; ?>',<?=$france[0]; ?>,<?=$france[1]; ?>],
     ['<?=$countries[5]; ?>',<?=$japan[0]; ?>,<?=$japan[1]; ?>],
     ['<?=$countries[6]; ?>',<?=$netherlands[0]; ?>,<?=$netherlands[1]; ?>],
     ['<?=$countries[7]; ?>',<?=$taiwan[0]; ?>,<?=$taiwan[1]; ?>],
     ['<?=$countries[8]; ?>',<?=$thailand[0]; ?>,<?=$thailand[1]; ?>],
     ['<?=$countries[9]; ?>',<?=$us[0]; ?>,<?=$us[1]; ?>],
   ]);

  // hier moeten variablen in komen

     var options = {
        //displayMode: 'markers', // if enable shows bullitpoints instead
        colorAxis: {colors: ['<?php echo "#2dd0ed"; ?>',  '<?php echo "#2702f7"; ?>']
        ,backgroundColor: '#81d4fa',
      }
   };

     var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));


     chart.draw(data, options);
   }
   google.load('visualization', '1', {packages: ['geochart'], callback: drawMap});
</script>
</body>
</html>
<?php include 'layout/footer.php' ?>
<?php
}else{
  echo "You do not have permession do view this part of the site";
  header( "refresh:2;url=index.php" );
}
 ?>
