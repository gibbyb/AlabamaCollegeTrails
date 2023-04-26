<?php

if(isset($_POST)) {
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		$output = json_encode(array( //create JSON data
			'error'=>1, 
			'msg' => 'Sorry Requests must be made via Ajax POST'
		));
		die($output); //exit script outputting json data
    } 
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

    $subject = "Alabama Hiing trails contact form ";

    //email body
    $message_body = "Alabama Hiing trails contact form \nname: $name";
    $message_body .= "\r\nEmail: $email\r\nmessage: $message";

    // In case any of our lines are larger than 70 characters
    $message_final = wordwrap($message_body, 70, "\r\n");

    // compose headers
    $headers = "From: ".$email."\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();

    $send_mail = mail('UnivHikingUSM@gmail.com', $subject, $message_final, $headers);

    if($send_mail){
        die(print(json_encode(array('error'=> 0, 'msg' => "<p class='alert alert-primary'>Thank you, $name! Your message has been sent.</p>"))));
    }else{
        die(print(json_encode(array('error'=> 1, 'msg' => "Error sending contact form."))));
    }
}
