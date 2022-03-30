<?php

/**
 * Task model  for table task
 *
 * @author semiha
 */

class Task {
    //for connecting the DB
    private $connection;
    private $dbTable = 'tasks';
    
    //properties
    public  int $id;
    public string $name;
    
    public function __construct($db) {
        $this->connection=$db;
    }
    
    //Get all tasks with their tags
    public function read() {
        //Create query
        $query = 'SELECT tasks.name AS Task, tags.name AS Tag, tags.color AS Color FROM '.
        $this->dbTable 
                . ' LEFT JOIN task_tag ON task_tag.task_id = tasks.id '
                . 'LEFT JOIN tags ON task_tag.tag_id = tags.id ';  
        
        $stmt = $this->connection->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    //Get one task with its tags
    public function read_single() {
         //Create query
        $query = 'SELECT tasks.name AS Task, tags.name AS Tag, tags.color AS Color FROM '.
                $this->dbTable
                . ' LEFT JOIN task_tag ON task_tag.task_id = tasks.id '
                . 'LEFT JOIN tags ON task_tag.tag_id = tags.id'
                . 'WHERE tags.id = ?'
                . 'LIMIT 0,1';    
        
        $stmt = $this->connection->prepare($query);
        
        //Bind id
        $stmt->bindParam(1,$this->id);
        
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $row['name'];
        $this->name = $row['name'];
        $this->color = $row['color'];
        return $stmt;
    }
    
    //Create a new task
    public function create() {
        
    }
    
    //Update a task with particular id
    function update() {
        
    }
    
    //Delete a task with particular id
    function delete() {
        
    }
}
