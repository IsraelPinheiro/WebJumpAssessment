<?php

namespace App\Models;

use App\Database\Database;
use App\Models\Product;
use App\Models\Category;
use PDO;

class CategoryProduct{
    /**
     * Table responsible for the data
     * @var string
     */
    const table = "categories_products";

    /**
     * Category's identifier
     * @var integer
     */
    public $category_id;

    /**
     * Product's identifier
     * @var integer
     */
    public $product_id;


    /**
     * Get the categories of a product by it's id
     * @param integer $product_id
     */
    public static function getCategories($product_id){
        $rows = (new Database(self::table))->select("product_id = {$product_id}",null, null, "category_id")->fetchAll(PDO::FETCH_COLUMN);
        if(count($rows)>0){
            $ids = implode(',',$rows);
            return (new Database(Category::table))->select("id in ({$ids})")->fetchAll(PDO::FETCH_CLASS, Category::class);
        }
        else{
            return array();
        }
    }

    /**
     * Get the products of a category by it's id
     * @param integer $category_id
     */
    public static function getProducts($category_id){
        $rows = (new Database(self::table))->select("category_id = {$category_id}",null, null, "product_id")->fetchAll(PDO::FETCH_COLUMN);
        if(count($rows)>0){
            $ids = implode(',',$rows);
            return (new Database(Product::table))->select("id in ({$ids})")->fetchAll(PDO::FETCH_CLASS, Product::class);
        }
        else{
            return array();
        }
    }

    /**
     * Delete relations based on Category id
     * @param integer $category_id
     */
    public static function deleteByCategoryId($category_id){
        (new Database(self::table))->execure_raw("DELETE FROM ".self::table." WHERE category_id={$category_id}");
        return true;
    }

    /**
     * Delete relations based on Product id
     * @param integer $category_id
     */
    public static function deleteByProductId($product_id){
        (new Database(self::table))->execure_raw("DELETE FROM ".self::table." WHERE product_id={$product_id}");
        return true;
    }


}