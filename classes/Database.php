<?php
/**
* @Author - Ralph Harris
* 3/2/2019
* class database
*/

if(session_status() == PHP_SESSION_NONE){ session_start(); }

class Database{
    /** prepare PDO connection */
    private $pdo;  
    /** database ref */
    public $database;
     /** any possible error msgs */
    private $last_msg;
    private $connectString;//connection string for pdo()
    private $dbUser;//db user
    private $dbPass;//db pass
    
    public function printMsg(){
        return $this->last_msg;
    }
    public function printError(){
        return $this->last_msg;
    }
    
    /**
    * Constructor - initializes pdo connection
    * @init private string $SconnectString - DB connection string.
    * @init private string $DbUser - DB user.
    * @init private string $pass - DB password.
    */
    public function __construct(){
        $this->connectString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";";//connection string for pdo()
        $this->dbUser = DB_USER;//db user
        $this->dbPass = DB_PASSWORD;//db pass
        $this->dbConnect();//connect to database - init pdo / creates SQL tables
    }

    /**
    * Connection initialization  
    * @init PHP Data Object - secure pdo db connection
    * @init createTables (() - check that all tables are created
    * @return bool Returns connection success/failure.
    */
    private function dbConnect(){
        try {
            $pdo = new PDO($this->connectString, $this->dbUser, $this->dbPass);//establish connection
            $this->pdo = $pdo;//make global in this class
            $this->createTables();
            return true;
        }catch(PDOException $e) {//set error
            $this->last_msg = 'PDO Connection error! '.$e;
            return false;
        }
    }
    
