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
}