<?php
/**
 * Query.php
 */
namespace TodosProject;
use TodosProject\Database;

class GlobalModel {

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    /**
     * Define the method < fetchAllData( $tableName ) > this methods fetch all row of a specific table..
     * IF row exists then fetch all row fields of the table.
     * @param $tableName
     * @return result
     */
    public function fetchAllData($tableName = '', $orderBy = 'id'){
        $sql    = "SELECT * FROM `" . $tableName . "` ORDER BY `" . $orderBy . "`";
        $query  = $this->db->query->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Define the method < insert( $tableName ) > this methods insert row of a specific table..
     * @param $tableName
     * @param $task
     * @param $status // default active
     * IF data insert successfully 
     * @return Last Insert ID // int
     */
    public function insert($tableName= '' , $taskName, $status = 'active'){
        $sql = "INSERT INTO `".$tableName."` ( name, status)
              VALUES (:name, :status)";
        $query = $this->db->query->prepare($sql);
        $query->bindValue(':name',$taskName);
        $query->bindValue(':status',$status);
        $result = $query->execute();
        return $this->db->query->lastInsertId();
        
    }

    /**
     * Define the method < update_row( $tableName ) > this methods update row of a specific table..
     * @param $tableName 
     * @param $id // int
     * @param $taskName
     * @param $status // default active
     * IF data insert successfully 
     * @return Last Insert ID // int
     */
    public function update_row($tableName = '', $id, $taskName, $status = 'active'){
        $sql = "UPDATE `".$tableName."` SET `name` = :name, `status` = :status WHERE `id` = :id;";
        $query = $this->db->query->prepare($sql);
        $query->bindValue(':id',$id);
        $query->bindValue(':name',$taskName);
        $query->bindValue(':status',$status);
        $result = $query->execute();
        return $result;
    }

    /**
     * Define the method < delete_row( $tableName ) > this methods delete row of a specific table..
     * @param $tableName 
     * @param $id // int
     * IF data insert successfully 
     * @return retult
     */
    public function delete_row($tableName = '', $id){
        $sql = "DELETE FROM `".$tableName."` WHERE id = :id";
        $query = $this->db->query->prepare($sql);
        $query->bindValue(':id',$id);
        $result = $query->execute();
        return $result;
    }

    /**
     * Define the method < delete_completed_task( $tableName ) > this methods update status as completed in given table..
     * @param $tableName 
     * @return retult
     */
    public function delete_completed_task($tableName = ''){
        $sql = "DELETE FROM `".$tableName."` WHERE status = :status";
        $query = $this->db->query->prepare($sql);
        $query->bindValue(':status', 'completed');
        $result = $query->execute();
        return $result;
    }

}

?>