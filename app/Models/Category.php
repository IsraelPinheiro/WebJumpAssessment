<?php

namespace App\Models;

use App\Database\Database;
use App\Models\Product;
use PDO;

class Category{
     /**
     * The product's table
     * @var integer
     */
    const table = "categories";
    const intermediate_table = "categories_products";

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
     * The product's description
     * @var string
     */
    public $description;

    /**
     * Get the products with this category
     * @param integer $id
     * @return Product[]
     */
    public function products(){
        $ids = implode(',',(new Database(self::intermediate_table))->select("category_id = {$this->id}",null, null, "product_id")->fetchAll(PDO::FETCH_COLUMN));
        return (new Database(Product::table))->select("id in ({$ids})")->fetchAll(PDO::FETCH_CLASS, Product::class);
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
        $data = [
            'name'=>$object->name,
            'description'=>$object->description,
        ];
        if ((new Database(self::table))->insert($data)){
            return true;
        }
        return false;
    }

    /**
     * Handles the data updating process
     * @return boolean
     */
    public function update($object){
        $data = [
            'id'=>$object->id,
            'name'=>$object->name,
            'description'=>$object->description
        ];
        if ((new Database(self::table))->update("id={$object->id}",$data)){
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