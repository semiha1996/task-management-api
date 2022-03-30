<?php

/**
 * TaskTag model for table task_tag
 *
 * @author semiha
 */
class TaskTag {
    //for connecting the DB
    private $connection;
    private $dbTable = 'task_tag';
    
    //properties
    public int $id;
    public int $taskId;
    public int $tagId;
    
    public function __construct($db) {
        $this->connection=$db;
    }
    
    //Get all tags 
    public function read() {
        //Create query
        $query = 'SELECT *  FROM '.$this->dbTable;
               
        $stmt = $this->connection->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }

}
