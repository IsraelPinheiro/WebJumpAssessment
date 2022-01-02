<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
    use App\Models\Category;

    if(isset($_GET["id"])){
        $category = Category::getById($_GET["id"]);
        if($category){
            if(!count($category->products())>0){
                $category->delete();
                $_SESSION["Alert"] = array(
                    "Title" => "Success!",
                    "Text" => "Category deleted successfully",
                    "Icon" => "success"
                );
            }
            else{
                //Category is being used by products, and so, can't be deleted
                $_SESSION["Alert"] = array(
                    "Title" => "Warning!",
                    "Text" => "Category is being used by products, and so, can't be deleted",
                    "Icon" => "warning"
                );
            }
        }
        else{
            $_SESSION["Alert"] = array(
                "Title" => "Error!",
                "Text" => "Category could not be found",
                "Icon" => "Error"
            );
        }
    }
    header('Location: /pages/categories');
?>