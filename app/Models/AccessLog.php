<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class AccessLog{
    /**
     * The Access Log's table
     * @var integer
     */
    const table = "access_logs";

    /**
     * The log's identifier
     * @var integer
     */
    public $user_id;

    /**
     * Public IP of the origin of the access
     * @var string
     */
    public $accessed_from;

    /**
     * When the access occurred
     * @var string
     */
    public $accessed_at;


    /**
     * Get all Access Logs
     * @return array[AccessLog]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Log the access to the database
     * @return boolean
     */
    public static function log_access(){
        $data = [
            'user_id'=>1, //TODO: Get logged user id
            'accessed_from'=>$_SERVER['REMOTE_ADDR']
        ];
        if ((new Database(self::table))->insert($data)){
            return true;
        }
        return false;
    }
}