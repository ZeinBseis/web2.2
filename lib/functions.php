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

    $num1 = substr($csv[0][0], 5,3);
    $num2 = substr($csv[1][0], 5,3);
    $num1 = round($num1);
    $num2 = round($num2);

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
