<?php
/**
 * @package alabamahikingtrails
 */

/** Loads the Semi-Configured Environment */
require __DIR__ . '/config.php';
if(!isset($database)){$database = new Database();}//initialize database class

$database->renderPage(__DIR__  . '/header.php');

if(strlen(page) > 1){
    $database->renderPage(__DIR__  .'/pages'.page.'.php');
}else if(page === "/"){
    $database->renderPage(__DIR__  .'/pages/home.php');
}

$database->renderPage(__DIR__  .'/footer.php');