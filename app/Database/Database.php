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
}