<html>
<?php
include 'layout/header.php';
if( isset($_SESSION['loggedin'])) {
?>


<?php include 'lib/functions.php' ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cutestrap/1.3.1/css/cutestrap.min.css">

<head>
  <style>
  h.style {
  margin-left: 600px;
  font-family: verdana;
  font-size: 20px;
  }
  a.legend {
  margin-left: 750px;
  }
  </style>
</head>
<?php
$row = 1;
if (($handle = fopen("csv/stationid.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    if($row == 1){ $row++; continue; }
    $countryid[$data[0]] = $data[1];
  }
  fclose($handle);
}

$id = $_GET['id'];
$country = $countryid[$id];

//TODO
$dayID = 18262+date('z')-1;

$command = escapeshellcmd('python -c "from getdata import getData; getData('.$id.", ".$dayID.')"');
shell_exec($command);

//TODO
//#################################################################
$weatherdata = get_allweather($id, $dayID);
$time = $weatherdata[0];
$temperature = $weatherdata[1];
$humidity = $weatherdata[2];
// print_r(get_allweather($id, $dayID)[1]);
// echo($temperature[0]);
//#################################################################



echo "<br>";
// humidty_minshan();
echo "<br>";
// print_r(test()) ;
$z= getTemperature();
print_r($z);
$y= getHumidity();
print_r($y);
// print_r($z);
// echo $y[2];
echo "<br>";
 ?>
<body>
  <h class="style"> Livegraph of the humidity and temperature of <?php echo($country) ?> </h>
</body>

<div style="margin-left: 20%;margin-top:10px;" >
  <canvas id="myChart" width="1000" height="600"></canvas>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script > 

var d= new Date().toLocaleTimeString('en-GB', { hour: "numeric", minute: "numeric"});

$(document).ready(function() {
  var ctx = document.getElementById("myChart").getContext("2d");

  var data = {
    labels: [d, d, d, d, d, d, d,],
    datasets: [{
      label: "Temperature",
      lineTension: 0.5,
      fillColor: "rgba(0,0,0,0)",
      strokeColor: "#efc417",
      pointColor: "#efc417",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(220,220,220,1)",
      data: [<?php for ($i=0; $i < 7; $i++) { 
        echo $temperature[$i].",";
      } ?>]
    }, {
      label: "Humidity",
      fillColor: "rgba(0,0,0,0)",
      strokeColor: "#ce1b04",
      pointColor: "#ce1b04",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(151,187,205,1)",
      data: [<?php for ($i=0; $i < 7; $i++) { 
        echo $humidity[$i].",";
      } ?>]
    }]
  };

  var options = {
    animation: false,
    //Boolean - If we want to override with a hard coded scale
    scaleOverride: true,
    //** Required if scaleOverride is true **
    //Number - The number of steps in a hard coded scale
    scaleSteps: 10,
    //Number - The value jump in the hard coded scale
    scaleStepWidth:10,
    //Number - The scale starting value
    scaleStartValue: 0
  };

  var myLineChart = new Chart(ctx).Line(data, options);

  setInterval(function() {
    setDataq(data.datasets[0].data);
    setDatam(data.datasets[1].data);
    setLabels(data.labels);

    var myLineChart = new Chart(ctx).Line(data, options);
  }, 5000);

  function setLabels(labels) {
    var nextMonthIndex = months.indexOf(labels[labels.length - 1]) + 1;
    var nextMonthName = months[nextMonthIndex] != undefined ? months[nextMonthIndex] : "";
    labels.push(nextMonthName);
    labels.shift();
  }
  function setDataq(data) {
    <?php for ($i=0; $i <20; $i++) { 
    ?>
    data.push(<?php echo $y[$i]; ?>);
   <?php 
  }
    ?>
    data.shift();
  }

    function setDatam(data) {
      <?php for ($i=0; $i <20; $i++) { 
      ?>
         data.push(<?php echo $z[$i]; ?>);
   <?php 
}
    ?>
    data.shift();
  }

  function convertMonthNameToNumber(monthName) {
    var myDate = new Date(monthName + " 1, 2016");
    var monthDigit = myDate.getMonth();
    return isNaN(monthDigit) ? 0 : (monthDigit + 1);
  }

  var months = ['new data','new data','new data','new data','new data','new data'];
  // var months = [d+5,d,d,d,d,d,d,d];

});
  </script>

  <script>
var data = [
   ['Temperature', <?php 
   for ($i=0; $i < 15; $i++) { 
    echo $z[$i].",";
   }
    ?>],
  ['Humidity', <?php 
   for ($i=0; $i < 15; $i++) { 
    echo $y[$i].",";
   }
    ?>],
  
];
 
 
function download_csv() {
    var csv = 'Temperature and Humidity\n';
    data.forEach(function(row) {
            csv += row.join(',');
            csv += "\n";
    });
 
    console.log(csv);
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'weatherdata'<?php echo $id?>'.csv';
    hiddenElement.click();
}
</script>




  <a class="legend"><img src="img/legend.png" height="70px;"></a>
</div>
<?php  if ($_SESSION['loggedin']['user_type']=='admin') {
      ?>
<button class="btn--secondary" type="submit" onclick="download_csv()">Download CSV</button>
      <?php
    }else{
      echo "";
    }; ?>

<?php include 'layout/footer.php' ?>
<?php }else{
  echo "You do not have permession do view this part the site";
  header( "refresh:2;url=index.php" ); }?>
