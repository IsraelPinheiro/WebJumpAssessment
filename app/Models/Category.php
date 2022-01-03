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
        $rows = (new Database(CategoryProduct::table))->select("category_id = {$this->id}",null, null, "product_id")->fetchAll(PDO::FETCH_COLUMN);
        if(count($rows)>0){
            $ids = implode(',',$rows);
            return (new Database(Product::table))->select("id in ({$ids})")->fetchAll(PDO::FETCH_CLASS, Product::class);
        }
        else{
            return array();
        }
    }
    
    /**
     * Get all objects
     * @return Category[]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Get category by Id
     * @return Category
     */
    public static function getById($id){
        return (new Database(self::table))->select("id={$id}")->fetchObject(self::class);
    }

    /**
     * Responsible for saving the data, be it by creating or updating it
     * @return boolean
     */
    public function save(){
        if(isset($this->id)){
            return $this->update();
        }
        else{
            return $this->create();
        }
    }
    /**
     * Handles the data creation
     * @return boolean
     */
    public function create(){
        $data = [
            'name'=>$this->name,
            'description'=>$this->description,
        ];
        $id = (new Database(self::table))->insert($data);
        if($id){
            return $id;
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
            'name'=>$this->name,
            'description'=>$this->description
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