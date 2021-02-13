<?php
require('../../config.inc.php');

$array = array();

if (($handle = fopen($_CONFIG['results']['speed_test_history'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {       
    array_push($array, $data);
    }
    fclose($handle);
}

echo json_encode($array,JSON_PRETTY_PRINT);

?>
