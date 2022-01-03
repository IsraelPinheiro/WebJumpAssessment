<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Product{
    /**
     * The product's table
     * @var string
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
     * Get all objects
     * @return Product[]
     */
    public static function getAll(){
        return (new Database(self::table))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Get Object by it's ID
     * @param integer $id
     * @return Product
     */
    public static function getByID($id){
        return (new Database(self::table))->select("id={$id}")->fetchObject(self::class);
    }

    /**
     * Return the product's categories
     * @return Category[]
     */
    public function categories(){
        $rows = (new Database(CategoryProduct::table))->select("product_id = {$this->id}",null, null, "category_id")->fetchAll(PDO::FETCH_COLUMN);
        if(count($rows)>0){
            $ids = implode(',',$rows);
            return (new Database(Category::table))->select("id in ({$ids})")->fetchAll(PDO::FETCH_CLASS, Category::class);
        }
        else{
            return array();
        }
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
            'sku'=>$this->sku,
            'price'=>$this->price,
            'description'=>$this->description,
            'quantity'=>$this->quantity
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
            'sku'=>$this->sku,
            'price'=>$this->price,
            'description'=>$this->description,
            'quantity'=>$this->quantity
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