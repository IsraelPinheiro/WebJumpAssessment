<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\User;
    use App\Models\ChangeLog;

    $users = User::getAll();
?>
<!-- Page Heading --> 
<h1 class="h3 mb-4 text-gray-800">Users</h1>
<button class="btn btn-primary btn-circle btn-users-add float-right d-inline" title="New" type="button">
    <i class="fas fa-plus"></i>
</button>

<!-- Table --> 
<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Status</th>
            <th class="noorder noexport"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($users as $user){
                if($user->is_active){
                    echo '<tr>';
                }else{
                    echo '<tr class="table-danger">';
                }
                    echo '<td class="text-center">'.$user->id.'</td>';
                    echo '<td class="text-center">'.$user->name.'</td>';
                    echo '<td class="text-center">'.$user->email.'</td>';
                    if($user->is_active){
                        echo '<td class="text-center">Active</td>';
                    }else{
                        echo '<td class="text-center">Inactive</td>';
                    }
                    echo '<td class="toolbox text-center">';
                        echo '<a data-id='.$user->id.' href="#" class="text-decoration-none btn-users-edit" title="Edit"><i class="fas fa-edit fa-lg pr-1"></i></a>';
                        echo '<a data-id='.$user->id.' href="#" class="text-decoration-none btn-users-show" title="Show"><i class="fas fa-eye fa-lg pr-1"></i></a>';
                        echo '<a data-id='.$user->id.' href="#" class="text-decoration-none btn-users-delete" title="Delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>';
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_bottom.php"?>