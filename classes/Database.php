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
        //$this->dropTable("orders");
        $this->createSettings();
        return true;
    }   
    /**
    * Create table quick_cart_settings
    *@return bool success/fail
    */
    function createSettings(){
        $pdo = $this->pdo;
        try {
            $sql = "CREATE TABLE IF NOT EXISTS quick_cart_settings (
                id int(10) AUTO_INCREMENT PRIMARY KEY,
                paypal_client_id varchar(255) DEFAULT 'sb',
                currency varchar(10) DEFAULT 'USD',
                nonce varchar(255) DEFAULT '',
                paypal smallint(1) DEFAULT 1,
                braintree smallint(1) DEFAULT 0,
                reviews_logged_in smallint(1) DEFAULT 0,
                reviews_approve smallint(1) DEFAULT 0,
                show_reviews smallint(1) DEFAULT 1,
                braintree_enviroment varchar(20) DEFAULT 'sandbox',
                paypal_enviroment varchar(20) DEFAULT 'sandbox',
                braintree_merchant_id varchar(255) DEFAULT '',
                braintree_public_key varchar(255) DEFAULT '',
                braintree_private_key varchar(255) DEFAULT '',
                clientToken varchar(255) DEFAULT '',
                woo_enabled  smallint(1) DEFAULT 0
                )";
            $pdo->exec($sql);
            return true;
        }
        catch(PDOException $e){
                $this->msg = 'error creating quickcart settings: '.$e->getMessage();
                return false;
        }
    }
    /**
    * @return int - return 1 for ready 
    */
   function getBraintree(){
       $pdo = $this->pdo;//connect
       if(is_null($pdo)){
           $this->msg = 'Connection Error!';
           return null;
       }else{
           $stmt = $pdo->prepare('SELECT braintree FROM quick_cart_settings WHERE id = 777');
           if($stmt->execute()){
               $braintree = ($stmt->fetch());
               return $braintree['braintree'];
           }else{
               $this->msg = 'Error getting paypal_client_id';//set error
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
    
    /* for passing the pdo instance to other classes
     * @return pdo
     */
    function getPdo () {
        return $this->pdo;
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
}

session_write_close();