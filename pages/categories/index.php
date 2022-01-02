<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\Category;
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
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_bottom.php"?>