<?php
namespace App\Database;

use PDO;
use PDOException;
use App\DotEnvParser;

class Database{
    /**
     * Database connection driver to be used
     * @var string
     */
    var $driver;

    /**
     * Database Host
     * @var string
     */
    var $host;

    /**
     * Database name
     * @var string
     */
    var $dbname;

    /**
     * Host's port to be used during the connection
     * @var string
     */
    var $port;

    /**
     * Database User name
     * @var string
     */
    var $user;

    /**
     * Database password
     * @var string
     */
    var $password;

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
        (new DotEnvParser('./.env'))->load();
        $this->driver = getenv('DATABASE_DRIVER');
        $this->host = getenv('DATABASE_HOST');
        $this->dbname = getenv('DATABASE_NAME');
        $this->port = getenv('DATABASE_PORT');
        $this->user = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Function responsible for creating the database connection
     */
    private function setConnection(){
        try {
            $this->connection = new PDO("{$this->driver}:host={$this->host};dbname={$this->dbname};port={$this->port}", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Throws an exception if anything goes wrong
        }
        catch (PDOException $e){
            if(getenv("APP_ENV ")=="dev"){
                error_log('ERROR: '.$e->getMessage());
                die('ERROR: '.$e->getMessage());
            }
            else{
                error_log('ERROR: '.$e->getMessage());
            }
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
            if(getenv("APP_ENV ")=="dev"){
                error_log('ERROR: '.$e->getMessage());
                die('ERROR: '.$e->getMessage());
            }
            else{
                error_log('ERROR: '.$e->getMessage());
            }
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