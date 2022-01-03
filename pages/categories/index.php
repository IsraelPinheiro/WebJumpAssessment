<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\Category;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Pseudo Method is POST
        if($_POST["_method"] == "POST"){
            $data = array();
            parse_str($_POST["_data"], $data);
            $data = (object)$data;
            $category = new Category();
            $category->name = empty($data->name) ? null:$data->name;
            $category->description = empty($data->description) ? null:$data->description;
            if($category->save()){
                $_SESSION["Alert"] = array(
                    "Title" => "Success!",
                    "Text" => "Category created successfully",
                    "Icon" => "success"
                );
                return http_response_code(200);
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "Category couldn't be created",
                    "Icon" => "error"
                );
                return http_response_code(406);
            }
        }
        //Pseudo Method is PUT
        else if($_POST["_method"] == "PUT"){
            $category = Category::getById($_POST["_id"]);
            if($category){
                $data = array();
                parse_str($_POST["_data"], $data);
                $data = (object)$data;
                $category->name = empty($data->name) ? null:$data->name;
                $category->description = empty($data->description) ? null:$data->description;
                if($category->save()){
                    $_SESSION["Alert"] = array(
                        "Title" => "Success!",
                        "Text" => "Category updated successfully",
                        "Icon" => "success"
                    );
                    return http_response_code(200);
                }
                else{
                    $_SESSION["Alert"] = array(
                        "Title" => "Error!",
                        "Text" => "Category couldn't be updated",
                        "Icon" => "error"
                    );
                    return http_response_code(406);
                }
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "Category could not be found",
                    "Icon" => "error"
                );
                return http_response_code(404);
            }
        }
        //Pseudo Method is DELETE
        else if($_POST["_method"] == "DELETE"){
            $product = Category::getById($_POST["_id"]);
            if($product){
                $product->delete();
                $_SESSION["Alert"] = array(
                    "Title" => "Success!",
                    "Text" => "Category deleted successfully",
                    "Icon" => "success"
                );
                return http_response_code(200);
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "Category could not be found",
                    "Icon" => "Error"
                );
                return http_response_code(404);
            }
            
        }
    }

    $categories = Category::getAll();
?>
<!-- Page Heading --> 
<h1 class="h3 mb-4 text-gray-800">Categories</h1>
<button class="btn btn-primary btn-circle btn-categories-add float-right d-inline" title="New" type="button">
    <i class="fas fa-plus"></i>
</button>

<!-- Table --> 
<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">Description</th>
            <th class="text-center">Products</th>
            <th class="noorder noexport"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($categories as $category){
                echo '<tr>';
                    echo '<td class="text-center">'.$category->id.'</td>';
                    echo '<td class="text-center">'.$category->name.'</td>';
                    echo '<td class="text-center">'.$category->description.'</td>';
                    echo '<td class="text-center">'.count($category->products()).'</td>';
                    echo '<td class="toolbox text-center">';
                        echo '<a data-id='.$category->id.' href="#" class="text-decoration-none btn-categories-edit" title="Edit"><i class="fas fa-edit fa-lg pr-1"></i></a>';
                        echo '<a data-id='.$category->id.' href="#" class="text-decoration-none btn-categories-view" title="View"><i class="fas fa-eye fa-lg pr-1"></i></a>';
                        echo '<a data-id='.$category->id.' href="#" class="text-decoration-none btn-categories-delete" title="Delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_bottom.php"?>