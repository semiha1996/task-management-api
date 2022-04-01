<?php

/**
 * Database class
 *
 * @author semiha
 */
class Database {
    private $host = 'localhost';
    private $db_name = 'task_management';
    private $username = 'root';
    private $password = '';
    private $connection;
    
    /**
     * 
     * Function, used to connect to the database
     */
    public function connectToDB() {
       $this-> connection = null; 
       
       //dsn - data source name
       $dsn = 'mysql:dbname='.$this->db_name.';host='.$this->host;
       try {
           $this->connection = new PDO($dsn,$this->username,$this->password);
       
           $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
       } catch (PDOException $exc) {
           echo 'Error with the DB connection'.$exc->getMessage();
       }
       
       return $this->connection;
    }
}
