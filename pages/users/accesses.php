
<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
    use App\Models\User;

    if(isset($_GET["id"])){
        $user = User::getByID($_GET["id"]);
    }
    else{
        return http_response_code(404);
    }
	
?>

<div class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo strtok($user->name, " ") ?>'s Accesses</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<!-- Log's Table --> 
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
						foreach ($user->access_logs() as $log){
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
			</div>
		</div>
	</div>
</div>