<?php


include(__DIR__  . '/classes/Database.php');//get DB connection

//initialize classes
if(!isset($database)){$database = new Database();}//initialize database class
if(isset($_GET)){//usual check
    $events = $database->getEvents();
    if(isset($events))
    {
        die(print(json_encode($events)));
    }else{
        die(print(json_encode(array('error'=> 1, 'msg' => "<p class='alert alert-danger'>"+$database->printError()+"</p>"))));
    }
}
?>
