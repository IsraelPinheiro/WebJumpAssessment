<?php
	include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
    use App\Models\Category;
	$categories = Category::getAll();
?>


<div class="modal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Product</h5>
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
								<input id="name" name="name" type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sku">SKU</label>
								<input id="sku" name="sku" type="text" class="form-control" autocomplete="off">
							</div>
						</div>
					</div>
					<!-- Price and Initial Quantity -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">Price</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input id="price" name="price" type="number" min="0" class="form-control" autocomplete="off" value=0 required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="quantity">Initial Quantity</label>
								<input id="quantity" name="quantity" type="number" min="0" step="1" pattern="^\d*$" oninput="this.value = Math.round(this.value);" class="form-control" autocomplete="off" value=0 required>
							</div>
						</div>
					</div>
					<!-- Product's Categories -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
                                <label for="description">Available Categories</label>
                                <select size=5 class="custom-select" id="categories_available" name="categories_available">
									<?php
										foreach ($categories as $category){
											echo '<option value="'.$category->id.'">'.$category->name.'</option>';
										}
									?>

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                                <label for="description">Selected Categories</label>
                                <select size=5 class="custom-select" id="categories_selected" name="categories_selected"></select>
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
				<button type="submit" class="btn btn-primary btn-products-store">Save</button>
			</div>
	  	</div>
	</div>
</div>