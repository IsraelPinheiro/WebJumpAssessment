<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class ChangeLog{
    /**
     * The product's table
     * @var string
     */
    const table = "change_logs";

    /**
     * The logs's identifier
     * @var integer
     */
    public $id;

    /**
     * The logged user unique identifier
     * @var integer
     */
    public $user_id;

    /**
     * The unique identifier of the target of the change
     * @var string
     */
    public $target_id;

    /**
     * Table target of the change
     * @var string
     */
    public $target_type;

    /**
     * Action taken against the target
     * @var string
     */
    public $action;

    /**
     * When the action has taken place
     * @var string
     */
    public $accessed_at;

    /**
     * Get all Access Logs
     * @return array[ChangeLog]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Responsible for saving the data, be it by creating or updating it
     * @return boolean
     */
    public static function log_change($object){
        $data = [
            'user_id'=>1, //TODO: Get logged user id
            'target_id'=>$object->target_id,
            'target_type'=>$object->target_type,
            'action'=>$object->action
        ];
        if ((new Database(self::table))->insert($data)){
            return true;
        }
        return false;
    }
}