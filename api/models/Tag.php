<?php

/**
 * Tag model for table tag
 *
 * @author semiha
 */
class Tag {

    //for connecting the DB
    private $connection;
    private $dbTable = 'tags';
    //properties
    public int $id;
    public string $name;
    public string $color;

    public function __construct($db) {
        $this->connection = $db;
    }

    //Get all tags 
    public function read() {
        //Create query
        $query = "SELECT *  FROM " . $this->dbTable;

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //Get tag by id 
    public function read_single() {
        //Create query        
        $query = "SELECT * FROM " . $this->dbTable . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->connection->prepare($query);

        //Bind id
        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->color = $row['color'];
    }

//create new tag(s)
    public function create($row) {
        $query = "INSERT INTO " . $this->dbTable . " SET  name = ?, color = ?";
        $stmt = $this->connection->prepare($query);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($row->name));
        $this->color = htmlspecialchars(strip_tags($row->color));

        //Bind data
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->color);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s\n", $stmt->error);
            return false;
        }
    }

    //update  tag(s)
    public function update($row) {
        //Create query
        $query = "UPDATE " . $this->dbTable . " SET  name = ?, color = ? "
                . "WHERE ID=?";
        $stmt = $this->connection->prepare($query);

        //Clean data
        $this->id = $row->id;
        $this->name = htmlspecialchars(strip_tags($row->name));
        $this->color = htmlspecialchars(strip_tags($row->color));

        //Bind data
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->color);
        $stmt->bindParam(3, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s\n", $stmt->error);
            return false;
        }
    }

    //delete tag(s)
    public function delete($row) {
        $query = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);

        $this->id = $row->id;

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s\n", $stmt->error);
            return false;
        }
    }

}
