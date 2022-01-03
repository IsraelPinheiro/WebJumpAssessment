<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
	use App\Models\User;
	use App\Models\ChangeLog;

	if(isset($_GET["id"])){
		$user = User::getById($_GET["id"]);
		if($user){
			ChangeLog::log_change("users", $user->id,"read");
		}
		else{
			http_response_code(404);
			header('Location: /pages/users');
			die();
		}
		
	} else{
		header('Location: /');
		die();
	}

?>

<div class="modal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Show User <?php echo $user->name ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-0">
				<form id="FormModal">
                    <!-- Name and Email -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input id="name" name="name" type="text" class="form-control" value="<?php echo $user->name ?>" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" name="email" type="email" class="form-control" value="<?php echo $user->email ?>" readonly>
							</div>
						</div>
					</div>
                    <!-- Status-->
					<div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_active">User Status</label>
                                <input id="email" name="email" type="email" class="form-control" value="<?php echo $user->is_active ? " Active" : "Inactive" ?>" readonly>
                            </div>
                        </div>
					</div>
				</form>
			</div>
	  	</div>
	</div>
</div>