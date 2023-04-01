<?php
/**
 * @package alabamahikingtrails
 */

/** Loads the Semi-Configured Environment */
require '../config.php';
if(!isset($database)){$database = new Database();}//initialize database class

    $outputPath = 'outputFile.csv';

    $output = fopen($outputPath, "w");
    $result = $database->getEvents();
    for ($row = 0;$row < sizeof($result);$row++) {
        $fputcsv = fputcsv($output, $result[$row]);
    }
    fclose($output);

    $filepath = 'outputFile.csv';

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=outputFile.csv" );

    echo( file_get_contents($filepath) );
