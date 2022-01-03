<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
	use App\Models\Category;
	use App\Models\ChangeLog;

	if(isset($_GET["id"])){
		$category = Category::getById($_GET["id"]);
		if($category){
			ChangeLog::log_change("categories", $category->id,"read");
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
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Category <?php echo $category->name ?></h5>
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
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" readonly value="<?php echo $category->name ?>">
							</div>
						</div>
					</div>
					<!-- Description -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" readonly rows="4"><?php echo $category->description ?></textarea>
							</div>
						</div>
					</div>
					<!-- Category's Products -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Products in this Category</label>
								<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th class="text-center">Id</th>
											<th class="text-center">Name</th>
											<th class="text-center">SKU</th>
											<th class="text-center">Description</th>
											<th class="text-center">Price</th>
											<th class="text-center">Qty</th>
											<th class="text-center">Categories</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($category->products() as $product){
												if($product->quantity>0){
													echo '<tr>';
												}else{
													echo '<tr class="table-danger">';
												}
													echo '<td class="text-center">'.$product->id.'</td>';
													echo '<td class="text-center">'.$product->name.'</td>';
													echo '<td class="text-center">'.strtoupper($product->sku).'</td>';
													echo '<td class="text-center">'.$product->description.'</td>';
													echo '<td class="text-center">$'.$product->price.'</td>';
													echo '<td class="text-center">'.$product->quantity.'</td>';
													echo '<td class="text-center">'.count($product->categories()).'</td>';
												echo '</tr>';
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
	  	</div>
	</div>
</div>