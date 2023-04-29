<?php
if (isset($_POST)){
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		$output = json_encode(array( //create JSON data
			'error'=>1, 
			'msg' => 'Sorry Requests must be made via Ajax POST'
		));
		die($output); //exit script outputting json data
    } 
    $name = filter_input(INPUT_POST,'name');
    $phone = filter_input(INPUT_POST,'phone');
    $emailadd = filter_input(INPUT_POST,'emailadd');
    $social = filter_input(INPUT_POST,'social');
    $exp = filter_input(INPUT_POST,'exp');
    $answer = filter_input(INPUT_POST,'rad');
    $info = filter_input(INPUT_POST,'addinfo');
    
    
    $subject = "Applicant";
    $message = "Name: " . $name . "\nPhone Number: $phone" 
            . "\nEmail Address: $emailadd" . "\nSocial Media Information: $social" 
             . "\nExperience: $exp"  . "\nHave they ever been a guide?: $answer" 
             . "\nAdditional Information: $addinfo";
    
    $to = "maplestudios4@gmail.com";
    $headers = "From: ".$email."\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();
    //mail($to,$subject,$message,$headers);
    $send_mail = mail($to,$subject,$message,$headers);
    
    if($send_mail){
        die(print(json_encode(array('error'=> 0, 'msg' => "<p class='alert alert-primary'>Thank you, $name! Your message has been sent.</p>"))));
    }else{
        die(print(json_encode(array('error'=> 1, 'msg' => "Error sending contact form."))));
    }

}
