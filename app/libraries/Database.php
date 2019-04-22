<?php 
    Class Database {

        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
        private $dbHandler;
        private $stmt;
        private $error;

        public function __construct() {

            // set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array( PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        
            // Creating PDO instance
            try {
                $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
            } catch(PDOException $err) {
                $this->error = $err->getMessage();
                echo $this->error;
            }
        }

        // Preparing statement
        public function query($query) {
            $this->stmt = $this->dbHandler->prepare($query);
        }

        // Bind values
        public function bind($param, $value, $type = null){
            if(is_null($type)){
            switch(true){
                case is_int($value):
                $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
                default:
                $type = PDO::PARAM_STR;
            }
            }
    
            $this->stmt->bindValue($param, $value, $type);
        }

        // Execute the prepared statement
        public function execute(){
            return $this->stmt->execute();
        }
    
        // Get single record as object
        public function singleResult(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
    
        // Get row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }
  
    }