<?php 
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
	use App\Models\Category;
	use App\Models\Product;
	use App\Models\ChangeLog;

	if(isset($_GET["id"])){
		$product = Product::getById($_GET["id"]);
		if($product){
			ChangeLog::log_change("products", $product->id,"read");
			$categories_selected = $product->categories();
			$categories_notselected = array_udiff(Category::getAll(), $product->categories(), function($obj_a, $obj_b){
				return $obj_a->id - $obj_b->id;
			});
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
				<h5 class="modal-title">Edit Product <?php echo $product->name ?></h5>
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
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" value="<?php echo $product->name ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sku">SKU</label>
								<input id="sku" name="sku" type="text" class="form-control" autocomplete="off" value="<?php echo $product->sku ?>">
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
									<input id="price" name="price" type="number" min="0" class="form-control" autocomplete="off" value=<?php echo $product->price ?> required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="quantity">Quantity</label>
								<input id="quantity" name="quantity" type="number" min="0" step="1" pattern="^\d*$" oninput="this.value = Math.round(this.value);" class="form-control" autocomplete="off" value=<?php echo $product->quantity ?> required>
							</div>
						</div>
					</div>
					<!-- Product's Categories -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="description">Available Categories</label>
								<select size=5 class="custom-select" id="categories_available" name="categories_available[]">
									<?php
										foreach ($categories_notselected as $category){
											echo '<option value="'.$category->id.'">'.$category->name.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="description">Selected Categories</label>
								<select size=5 class="custom-select" id="categories_selected" name="categories_selected[]" multiple>
									<?php
										foreach ($categories_selected as $category){
											echo '<option value="'.$category->id.'">'.$category->name.'</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<!-- Description -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="4"><?php echo $product->description ?></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-products-update" data-id="<?php echo $product->id ?>">Save</button>
			</div>
	  	</div>
	</div>
</div>