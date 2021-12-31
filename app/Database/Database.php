<?php
namespace App\Database;
use PDO;
use PDOException;

class Database{
    /**
     * Database connection driver to be used
     * @var string
     */
    const DRIVER = "mysql";

    /**
     * Database Host
     * @var string
     */
    const HOST = "localhost";

    /**
     * Database name
     * @var string
     */
    const DATABASE = "Webjump";

    /**
     * Host's port to be used during the connection
     * @var string
     */
    const PORT = "3306";

    /**
     * Database User name
     * @var string
     */
    const USER = "root";

    /**
     * Database password
     * @var string
     */
    const PASSWORD = "secret";

    /**
     * Name of the table to be used
     * @var string
     */
    private $table;

    /**
     * Database connection instance
     * @var PDO
     */
    private $connection;

    /**
     * Defines the table to be used and instantiate the connection
     * @param string $table
     */
    public function __construct($table=null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Function responsible for creating the database connection
     */
    private function setConnection(){
        try {
            $this->connection = new PDO(self::DRIVER.":host=".self::HOST.", dbname=".self::DATABASE.", port=".self::PORT."", self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Throws an exception if anything goes wrong
        }
        catch (PDOException $e) {
            die('ERROR: '.$e->getMessage()); //Not to be used in production
        }
    }

    /**
     * Responsible for inserting the objects in the dtabase
     * @param string $query
     * @param array $values
     * @return PDOStatement
     */
    public function execute($query, $values = []){
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($values);
            return $statement;
        }
        catch (PDOException $e){
            die('ERROR: '.$e->getMessage()); //Not to be used in production
        }
    }

    /**
     * Responsible for getting data from the database
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where=null, $order=null, $limit=null, $fields="*"){
        //Query Data
        $where = !empty($where) ? "WHERE {$where}" : "";
        $order = !empty($order) ? "ORDER BY {$order}" : "";
        $limit = !empty($limit) ? "LIMIT {$limit}" : "";
        //Query Building
        $query = "SELECT {$fields} FROM {$this->table} {$where} {$order} {$limit}";
        //Execute Query
        return $this->execute($query);
    }

    /**
     * Responsible for inserting the object in the database
     * @param array $data [field=>value]
     * @return integer id
     */
    public function insert($data){
        //Query data
        $fields =  implode(',',array_keys($data));
        $values = array_values($data);
        $binds = implode(',',array_pad([],count($data), "?"));
        //Query Building
        $query = "INSERT INTO {$this->table} ({$fields}) VALUES({$binds})";
        //Execute the query
        $this->execute($query, $values);
        //Return the id of the inserted object
        return $this->connection->lastInsertId();
    }

    /**
     * Responsible for updating the object in the database
     * @param string $where
     * @param array $data [field=>value]
     * @return integer id
     */
    public function update($where,$data){
        //Query Data
        $fields =  implode(',=?',array_keys($data))."=?";
        $values = array_values($data);
        //Query Build
        $query = "UPDATE {$this->table} SET {$fields} WHERE $where";
        return $this->execute($query, $values);
    }

    /**
     * Responsible fordeleting the objects from the database
     * @param int $id
     * @return boolean
     */
    public function delete($id){
        $query = "DELETE FROM {$this->table} WHERE id=?";
        return $this->execute($query,[$id]);
    }
}