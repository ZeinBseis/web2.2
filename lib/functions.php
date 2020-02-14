<?php include 'lib/connection.php';


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


//TODO: TEST FUNCTION
function get_allweather($stationid, $dayID){
    $path = $_SERVER['DOCUMENT_ROOT']."/web2.2/venv/$stationid/$dayID.csv";
    $row = 1;
    $time = [];
    $temperature = [];
    $humidity = [];
    if (($handle = fopen($path, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          if($row == 1){ $row++; continue; }
          array_push($time, $data[0]);
          array_push($temperature, round($data[1]));
          array_push($humidity, round($data[2]));
          // array_push($stationid, $data[0]);
          // array_push($countries, $data[1]);
          // $num = count($data);
          // echo "<p> $num fields in line $row: <br /></p>\n";
          // $row++;
          // for ($c=0; $c < $num; $c++) {
          //     echo $data[$c] . "<br />\n";
          // }
        }
        fclose($handle);
      }
    return array($time, $temperature, $humidity);
}

function get_weather($stationid, $dayID){
    $path = $_SERVER['DOCUMENT_ROOT']."/web2.2/venv/$stationid/$dayID.csv";
    $file = file($path);
    $row = $file[count($file)-1]; // Getting final value
    $csvdata = str_getcsv($row); // Parse line to CSV
    // print_r($csvdata);
    return array($csvdata[1], $csvdata[2]);  
}

// if (($handle = fopen("csv/stationid.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//       if($row == 1){ $row++; continue; }
//       $countryid[$data[0]] = $data[1];
//       // array_push($stationid, $data[0]);
//       // array_push($countries, $data[1]);
//       // $num = count($data);
//       // echo "<p> $num fields in line $row: <br /></p>\n";
//       // $row++;
//       // for ($c=0; $c < $num; $c++) {
//       //     echo $data[$c] . "<br />\n";
//       // }
//     }
//     fclose($handle);
//   }




function getTemperature(){
    $a=array();
    $handle = fopen("venv/381410/18305.csv", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $pieces = explode(",", $line);
            $temp= $pieces[1];

            $result = round($temp);
            $z = array_push($a, $result);
        }
        return $a;
        fclose($handle);
    } else {
        // error opening the file.
    echo "error opening file";
    } 
}

function getHumidity(){
    $q=array();
    $handle = fopen("venv/381410/18305.csv", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $pieces = explode(",", $line);
            $humidity= $pieces[2];

            $result = round($humidity);
            $z = array_push($q, $result);
        }
        return $q;
        fclose($handle);
    } else {
        // error opening the file.
    echo "error opening file";
    } 
}


function convertCsvToXmlFile($input_file,$output_file) {
    // Open csv file for reading
    $inputFile  = fopen($input_file, 'rt');
    
    // Get the headers of the file
    $headers = fgetcsv($inputFile);
    
    // Create a new dom document with pretty formatting
	$doc  = new DomDocument();
    $doc->formatOutput   = true;
    
    // Add a root node to the document
	$root = $doc->createElement('Weather');
    $root = $doc->appendChild($root);
    

    // Loop through each row creating a <row> node with the correct data
    while (($row = fgetcsv($inputFile)) !== FALSE)
    {
        $container = $doc->createElement('Data');
        foreach($headers as $i => $header)
        {
            $child = $doc->createElement($header);
            $child = $container->appendChild($child);
            $value = $doc->createTextNode($row[$i]);
            $value = $child->appendChild($value);
        }

        $root->appendChild($container);
    }

    $strxml = $doc->saveXML();
    

	$handle = fopen($output_file, "w");
	fwrite($handle, $strxml);
	fclose($handle);

}


function convert (){

    $input_file=$_SERVER["DOCUMENT_ROOT"].'/web2.2/csv/weatherData.csv';
    $output_file=$_SERVER["DOCUMENT_ROOT"].'/web2.2/csv/weatherData.xml';

    convertCsvToXmlFile($input_file,$output_file);
}

   ?>
