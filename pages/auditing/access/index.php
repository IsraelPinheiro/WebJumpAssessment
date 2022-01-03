<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_top.php";
    use App\Models\AccessLog;

    $logs = AccessLog::getAll();
?>
<!-- Page Heading --> 
<h1 class="h3 mb-4 text-gray-800">Access Logs</h1>
<button class="btn btn-primary btn-circle btn-users-add float-right d-inline" title="New" type="button">
    <i class="fas fa-plus"></i>
</button>

<!-- Table --> 
<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">User</th>
            <th class="text-center">Origin</th>
            <th class="text-center">Access Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($logs as $log){
                echo '<tr>';
                    echo '<td class="text-center">'.$log->id.'</td>';
                    echo '<td class="text-center">'.$log->user()->name.'</td>';
                    echo '<td class="text-center">'.$log->accessed_from.'</td>';
                    echo '<td class="text-center">'.(new DateTime($log->accessed_at))->format('d/m/Y H:i:s').'</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/page_bottom.php"?>