<?php
include(__DIR__  . '/classes/Database.php');//get DB connection

//initialize classes
if(!isset($database)){$database = new Database();}//initialize database class
if(isset($_POST)){//usual check
    	
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		
		$output = json_encode(array( //create JSON data
			'type'=>1, 
			'msg' => 'Sorry Request must be Ajax POST'
		));
		die($output); //exit script outputting json data
    } 
    //Sanitize input data using PHP filter_var().
    //setEvents($group, $title, $url, $address, $date_start, $date_end, $notes)
    $group = filter_var($_POST['group'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $dateStart = filter_var($_POST['dateStart'], FILTER_SANITIZE_STRING);
    $dateEnd = filter_var($_POST['dateEnd'], FILTER_SANITIZE_STRING);
    $notes = filter_var($_POST['notes'], FILTER_SANITIZE_STRING);
    if($database->setEvent($group, $title, $url, $address, $dateStart, $dateEnd, $notes))
    {
        die(print(json_encode(array('error'=> 0, 'msg' => "<p class='alert alert-success'>Successfully addes event!</p>"))));
    }else{
        die(print(json_encode(array('error'=> 1, 'msg' => "<p class='alert alert-danger'>"+$database->printError()+"</p>"))));
    }
}