    /**
    * Create database quick_cart
    *@return bool success/fail
    */
    function createTables()
    {
        //$this->dropTable("alabama_trails_events");
        $this->createEvents();//make table if doesn't exist
        $this->createMessage();//make table if doesn't exist
        $this->createApplication();//make table if doesn't exist
        $this->createGallery();
        return true;
    }   
    /**
    * Create table createEvents
    *@return bool success/fail
    */
    function createEvents(){
        $pdo = $this->pdo;
        try {
            $sql = "CREATE TABLE IF NOT EXISTS alabama_trails_events (
                id int(10) AUTO_INCREMENT PRIMARY KEY,
                title varchar(255) DEFAULT '',
                groupId varchar(255) DEFAULT '',
                url varchar(255) DEFAULT '',
                address varchar(255) DEFAULT '',
                start varchar(50) DEFAULT '',
                end varchar(50) DEFAULT '',
                date_created varchar(50),
                notes varchar(255) DEFAULT ''
                )";
            $pdo->exec($sql);
            return true;
        }
        catch(PDOException $e){
                $this->msg = 'error creating events table: '.$e->getMessage();
                return false;
        }
    }
    
     /**
     * @return bool
     */
    function setEvent($group, $title, $url, $address, $start, $end, $notes){
        $date = new DateTime("now");
        $date_created = $date->format('Y-m-d H:i:s');
        $pdo = $this->pdo;//connection            
        $stmt = $pdo->prepare('Insert INTO alabama_trails_events (groupId, title, url, address, start, end, date_created, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');//statement
        if($stmt->execute([$group, $title, $url, $address, $start, $end, $date_created, $notes])){//execute - success
            return true;
        }else{//execute - failure
            $this->msg = 'Failed creating event.';//set error
            return false;//you loose
        }        
    }
    /**
    * @return array - array of events 
    */
   function getEvents(){
       $pdo = $this->pdo;//connect
       if(!isset($pdo)){
           $this->msg = 'Connection Error!';
           return null;
       }else{
           $stmt = $pdo->prepare('SELECT * FROM alabama_trails_events');
           if($stmt->execute()){
               return $stmt->fetchAll();
           }else{
               $this->msg = 'unknown error getting events';//set error
               return null; 
           }
       }
    }
    /**
    * Create table Application
    *@return bool success/fail
    */
    function createApplication(){
        $pdo = $this->pdo;
        try {
            $sql = "CREATE TABLE IF NOT EXISTS Application (
                id int(10) AUTO_INCREMENT PRIMARY KEY,
                UserName varchar(250) not null,
                Email varchar(250) not null,
                SocialMediaInfo varchar(2000),
                Phone char(14),
                YearsHiking int(10),
                HasBeenGuide bit not null
                )";
            $pdo->exec($sql);
            return true;
        }
        catch(PDOException $e){
                $this->msg = 'error creating events table: '.$e->getMessage();
                return false;
        }
    }
    /**
     * @param $username string
     * @param $email string
     * @param $info string
     * @param $phone string
     * @param $yearsHiking int
     * @param $hasBeenGuide bool
     * @return bool
     */
    function setApplication($username, $email, $info, $phone, $yearsHiking, $hasBeenGuide){
        $pdo = $this->pdo;//connection            
        $stmt = $pdo->prepare('Insert INTO Application (UserName, Email, SocialMediaInfo, Phone, YearsHiking, HasBeenGuide) VALUES (?, ?, ?, ?, ?, ?)');//statement
        if($stmt->execute([$username, $email, $info, $phone, $yearsHiking, $hasBeenGuide])){//execute - success
            return true;
        }else{//execute - failure
            $this->msg = 'Failed creating Application.';//set error
            return false;//you loose
        }        
    }
    
    /**
    * @return array - array of Applications 
    */
   function getApplication(){
       $pdo = $this->pdo;//connect
       if(!isset($pdo)){
           $this->msg = 'Connection Error!';
           return null;
       }else{
           $stmt = $pdo->prepare('SELECT * FROM Application');
           if($stmt->execute()){
               return $stmt->fetchAll();
           }else{
               $this->msg = 'unknown error getting Application';//set error
               return null; 
           }
       }
    }
    /*
     * Create gallery table
     */
    function createGallery(){
        $pdo = $this->pdo;
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `Gallery` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `filename` varchar(255) NOT NULL,
          `filepath` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;";
            $pdo->exec($sql);
            return true;
        }
        catch(PDOException $e){
            $this->msg = 'error creating gallery table: '.$e->getMessage();
            return false;
        }
    }


    /**
    * Create table Message
    *@return bool success/fail
    */
    function createMessage(){
        $pdo = $this->pdo;
        try {
            $sql = "CREATE TABLE IF NOT EXISTS Message (
                id int(10) AUTO_INCREMENT PRIMARY KEY,
                UserName varchar(250) not null,
                Email varchar(250) not null,
                Phone char(14),
                Message varchar(5000)
                )";
            $pdo->exec($sql);
            return true;
        }
        catch(PDOException $e){
                $this->msg = 'error creating Message table: '.$e->getMessage();
                return false;
        }
    }
    /**
     * @return bool
     */
    function setMessage($username, $email, $phone, $message){
        $pdo = $this->pdo;//connection            
        $stmt = $pdo->prepare('Insert INTO Message (UserName, Email, Phone, Message) VALUES (?, ?, ?, ?)');//statement
        if($stmt->execute([$username, $email, $phone, $message])){//execute - success
            return true;
        }else{//execute - failure
            $this->msg = 'Failed creating Message.';//set error
            return false;//you loose
        }        
    }
    
    /**
    * @return array - array of messages 
    */
   function getMessage(){
       $pdo = $this->pdo;//connect
       if(!isset($pdo)){
           $this->msg = 'Connection Error!';
           return null;
       }else{
           $stmt = $pdo->prepare('SELECT * FROM Message');
           if($stmt->execute()){
               return $stmt->fetchAll();
           }else{
               $this->msg = 'unknown error getting Message';//set error
               return null; 
           }
       }
    }
    /**
    * Useful template rendering function
    * @param string $path - path of the template file.
    * @return void.
    */
    public function render($path,$vars = '') {
        ob_start();
        require_once($path);
        return ob_get_clean();
    }

    /**
    * securely output any page 
    * @return void.
    */
    public function renderPage($path) {
        print $this->render($path);
    }
        
    /**
     * Encrypt a message
     * 
     * @param string $message - message to encrypt
     * @param string $key - encryption key
     * @return string
     */
    function encrypt($message)
    {
        $key = 'J@NcRfUjXn2r5u8x!A%D*G-KaPdSgVkYp3s6v9y$B?E(H+MbQeThWmZq4t7w!z%C*F)J@NcRfUjXn2r5u8x/A?D(G+KaPdSgVkYp3s6v9y$B&E)H@McQeThWmZq4t7w!';
        $iv = '5285389999121';
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $iv = '5285389799429121';
        return openssl_encrypt($message, $ciphering,
            $key, $options, $iv);
    }
    
    /**
     * Decrypt a message
     * 
     * @param string $encrypted - message encrypted with safeEncrypt()
     * @param string $key - encryption key
     * @return string
     */
    function decrypt($encrypted)
    {   $key = 'J@NcRfUjXn2r5u8x!A%D*G-KaPdSgVkYp3s6v9y$B?E(H+MbQeThWmZq4t7w!z%C*F)J@NcRfUjXn2r5u8x/A?D(G+KaPdSgVkYp3s6v9y$B&E)H@McQeThWmZq4t7w!';
        $iv = '5285389799429121';
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        return openssl_decrypt ($encrypted, $ciphering, 
                $key, $options, $iv);
    }  
    
    /* function similar to count, but only counts integer idexes - 
     * (not string or decimal indexes) useful for working with mySql
     * returned table values
     * @param array
     * @return int - number of integer indexes in an array
     */
    function int_count ($array) {
        count(array_filter(array_keys($array), function($key) {
            return is_int($key);
        }));
      }
    
    /**
    * @param string - table to drop
    *@return bool success/fail
    */
    function dropTable($table){
        try {
            $pdo = $this->pdo;
            $sql = "DROP TABLE ".$table;
            $pdo->exec($sql);
            return;
        }
        catch(PDOException $e)
        {
                return $e->getMessage();
        }
    }
    /* for passing the pdo instance to other classes
     * @return pdo
     */
    function getPdo () {
        return $this->pdo;
      }
}

session_write_close();