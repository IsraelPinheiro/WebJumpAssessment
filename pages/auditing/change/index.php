<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\ChangeLog;

    $logs = ChangeLog::getAll();
?>
<!-- Page Heading --> 
<h1 class="h3 mb-4 text-gray-800">Change Logs</h1>
<button class="btn btn-primary btn-circle btn-users-add float-right d-inline" title="New" type="button">
    <i class="fas fa-plus"></i>
</button>

<!-- Table --> 
<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">User</th>
            <th class="text-center">Area</th>
            <th class="text-center">Action</th>
            <th class="text-center">Target</th>
            <th class="text-center">When</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($logs as $log){
                if($log->action=="create"){
                    echo '<tr class="table-success">';
                }else if($log->action=="update"){
                    echo '<tr class="table-warning">';
                }else if($log->action=="delete"){
                    echo '<tr class="table-danger">';
                }else{
                    echo '<tr>';
                }
                    echo '<td class="text-center">'.$log->id.'</td>';
                    echo '<td class="text-center">'.$log->user()->name.'</td>';
                    echo '<td class="text-center">'.ucfirst($log->target_type).'</td>';
                    echo '<td class="text-center">'.ucfirst($log->action).'</td>';
                    if($log->target()){
                        echo '<td class="text-center">'.$log->target()->name.'</td>';
                    }else{
                        echo '<td class="text-center">[Target Deleted]['.$log->target_id.']</td>';
                    }
                    echo '<td class="text-center">'.(new DateTime($log->created_at))->format('d/m/Y H:i:s').'</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_bottom.php"?>