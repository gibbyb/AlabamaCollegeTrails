<?php if(session_status() == PHP_SESSION_NONE){ session_start(); }
/*******************************************************************************
config file containing all classes/loading files
     ini_set('display_errors', 1);//display errors true
     ini_set('display_startup_errors', 1);//display startup errors
     error_reporting(E_ALL);//show all errors
*******************************************************************************/
//required classes/definitions/functions
define('DB_HOST',"db5012072209.hosting-data.io");
define('DB_NAME',"dbs10160063");
define('DB_USER',"dbu5648674");
define('DB_PASSWORD',"alabamacollegetrails!");
define( 'site_title', 'Alabama Hiking Trails' );
define('site_url',(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define('page',$_SERVER["REQUEST_URI"]);

require_once(__DIR__  . '/classes/Database.php');//mostly for DB connections... mostly...

//initialize classes
if(!isset($database)){$database = new Database();}//initialize database

/*****************************
functions
*****************************/
function get_header(){
    if(!isset($database)){$database = new Database();}//initialize database
    $database->renderPage(__DIR__  . '/header.php');
}
function get_footer(){
    if(!isset($database)){$database = new Database();}//initialize database
    $database->renderPage(__DIR__  . '/footer.php' );
}
function get_site_url(){
    return site_url;
}
function get_site_title(){
    return site_title;
}

session_write_close(); 
