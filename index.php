<?php
/**
 * @package alabamahikingtrails
 */

/** Loads the Semi-Configured Environment */
require __DIR__ . '/config.php';
if(!isset($database)){$database = new Database();}//initialize database class
if(strlen(page) > 1){
    $database->renderPage(__DIR__  . '/header.php');
    if(page === '/calendar'){//render calendar page
        $database->renderPage(__DIR__  .'/pages'.page.'.php');
        $database->renderPage(__DIR__  .'/pages/sections/addEvent.php');
    }else{//render any page in the navigation
        $database->renderPage(__DIR__  .'/pages'.page.'.php');
    }
    $database->renderPage(__DIR__  .'/footer.php');
}else if(page === "/"){//render the home page
    $database->renderPage(__DIR__  . '/header.php');
    $database->renderPage(__DIR__  .'/pages/home.php');
    $database->renderPage(__DIR__  .'/footer.php');
} 