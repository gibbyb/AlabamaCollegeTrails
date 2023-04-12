<?php
/**
 * @package alabamahikingtrails
 */

/** Loads the Semi-Configured Environment */
require '../config.php';
if(!isset($database)){$database = new Database();}//initialize database class
if(isset($_POST) && isset($_POST['postType'])){
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		
		$output = json_encode(array( //create JSON data
			'error'=>1, 
			'msg' => 'Sorry Requests must be made via Ajax POST'
		));
		die($output); //exit script outputting json data
    } 
    if($_POST['postType'] === 'setEvent'){
        //Sanitize input data using PHP filter_var().
        //setEvents($group, $title, $url, $address, $date_start, $date_end, $notes)
        $group = filter_var($_POST['group'], FILTER_SANITIZE_STRING);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
        $month = filter_var($_POST['month'], FILTER_SANITIZE_STRING);
        $day = filter_var($_POST['day'], FILTER_SANITIZE_STRING);
        $start = filter_var($_POST['start'], FILTER_SANITIZE_STRING);
        $end = filter_var($_POST['end'], FILTER_SANITIZE_STRING);
       if(strlen($_POST['day']) <= 1){$day="0".$_POST['day'];}
       if(strlen($_POST['start']) <= 1){$start="0".$_POST['start'];}
       if(strlen($_POST['end']) <= 1){$end="0".$_POST['end'];}
       if(strlen($_POST['month']) <= 1){$month="0".$_POST['month'];}
       
        $date = new DateTime("now");
        $date->setDate($year, $month, $day);
        $date->setTime($start, 0);
        $dateStart = $date->format('Y-m-d H:i:s');
        $date->setTime($end, 0);
        $dateEnd = $date->format('Y-m-d H:i:s');
        
        $notes = filter_var($_POST['notes'], FILTER_SANITIZE_STRING);
        if($database->setEvent($group, $title, $url, $address, $dateStart, $dateEnd, $notes))
        {
            die(print(json_encode(array('error'=> 0, 'msg' => "Successfully registered for event! "))));
        }else{
            die(print(json_encode(array('error'=> 1, 'msg' => $database->printError() ))));
        }
    }else if($_POST['postType'] === 'regEvents'){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $time = filter_var($_POST['start'], FILTER_SANITIZE_STRING);

        $subject = "RSVP for event ".$title;

        //email body
        $message_body = "RSVP for event ".$title."\r\nLocation: ".$address."\r\nTime: ".$time;
        $message_body .= "\r\n\r\nRegistrant Email:\r\n".$email;

        // In case any of our lines are larger than 70 characters
        $message_final = wordwrap($message_body, 70, "\r\n");

        // compose headers
        $headers = "From: ".$email."\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/".phpversion();

        mail('rahaprogramming@gmail.com', $subject, $message_final, $headers);
        $send_mail = mail('UnivHikingUSM@gmail.com', $subject, $message_final, $headers);

        if($send_mail){
            die(print(json_encode(array('error'=> 0, 'msg' => "Thank you for registering for this event!"))));
        }else{
            die(print(json_encode(array('error'=> 1, 'msg' => "Error registering for event"))));
        }
    }
    else if($_POST['postType'] === 'getEvents'){
        $events = $database->getEvents();
        if( $events ){
            die(print(json_encode(array('error'=> 0, 'msg' => "Successfully retrieved events!", 'events'=>$events))));
        }else{
            die(print(json_encode(array('error'=> 1, 'msg' => "<p class='alert alert-danger'>"+$database->printError()+"</p>"))));
        }
    }
}