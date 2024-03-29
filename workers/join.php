<?php
/**
 * @package alabamahikingtrails
 */

/** Loads the Semi-Configured Environment */
require '../config.php';
if(!isset($database)){$database = new Database();}//initialize database class
if( isset($_POST) ){
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		
		$output = json_encode(array( //create JSON data
			'error'=>1, 
			'msg' => 'Sorry Requests must be made via Ajax POST'
		));
		die($output); //exit script outputting json data
    } 


        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $info = filter_var($_POST['socialmediainfo'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $yearsHiking = filter_var($_POST['experience'], FILTER_SANITIZE_STRING);
        $hasBeenGuide = filter_var($_POST['yesCheck'], FILTER_SANITIZE_STRING);
        
         if($database->setApplication($name, $email, $info, $phone, $yearsHiking, $hasBeenGuide))
        {
            die(print(json_encode(array('error'=> 0, 'msg' => "Successfully submitted your join request!",'data'=>$database->getApplication()))));
        }else{
            die(print(json_encode(array('error'=> 1, 'msg' => $database->printError() ))));
        }
        
         
    
    $subject = "Alabama Hiking trails contact form for $name";

    //email body
    $message_body = "Alabama Hiking trails join form \nname: $name";
    $message_body .= "\r\nEmail: $email\r\nInfo: $info\r\nPhone: $phone\r\nYears Hiked: $yearsHiking\r\nHave they been a guide?: $hasBeenGuide";

    // In case any of our lines are larger than 70 characters
    $message_final = wordwrap($message_body, 70, "\r\n");

     //compose headers
    $headers = "From: ".$email."\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();
    
    //mail('maplestudios4@gmail.com', $subject, $message_final, $headers);
    $send_mail = mail('UnivHikingTrails@gmail.com', $subject, $message_final, $headers);

    if($send_mail){
        die(print(json_encode(array('error'=> 0, 'msg' => "<p class='alert alert-primary'>Thank you, $name! Your message has been sent.</p>"))));
    }else{
        die(print(json_encode(array('error'=> 1, 'msg' => "Error sending contact form."))));
    }
}
?>