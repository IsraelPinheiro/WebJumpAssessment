<div class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-0">
				<form id="FormModal">
                    <!-- Name -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Name</label>
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>
					<!-- Description -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-categories-store">Save</button>
			</div>
	  	</div>
	</div>
</div>