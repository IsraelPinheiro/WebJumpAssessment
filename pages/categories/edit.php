<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
	use App\Models\Category;
	use App\Models\ChangeLog;

	if(isset($_GET["id"])){
		$category = Category::getById($_GET["id"]);
		if($category){
			ChangeLog::log_change("category", $category->id,"read");
		}
		else{
			http_response_code(404);
			header('Location: /pages/categories');
			die();
		}
		
	} else{
		header('Location: /');
		die();
	}

?>

<div class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Category <?php echo $category->name ?></h5>
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
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" required value="<?php echo $category->name ?>">
							</div>
						</div>
					</div>
					<!-- Description -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="4"><?php echo $category->description ?></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-categories-update" data-id="<?php echo $category->id ?>">Save</button>
			</div>
	  	</div>
	</div>
</div>