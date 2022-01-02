<?php

namespace App\Models;

use App\Database\Database;
use App\Controllers\Auth;
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
     * Get all Change Logs
     * @return array[ChangeLog]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Get all Change Logs by a specific user
     * @param int $id
     * @return ChangeLog[]
     */
    public static function getByUserId($id){
        return (new Database(self::table))->select("user_id = {$id}")->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Add a new Change Log
     * @return boolean
     */
    public static function log_change($target_type, $target_id, $action){
        $data = [
            'user_id'=>Auth::user()->id,
            'target_id'=>$target_id,
            'target_type'=>$target_type,
            'action'=>$action
        ];
        (new Database(self::table))->insert($data);
    }
}