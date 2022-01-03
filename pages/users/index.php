<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\User;
    use App\Controllers\Auth;
    use App\Models\ChangeLog;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Pseudo Method is POST
        if($_POST["_method"] == "POST"){
            $data = array();
            parse_str($_POST["_data"], $data);
            $data = (object)$data;
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = sha1($data->password);
            $user->is_active = 1;
            $user->description = empty($data->description) ? null:$data->description;
            $user->id = $user->save();
            if($user->id){
                ChangeLog::log_change("users", $user->id,"create");
                $_SESSION["Alert"] = array(
                    "Title" => "Success!",
                    "Text" => "User created successfully",
                    "Icon" => "success"
                );
                return http_response_code(200);
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "User couldn't be created",
                    "Icon" => "error"
                );
                return http_response_code(406);
            }
        }
        //Pseudo Method is PUT
        else if($_POST["_method"] == "PUT"){
            $user = User::getById($_POST["_id"]);
            if($user){
                $data = array();
                parse_str($_POST["_data"], $data);
                $data = (object)$data;
                $user->name = $data->name;
                $user->email = $data->email;
                if($data->password){
                    $user->password = sha1($data->password);
                }
                $user->is_active = $data->is_active ? intval($data->is_active) : 0;
                if($user->save()){
                    ChangeLog::log_change("users", $user->id,"update");
                    $_SESSION["Alert"] = array(
                        "Title" => "Success!",
                        "Text" => "User updated successfully",
                        "Icon" => "success"
                    );
                    return http_response_code(200);
                }
                else{
                    $_SESSION["Alert"] = array(
                        "Title" => "Error!",
                        "Text" => "User couldn't be updated",
                        "Icon" => "error"
                    );
                    return http_response_code(406);
                }
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "User could not be found",
                    "Icon" => "error"
                );
                return http_response_code(404);
            }
        }
        //Pseudo Method is DELETE
        else if($_POST["_method"] == "DELETE"){
            $user = User::getById($_POST["_id"]);
            if($user->id!=Auth::user()->id){
                if($user){
                    ChangeLog::log_change("users", $user->id,"delete");
                    $user->delete();
                    $_SESSION["Alert"] = array(
                        "Title" => "Success!",
                        "Text" => "User deleted successfully",
                        "Icon" => "success"
                    );
                    return http_response_code(200);
                }
                else{
                    $_SESSION["Alert"] = array(
                        "Title" => "Error!",
                        "Text" => "User could not be found",
                        "Icon" => "error"
                    );
                    return http_response_code(404);
                }
            }
            else{
                $_SESSION["Alert"] = array(
                    "Title" => "Warning!",
                    "Text" => "Can't delete the current logged in user",
                    "Icon" => "warning"
                );
                return http_response_code(406);
            }
        }
    }

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