
<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
	use App\Controllers\Auth;
	use App\Models\ChangeLog;
	$logs = ChangeLog::getByUserId(Auth::user()->id);
?>

<div class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo strtok(Auth::user()->name, " ") ?>'s Activities</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<!-- Log's Table --> 
				<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">Id</th>
							<th class="text-center">Action</th>
							<th class="text-center">Target Table</th>
							<th class="text-center">Target Id</th>
							<th class="text-center">When</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($logs as $log){
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
									echo '<td class="text-center">'.ucfirst($log->action).'</td>';
									echo '<td class="text-center">'.ucfirst($log->target_type).'</td>';
									echo '<td class="text-center">'.$log->target_id.'</td>';
									echo '<td class="text-center">'.(new DateTime($log->created_at))->format('d/m/Y H:i:s').'</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>