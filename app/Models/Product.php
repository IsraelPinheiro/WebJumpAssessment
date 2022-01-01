<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Product{
    /**
     * The product's table
     * @var integer
     */
    const table = "products";

    /**
     * The product's identifier
     * @var integer
     */
    public $id;

    /**
     * The product's name
     * @var string
     */
    public $name;

    /**
     * The product's Stock Keeping Unit code
     * @var string
     */
    public $sku;

    /**
     * The product's price
     * @var float
     */
    public $price;

    /**
     * The product's description
     * @var string
     */
    public $description;

    /**
     * The product's available quantity
     * @var int
     */
    public $quantity;

    /**
     * Get Object by it's ID
     * @param integer $id
     * @return Product
     */
    public static function getByID($id){
        return (new Database(self::table))->select("id={$id}")->fetchObject(self::class);
    }

    /**
     * Get all objects
     * @return array[Product]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Responsible for saving the data, be it by creating or updating it
     * @return boolean
     */
    public function save($object){
        if(isset($object->id)){
            return $this->update($object);
        }
        else{
            return $this->create($object);
        }
    }
    
    /**
     * Handles the data creation
     * @return boolean
     */
    public function create($object){
        $db = new Database(self::table);
        $data = [
            'name'=>$object->name,
            'sku'=>$object->sku,
            'price'=>$object->price,
            'description'=>$object->description,
            'quantity'=>$object->quantity
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
    public function update($object){
        $db = new Database(self::table);
        $data = [
            'id'=>$object->id,
            'name'=>$object->name,
            'sku'=>$object->sku,
            'price'=>$object->price,
            'description'=>$object->description,
            'quantity'=>$object->quantity
        ];
        if ($db->update("id={$object->id}",$data)){
            return true;
        }
        return false;
    }

    /**
     * Handles the data deletion process
     * @return boolean
     */
    public function delete($id){
        (new Database(self::table))->delete($id);
        return true;
    }
}