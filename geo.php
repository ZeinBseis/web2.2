<?php
include 'layout/header.php';
if( isset($_SESSION['loggedin'])) {
?>

<?php include 'lib/functions.php' ?>
  <!-- <script type='text/javascript' src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="regions_div" style="width: 1200; height: 680px;margin-bottom: px;"></div> -->

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
//TODO
$dayID = 18262+date('z')-1;


foreach ($countryid as $id => $country){
  $command = escapeshellcmd('python -c "from getdata import getData; getData('.$id.", ".$dayID.')"');
  shell_exec($command);
  $weatherdata = get_weather($id, $dayID);
  $countriesData[$id] = [$country, $weatherdata[0], $weatherdata[1]];
}

// print_r($countriesData);
// print_r($countriesData[405750]);
// echo($countriesData[405750][1]);
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

?>

<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
  google.charts.setOnLoadCallback(drawRegionsMap);
 function drawRegionsMap() {
   var data = google.visualization.arrayToDataTable([
     ['Country', 'Temperature', 'Humidity'],
     ['FalseData', 0, 0],
    <?php
      foreach ($countriesData as $id => $country) {
        echo "['".$countriesData[$id][0]."', '".$countriesData[$id][1]."', '".$countriesData[$id][2]."'],";
      }
      // $countriesData[405750][1])
    ?>
   ]);
   var options = {
        colorAxis: {colors: ['blue', 'lightblue', 'orange']}
      };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);

} 
  //  google.load('visualization', '1', {packages: ['geochart'], callback: drawMap});
</script>
  </head>
<body>
    <div id="regions_div" style="width: 1200px; height: 800px;"></div>
  </body>
</body>
</html>
<?php include 'layout/footer.php';

if ($_SESSION['loggedin']['user_type']=='admin') {?>
  <a href="xml/weatherdata.xml" download="weatherdata">
    <button class="btn btn4" type="submit" onclick=>Download XML</button>
  </a>
  <?php
}else{
  echo "";
}; ?>
<?php
}else{
  echo "You do not have permession do view this part of the site";
  header( "refresh:2;url=index.php" );
}
 ?>
