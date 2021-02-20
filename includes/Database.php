<?php
/**
 * Database.php
 * create database connection and return Connection Link
 * @param $link
 *
 */

namespace TodosProject;

class Database {

    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "db_todos";
    public  $query;
    
    public function __construct(){
        if(!isset($this->query)){
            try {

                $link = new \PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPass);
                $this->query = $link;
                // echo 'Database Connected SuccessFully...!';
                
            } catch ( mysqli_sql_exception $e ) {
                echo "Database Connection Failed.." . $e->getMessage();
            }

        }

    }

}