<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\Product;
    use App\Models\ChangeLog;
    use App\Models\CategoryProduct;

    $products = Product::getAll();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Pseudo Method is POST
        if($_POST["_method"] == "POST"){
            $data = array();
            parse_str($_POST["_data"], $data);
            $data = (object)$data;
            $product = new Product();
            $product->name = empty($data->name) ? null:$data->name;
            $product->sku = empty($data->sku) ? null:$data->sku;
            $product->price = empty($data->price) ? 0:$data->price;
            $product->description = empty($data->description) ? null:$data->description;
            $product->quantity = empty($data->quantity) ? 0:$data->quantity;
            $product->id = $product->save();
            if($product->id){
                if(count(array_values($data->categories_selected))>0){
                    CategoryProduct::setRelationBulk($product->id,array_values($data->categories_selected));
                };
                ChangeLog::log_change("products", $product->id,"create");
                $_SESSION["Alert"] = array(
                    "Title" => "Success!",
                    "Text" => "Product created successfully",
                    "Icon" => "success"
                );
                return http_response_code(200);
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "Product couldn't be created",
                    "Icon" => "error"
                );
                return http_response_code(406);
            }
        }
        //Pseudo Method is PUT
        else if($_POST["_method"] == "PUT"){
            $product = Product::getById($_POST["_id"]);
            if($product){
                $data = array();
                parse_str($_POST["_data"], $data);
                $data = (object)$data;
                $product->name = empty($data->name) ? null:$data->name;
                $product->sku = empty($data->sku) ? null:$data->sku;
                $product->price = empty($data->price) ? 0:$data->price;
                $product->description = empty($data->description) ? null:$data->description;
                $product->quantity = empty($data->quantity) ? 0:$data->quantity;
                if($product->save()){
                    CategoryProduct::deleteByProductId($product->id);
                    if(count(array_values($data->categories_selected))>0){
                        CategoryProduct::setRelationBulk($product->id,array_values($data->categories_selected));
                    };
                    ChangeLog::log_change("products", $product->id,"update");
                    $_SESSION["Alert"] = array(
                        "Title" => "Success!",
                        "Text" => "Product updated successfully",
                        "Icon" => "success"
                    );
                    return http_response_code(200);
                }
                else{
                    $_SESSION["Alert"] = array(
                        "Title" => "Error!",
                        "Text" => "Product couldn't be updated",
                        "Icon" => "error"
                    );
                    return http_response_code(406);
                }
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "Product could not be found",
                    "Icon" => "error"
                );
                return http_response_code(404);
            }
        }
        //Pseudo Method is DELETE
        else if($_POST["_method"] == "DELETE"){
            $product = Product::getById($_POST["_id"]);
            if($product){
                ChangeLog::log_change("products", $product->id,"delete");
                CategoryProduct::deleteByProductId($product->id);
                $product->delete();
                $_SESSION["Alert"] = array(
                    "Title" => "Success!",
                    "Text" => "Product deleted successfully",
                    "Icon" => "success"
                );
                return http_response_code(200);
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "Product could not be found",
                    "Icon" => "Error"
                );
                return http_response_code(404);
            }
            
        }
    }
?>
<!-- Page Heading --> 
<h1 class="h3 mb-4 text-gray-800">Products</h1>
<button class="btn btn-primary btn-circle btn-products-add float-right d-inline" title="New" type="button">
    <i class="fas fa-plus"></i>
</button>

<!-- Table --> 
<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">SKU</th>
            <th class="text-center">Description</th>
            <th class="text-center">Price</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Categories</th>
            <th class="noorder noexport"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($products as $product){
                if($product->quantity>0){
                    echo '<tr>';
                }else{
                    echo '<tr class="table-danger">';
                }
                    echo '<td class="text-center">'.$product->id.'</td>';
                    echo '<td class="text-center">'.$product->name.'</td>';
                    echo '<td class="text-center">'.strtoupper($product->sku).'</td>';
                    echo '<td class="text-center">'.$product->description.'</td>';
                    echo '<td class="text-center">$'.$product->price.'</td>';
                    echo '<td class="text-center">'.$product->quantity.'</td>';
                    echo '<td class="text-center">'.count($product->categories()).'</td>';
                    echo '<td class="toolbox text-center">';
                        echo '<a data-id='.$product->id.' href="#" class="text-decoration-none btn-products-edit" title="Edit"><i class="fas fa-edit fa-lg pr-1"></i></a>';
                        echo '<a data-id='.$product->id.' href="#" class="text-decoration-none btn-products-show" title="Show"><i class="fas fa-eye fa-lg pr-1"></i></a>';
                        echo '<a data-id='.$product->id.' href="#" class="text-decoration-none btn-products-delete" title="Delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>';
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_bottom.php"?>