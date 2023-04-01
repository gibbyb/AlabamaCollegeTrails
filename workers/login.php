<?php  if(session_status() == PHP_SESSION_NONE)session_start();//check session status
/**
 * will login an existing customer or add an employee to the customer table if
 * one attempts to log into the main site... rather than show an error.
 */
require_once __DIR__ . '/../config.php';//get wordpress functions

if(!isset($employee) ){$employee = new Employee();}
if(!isset($customer) ){$customer = new Customer();}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    if($customer->login($email, $password)){
        echo json_encode(array('error'=>0,'msg'=> 'Hello, '.$_SESSION['customer']['firstname'].'!' ));
    }else if($employee->login($email, $password)){
        echo json_encode(array('error'=>0,'msg'=> 'Hello, '.$_SESSION['employee']['firstname'].'!' ));
    }else{
        echo json_encode(array('error'=>1,'msg'=> $customer->printMsg() ));
    }
}
?>