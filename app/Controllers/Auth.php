<?php
namespace App\Controllers;

use App\Models\User;


class Auth{
    /**
     * The product's table
     * @var string
     */
    const table = "users";

    /**
     * Returns the current logged in user
     * @return User|false
     */
    public static function user(){
        session_start();
        if(isset($_SESSION["User"])){
            return unserialize($_SESSION["User"]);
        }
        else {
            return false;
        }
    }

    /**
     * Returns the current logged in user
     * @param string $email
     * @param string $password
     */
    public static function login($email, $password):bool{
        session_start();
        $user = User::authenticate($email, $password);
        if ($user){
            $_SESSION["User"] = serialize($user);
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if a user is currently logged in
     */
    public static function check():bool{
        session_start();
        if(isset($_SESSION["User"])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Logout the current logged in user
     */
    public static function logout():bool{
        session_start();
        if(self::check()){
            unset($_SESSION["User"]);
            return true;
        }
        else{
            return false;
        }
    }
}
