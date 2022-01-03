<?php

namespace App\Models;

use App\Database\Database;
use PDO;
use Serializable;

class User{
    /**
     * Table containing the users
     * @var string
     */
    const table = "users";

    /**
     * User's unique identifier
     * @var integer
     */
    public $id;

    /**
     * User's name
     * @var string
     */
    public $name;

    /**
     * User's email, used in authentication
     * @var string
     */
    public $email;

    /**
     * SHA1 hash of the user password
     * @var string
     */
    public $password;

    /**
     * Indicates if the user is active
     * @var bool
     */
    public $is_active;

    /**
     * Get all objects of this class
     * @return User[]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Get Object by it's ID
     * @param integer $id
     */
    public static function getByID($id):User{
        return (new Database(self::table))->select("id={$id}")->fetchObject(self::class);
    }

    /**
     * Tries to autenticate the user with the givent credentials
     * @param string $email,
     * @param string $password
     * @return User|false
     */
    public static function authenticate($email, $password){
        $user = (new Database(self::table))->select("email='{$email}' and password='{$password}' and is_active=1")->fetchObject(self::class);
        if($user){
            return $user;
        }else{
            return false;
        }
    }

    /**
     * Responsible for saving the data, be it by creating or updating it
     * @return boolean
     */
    public function save(){
        if(isset($this->id)){
            return $this->update($this);
        }
        else{
            return $this->create($this);
        }
    }

    /**
     * Handles the data creation
     * @return boolean
     */
    public function create(){
        $db = new Database(self::table);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_active' => $this->is_active
        ];
        if ($db->insert($data)){
            return true;
        }
        return false;
    }

    /**
     * Handles the data updating process
     * @return boolean
     */
    public function update(){
        $data = [
            'id'=>$this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_active' => $this->is_active
        ];
        if ((new Database(self::table))->update("id={$this->id}",$data)){
            return true;
        }
        return false;
    }

    /**
     * Handles the data deletion process
     * @return boolean
     */
    public function delete(){
        (new Database(self::table))->delete($this->id);
        return true;
    }
}