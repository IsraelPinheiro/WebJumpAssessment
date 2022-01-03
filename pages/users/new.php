<?php
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
?>


<div class="modal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-0">
				<form id="FormModal">
                    <!-- Name and Email-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" name="email" type="email" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>
					<!-- Password and Confirmation-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="password">Password</label>
								<input id="password" name="password" type="password" class="form-control" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="password_confirm">Confirm Password</label>
								<input id="password_confirm" name="password_confirm" type="password" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-users-store">Save</button>
			</div>
	  	</div>
	</div>
</div>