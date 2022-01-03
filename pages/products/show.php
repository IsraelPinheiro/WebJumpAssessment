<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
	use App\Models\Category;
	use App\Models\Product;
	use App\Models\ChangeLog;

	if(isset($_GET["id"])){
		$product = Product::getById($_GET["id"]);
		if($product){
			ChangeLog::log_change("product", $product->id,"read");
		}
		else{
			http_response_code(404);
			header('Location: /pages/categories');
			die();
		}
		
	}else{
		header('Location: /');
		die();
	}
?>

<div class="modal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Product <?php echo $product->name ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-0">
				<form id="FormModal">
					<!-- Name and SKU-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" value="<?php echo $product->name ?>" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sku">SKU</label>
								<input id="sku" name="sku" type="text" class="form-control" autocomplete="off" value="<?php echo $product->sku ?>" readonly>
							</div>
						</div>
					</div>
					<!-- Price and Quantity -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">Price</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input id="price" name="price" type="number" class="form-control" value=<?php echo $product->price ?> readonly>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="quantity">Quantity</label>
								<input id="quantity" name="quantity" type="number" class="form-control" value=<?php echo $product->quantity ?> readonly>
							</div>
						</div>
					</div>
					<!-- Description -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="4" readonly><?php echo $product->description ?></textarea>
							</div>
						</div>
					</div>
					<!-- Product's Categories -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Product's Categories</label>
								<table class="table datatable table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th class="text-center">Id</th>
											<th class="text-center">Name</th>
											<th class="text-center">Description</th>
											<th class="text-center">Products</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($product->categories() as $category){
												echo '<tr>';
													echo '<td class="text-center">'.$category->id.'</td>';
													echo '<td class="text-center">'.$category->name.'</td>';
													echo '<td class="text-center">'.$category->description.'</td>';
													echo '<td class="text-center">'.count($category->products()).'</td>';
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