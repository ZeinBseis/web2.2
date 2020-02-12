<?php include 'lib/connection.php' ?>
<?php

function display_error() {
        global $errors;

        if (count($errors) > 0){
                echo '<div class="error">';
                        foreach ($errors as $error){
                                echo $error .'<br>';
                        }
                echo '</div>';
        }
}

function get_weather($stationid){
$path = "/var/nfsroot/WeerData/$stationid.csv";
$csv = array_map('str_getcsv', file($path));

$num1= substr($csv[0][0], 5,3);
$num2 =substr($csv[1][0], 5,3);
$num1= round($num1);
$num2=round($num2);

return array($num1,$num2);
}




function gethmin(){
$a=array();
$handle = fopen("/var/nfsroot/WeerData/560930m.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $pieces = explode(";", $line);
        $temp= (int)$pieces[3];
        $dewpoint= (int)$pieces[4];

        $pta = 2.718 ** ((17.62 * $temp) / (243.12 + $temp)) ;
        $ptd = 2.718 ** ((17.62 * $dewpoint) / (243.12 + $dewpoint)) ;
        $rh = 100 * ($ptd / $pta);
        $result = round($rh);
        $z = array_push($a, $result);
    }
    return $a;
    fclose($handle);
} else {
    // error opening the file.
  echo "error opening file";
} 
}

function gethqin(){
$q=array();
$handle = fopen("/var/nfsroot/WeerData/570160m.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $pieces = explode(";", $line);
        $temp= (int)$pieces[3];
        $dewpoint= (int)$pieces[4];

        $pta = 2.718 ** ((17.62 * $temp) / (243.12 + $temp)) ;
        $ptd = 2.718 ** ((17.62 * $dewpoint) / (243.12 + $dewpoint)) ;
        $rh = 100 * ($ptd / $pta);
        $result = round($rh);
        $z = array_push($q, $result);
    }
    return $q;
    fclose($handle);
} else {
    // error opening the file.
  echo "error opening file";
} 
}

   ?>
