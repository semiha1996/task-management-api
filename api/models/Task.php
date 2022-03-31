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
    public int $id;
    public string $name;

    public function __construct($db) {
        $this->connection = $db;
    }

    //Get all tasks with their tags
    public function read() {
        //Create query
        $query = "SELECT tasks.name AS Task, tags.name AS Tag, tags.color AS Color FROM " .
                $this->dbTable
                . " LEFT JOIN task_tag ON task_tag.task_id = tasks.id "
                . "LEFT JOIN tags ON task_tag.tag_id = tags.id "
                . "ORDER BY Task";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //Get one task with its tags
    public function read_single() {
        //Create query
        $query = "SELECT tasks.name AS Task, tags.name AS Tag, tags.color AS Color FROM " .
                $this->dbTable
                . " LEFT JOIN task_tag ON task_tag.task_id = tasks.id "
                . " LEFT JOIN tags ON task_tag.tag_id = tags.id "
                . " WHERE tasks.id = ?";

        $stmt = $this->connection->prepare($query);

        //Bind id
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        return $stmt;
    }

    //Create new task(s)
    public function create($row) {
        $queryTask = "INSERT INTO " . $this->dbTable . " SET  name = ?";

        $stmtTask = $this->connection->prepare($queryTask);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($row->name));
        //Bind data
        $stmtTask->bindParam(1, $this->name);

        if (!$stmtTask->execute()) {
            printf("Error: %s\n", $stmtTask->error);
            return false;
        }

        $insertedId = $this->connection->lastInsertId();

        foreach ($row->tags as $tag) {
            $queryTag = "SELECT tags.id FROM tags WHERE tags.name = ?";
            $stmtTag = $this->connection->prepare($queryTag);

            $tag = htmlspecialchars(strip_tags($tag));

            $stmtTag->bindParam(1, $tag);

            if (!$stmtTag->execute()) {
                printf("Error: %s\n", $stmtTag->error);
                return false;
            }
            while ($rowTag = $stmtTag->fetch(PDO::FETCH_ASSOC)) {
                extract($rowTag);

                $queryTaskTag = "INSERT INTO task_tag SET  task_id = ?"
                        . ", tag_id = ?";

                $stmt = $this->connection->prepare($queryTaskTag);

                $stmt->bindValue(1, $insertedId);
                $stmt->bindValue(2, $id);
                
                
                if (!$stmt->execute()) {
                    printf("Error: %s\n", $stmt->error);
                    return false;
                }
            }
        }

        return true;
    }

    //Update a task with particular id
    function update($row) {
        $queryTask = "UPDATE " . $this->dbTable . " SET  name = ? "
                . " WHERE ID = ?";

        $stmtTask = $this->connection->prepare($queryTask);

        $this->id = $row->id;
        //Clean data
        $this->name = htmlspecialchars(strip_tags($row->name));
        
        //Bind data
        $stmtTask->bindParam(1, $this->name);
        $stmtTask->bindParam(2, $this->id);
        
        if (!$stmtTask->execute()) {
            printf("Error: %s\n", $stmtTask->error);
            return false;
        }
        
        // Delete old tags and replace with the new
        if(array_count_values($row->tags) > 0) {
            $queryTagsDelete = "DELETE FROM task_tag WHERE task_id = ?";
            $queryTagsDelete = $this->connection->prepare($queryTagsDelete);
            $queryTagsDelete->bindParam(1, $this->id);

            if (!$queryTagsDelete->execute()) {
                printf("Error: %s\n", $queryTagsDelete->error);
                return false;
            }
        }
        
        foreach ($row->tags as $tag) {
            $queryTag = "SELECT tags.id FROM tags WHERE tags.name = ?";
            $stmtTag = $this->connection->prepare($queryTag);

            $tag = htmlspecialchars(strip_tags($tag));

            $stmtTag->bindParam(1, $tag);

            if (!$stmtTag->execute()) {
                printf("Error: %s\n", $stmtTag->error);
                return false;
            }
            while ($rowTag = $stmtTag->fetch(PDO::FETCH_ASSOC)) {
                extract($rowTag);

                $queryTaskTag = "INSERT INTO task_tag SET  task_id = ?"
                        . ", tag_id = ?";

                $stmt = $this->connection->prepare($queryTaskTag);

                $stmt->bindValue(1, $row->id);
                $stmt->bindValue(2, $id);

                if (!$stmt->execute()) {
                    printf("Error: %s\n", $stmt->error);
                    return false;
                }
            }
        }
       
        return true;
    }

    //Delete a task with particular id
    function delete($row) {
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
